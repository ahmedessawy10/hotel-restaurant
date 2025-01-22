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
$styles = ["users.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";
?>

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
                        <th>Image</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <!-- Users will be dynamically added here -->
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
                        <form id="addUserForm" onsubmit="addUser(event)" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="userName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="userName" name="name" placeholder="Enter name" required>
                            </div>
                            <div class="mb-3">
                                <label for="userImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="userImage" name="image" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Email</label>
                                <input type="text" class="form-control" id="userEmail" name="email" placeholder="Enter email" required>
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
                        <form id="editUserForm" onsubmit="updateUser(event)" enctype="multipart/form-data">
                            <input type="hidden" id="editUserId" name="id">
                            <div class="mb-3">
                                <label for="editUserName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editUserName" name="name" placeholder="Enter name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="editUserImage" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="editUserEmail" class="form-label">Email</label>
                                <input type="text" class="form-control" id="editUserEmail" name="email" placeholder="Enter email" required>
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