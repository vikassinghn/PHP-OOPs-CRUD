<?php
require_once 'database.php';
require_once 'users.php';

$db = new Database();
$user = new User($db->conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0 && $user->delete($id)) {
        header("Location: list.php");
    } else {
        http_response_code(500);
        echo 'error';
    }
}
