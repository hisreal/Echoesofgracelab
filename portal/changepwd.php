<?php

// Include your admin header and nav
require_once 'includes/header.php';
require_once 'includes/top-bar.php';
require_once 'includes/nav-bar.php';

// If your db connection is not already in header include it here
// require_once 'includes/dbh.php';

$success = '';
$error   = '';

// use the correct session key for your logged in admin
$adminId = $_SESSION['user_id'] ?? null;

if (!$adminId) {
    $error = 'You are not logged in';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $adminId) {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword     = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($newPassword !== $confirmPassword) {
        $error = 'New passwords do not match';
    } elseif (strlen($newPassword) < 8) {
        $error = 'New password must be at least 8 characters';
    } else {
        // Fetch current password hash from database
        $stmt = $conn->prepare('SELECT pwd FROM admin WHERE id = ? LIMIT 1');
        if (!$stmt) {
            $error = 'Database error';
        } else {
            $stmt->bind_param('i', $adminId);
            $stmt->execute();
            $result = $stmt->get_result();
            $admin  = $result->fetch_assoc();
            $stmt->close();

            if (!$admin) {
                $error = 'Admin not found';
            } elseif (!password_verify($currentPassword, $admin['pwd'])) {
                // use the correct column name here
                $error = 'Current password is incorrect';
            } else {
                // Update to new password
                $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $update  = $conn->prepare('UPDATE admin SET pwd = ? WHERE id = ?');
                if (!$update) {
                    $error = 'Could not update password';
                } else {
                    $update->bind_param('si', $newHash, $adminId);
                    if ($update->execute()) {
                        $success = 'Password changed successfully';
                    } else {
                        $error = 'Could not update password';
                    }
                    $update->close();
                }
            }
        }
    }
}
?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6 offset-md-3 col-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="mb-0">Change Password</h4>
                        </div>
                        <div class="card-body">

                            <?php if (!empty($error)) : ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($error); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($success)) : ?>
                                <div class="alert alert-success">
                                    <?php echo htmlspecialchars($success); ?>
                                </div>
                            <?php endif; ?>

                            <form action="" method="post" autocomplete="off">
                               <div class="mb-3">
                                    <label class="form-label" style="font-weight: bold">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password">
                                            Show
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" style="font-weight: bold">New Password</label>
                                    <div class="input-group">
                                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_password">
                                            Show
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" style="font-weight: bold">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="confirm_password">
                                            Show
                                        </button>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
