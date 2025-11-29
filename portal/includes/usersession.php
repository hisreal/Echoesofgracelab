
<?php

require '../includes/dbh.php';

// Optional access control
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
$AdminStmt = "SELECT * FROM admin WHERE id='".$_SESSION['user_id']."' ";
$AdminResult = mysqli_query($conn, $AdminStmt);
$FetchAdmin = mysqli_fetch_assoc($AdminResult);
$branch = $FetchAdmin['branch'];

?> 