<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<?php session_start() ?>

<body>

    <form action="user_backend.php" method="POST">
        <div class="container mt-5">

            <h2 class="mb-4 text-center">User Registration Form</h2>
            <div class="mt-3">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
                <span class="text-danger"> <?php echo ($_SESSION['name_error']) ?></span>

            </div>
            <div class="mt-3">
                <label class="form-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
                <span class="text-danger"><?php echo ($_SESSION['email_error'])  ?> </span>
            </div>
            <div class="mt-3">
                <label class="form-label">Phone No:</label>
                <input type="tel" class="form-control" id="phoneno" name="phoneno">
                <span class="text-danger"> <?php echo ($_SESSION['phone_error']) ?></span>
            </div>
            <div class="mt-3">
                <label class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" name="address">
                <span class="text-danger"> <?php echo ($_SESSION['address_error']) ?></span>
            </div>
            <button type="submit" class="btn btn-primary w-auto mt-4">Submit:</button>
        </div>
    </form>

</body>

</html>