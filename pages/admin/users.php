<?php

session_start();
error_reporting(0);
require_once "../../database/db.php";

if (isset($_SESSION['user']) && count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}
require_once "../../database/db.php";
$pageTitle = "Users";
$styles = ["../../assets/css/users.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

// Fetch users from the database using PDO
try {
    $sql = "SELECT * FROM users ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching users: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main>
        <div class="container mt-5 w-75">
            <div class="main-row d-flex flex-row justify-content-between align-items-center mb-4">
                <h2 class="user-title">All Users</h2>
                <button class="btn btn-primary add-user" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus"></i> Add User
                </button>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Room</th>
                        <th>Image</th>
                        <th>Ext.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['room']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($user['image']); ?>" alt="<?php echo htmlspecialchars($user['name']); ?>" width="50"></td>
                            <td><?php echo htmlspecialchars($user['ext']); ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="openEditModal(<?php echo $user['id']; ?>)">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $user['id']; ?>)">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm" action="../../controller/user.php?action=add" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="userName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="userName" name="name" placeholder="Enter name" required>
                            </div>
                            <div class="mb-3">
                                <label for="userRoom" class="form-label">Room</label>
                                <input type="text" class="form-control" id="userRoom" name="room" placeholder="Enter room" required>
                            </div>
                            <div class="mb-3">
                                <label for="userImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="userImage" name="image" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="userExt" class="form-label">Ext.</label>
                                <input type="text" class="form-control" id="userExt" name="ext" placeholder="Enter extension" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm" action="../../controller/user.php?action=edit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="editUserId" name="id">
                            <div class="mb-3">
                                <label for="editUserName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editUserName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserRoom" class="form-label">Room</label>
                                <input type="text" class="form-control" id="editUserRoom" name="room" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="editUserImage" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="editUserExt" class="form-label">Ext.</label>
                                <input type="text" class="form-control" id="editUserExt" name="ext" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php include "../../includes/footer.php";  ?>