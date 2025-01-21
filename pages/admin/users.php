<?php
session_start();
error_reporting(0);
require_once "../../database/db.php";

if (!isset($_SESSION['user'])) {
    header('location: ../../login.php');
    exit;
}

$pageTitle = "Users";
$styles = ["../../assets/css/users.css"];
$scripts = ["../../assets/js/user.js"];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

// Fetch users from the database
try {
    $sql = "SELECT * FROM users ORDER BY id DESC";
    $stmt = $dbConnection->prepare($sql);
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
    <link rel="stylesheet" href="../../assets/css/users.css">
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
                        <th>Image</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><img src="../../assets/images/upload/<?php echo htmlspecialchars($user['image']); ?>" alt="<?php echo htmlspecialchars($user['name']); ?>" width="50"></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
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
                        <form id="addUserForm" enctype="multipart/form-data">
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
                                <input type="email" class="form-control" id="userEmail" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="mb-3">
                                <label for="userPhone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="userPhone" name="phone" placeholder="Enter phone" required>
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
                        <form id="editUserForm" enctype="multipart/form-data">
                            <input type="hidden" id="editUserId" name="id">
                            <div class="mb-3">
                                <label for="editUserName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editUserName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="editUserImage" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="editUserEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editUserEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUserPhone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="editUserPhone" name="phone" required>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/user.js"></script>
</body>
</html>

<?php include "../../includes/footer.php"; ?>