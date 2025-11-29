<?php
function logAction($conn, $user_id, $action, $details = "") {
    $ip = $_SERVER['REMOTE_ADDR'];

    $action  = mysqli_real_escape_string($conn, $action);
    $details = mysqli_real_escape_string($conn, $details);

    $sql = "INSERT INTO audit_log (admin_id, action, details, ip_address)
            VALUES ('$user_id', '$action', '$details', '$ip')";
    mysqli_query($conn, $sql);
}
?>
