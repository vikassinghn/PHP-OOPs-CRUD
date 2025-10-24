<?php
session_start();
require_once 'database.php';
require_once 'users.php';

$db = new database();
$userObj = new User($db->conn);
$id = $name = $email = $phone = $address = "";
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
$userData = $userObj->readOne($id);
$name = $userData['name'] ?? "";
$email = $userData['email'] ?? "";
$phone = $userData['phone'] ?? "";
$address = $userData['address'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User data updation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <form action="update_backend.php" method="POST">
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Update the User Data</h2>
            <input type="hidden" name="user_id" value="<?php echo $_GET['id'] ?>">
            <div class="mt-3">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                <span class="text-danger"> <?php echo ($_SESSION['name_error']) ?></span>

            </div>
            <div class="mt-3">
                <label class="form-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                <span class=" text-danger"><?php echo ($_SESSION['email_error'])  ?> </span>
            </div>
            <div class="mt-3">
                <label class="form-label">Phone No:</label>
                <input type="tel" class="form-control" id="phoneno" name="phoneno" value="<?php echo $phone ?>">
                <span class=" text-danger"> <?php echo ($_SESSION['phone_error']) ?></span>
            </div>
            <div class="mt-3">
                <label class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address ?>">
                <span class=" text-danger"> <?php echo ($_SESSION['address_error']) ?></span>
            </div>
            <button type="submit" class="btn btn-primary w-auto mt-4">Update:</button>
        </div>
    </form>

</body>