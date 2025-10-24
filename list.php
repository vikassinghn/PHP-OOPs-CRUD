<?php
require_once "users.php";
require_once "database.php";


$db = new database();
$user = new User($db->conn);
$users = $user->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

</head>

<body>
    <div class="container-mt5">
        <h2 class="mb-4 text-center"><b>Registered Users</b></h2>
        <table id=myDataTable class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                <?php if (count($users) > 0) { ?>
                    <?php foreach ($users as $key => $user): ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['phone'] ?></td>
                            <td><?php echo $user['address'] ?></td>
                            <td>
                                <a href="http://localhost/crud-operation/update_frontend.php?id= <?php echo $user['id'] ?>" class="btn btn-sm btn-success">Update</a>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $user['id']; ?>">Delete</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr class="text-center">
                        <td colspan="6">No records found</td>
                    </tr>
                <?php } ?>
                <script>
                    $(document).ready(function() {
                        $('#myDataTable').DataTable();
                    });
                </script>

                <script>
                    $(document).ready(function() {
                        $(".delete-btn").click(function() {
                            let userId = $(this).data("id");

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "This action cannot be undone!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: 'delete.php',
                                        type: 'POST',
                                        data: {
                                            id: userId
                                        },
                                        success: function(response) {
                                            Swal.fire('Deleted!', 'User has been deleted.', 'success');
                                            setTimeout(function() {
                                                location.reload()
                                            }, 1000)
                                        },
                                        error: function() {
                                            Swal.fire('Error!', 'Something went wrong.', 'error');
                                        }
                                    });
                                }
                            });
                        });
                    });
                </script>
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>