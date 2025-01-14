<?php
require_once "../../database/db.php";
$pageTitle = "Users";
$styles = ["../../assets/css/users.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

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
                <tbody id="userTableBody"></tbody>
            </table>
        </div>

        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm">
                            <div class="mb-3">
                                <label for="userName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="userName" placeholder="Enter name" required>
                            </div>
                            <div class="mb-3">
                                <label for="userRoom" class="form-label">Room</label>
                                <input type="text" class="form-control" id="userRoom" placeholder="Enter room" required>
                            </div>
                            <div class="mb-3">
                                <label for="userImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="userImage" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="userExt" class="form-label">Ext.</label>
                                <input type="text" class="form-control" id="userExt" placeholder="Enter extension" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="saveUserBtn">Save User</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            <div class="mb-3">
                                <label for="editUserName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editUserName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserRoom" class="form-label">Room</label>
                                <input type="text" class="form-control" id="editUserRoom" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="editUserImage" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="editUserExt" class="form-label">Ext.</label>
                                <input type="text" class="form-control" id="editUserExt" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="updateUserBtn">Update User</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/user.js"></script>
</body>
</html>


<?php include "../../includes/footer.php";  ?>