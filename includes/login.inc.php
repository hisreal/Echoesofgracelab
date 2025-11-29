<?php
session_start();
header('Content-Type: application/json');
require 'dbh.php';
require_once 'audit.php'; // include the logging function

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = isset($_POST['UserId']) ? trim($_POST['UserId']) : '';
    $password = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';

    if ($email === '' || $password === '') {
        echo json_encode([
            'success' => false,
            'field' => 'general',
            'message' => 'Please enter both email and password.'
        ]);
        exit;
    }

    // Prepared statement
    $stmt = $conn->prepare("SELECT id, email, pwd FROM admin WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo json_encode([
            'success' => false,
            'field' => 'UserId',
            'message' => 'Email not found.'
        ]);
        exit;
    }

    if (!password_verify($password, $user['pwd'])) {
        echo json_encode([
            'success' => false,
            'field' => 'pwd',
            'message' => 'Incorrect password.'
        ]);
        exit;
    }

    // Correct login
    session_regenerate_id(true);

    // LOG ACTION (fixed)
    logAction($conn, $user['id'], "Login", "Admin logged in");

    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];

    echo json_encode([
        'success' => true,
        'message' => 'Login successful.',
        'redirect' => 'portal/index.php'
    ]);
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'Invalid request method.'
]);
exit;
?>
