<?php
require_once "../../database/db.php";
$pageTitle = "Users";
$styles = ["users.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

?>
        <main>      
        <div class="container mt-5 w-75">
      <div class="main-row d-flex flex-row justify-content-between">
          <h2 class="user-title" >All Users</h2>
        <button class="btn btn-primary mb-3 add-user " data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-plus"></i> Add User
        </button>
      </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Image</th>
                    <th>Ext.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Abdulrahman Hamdy</td>
                    <td>2010</td>
                    <td><img src="path/to/image1.jpg" alt="Abdulrahman Hamdy" width="50"></td>
                    <td>5605</td>
                    <td>
                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Islam Aaker</td>
                    <td>2010</td>
                    <td><img src="path/to/image2.jpg" alt="Islam Aaker" width="50"></td>
                    <td>5605</td>
                    <td>
                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Sayed Fatty</td>
                    <td>2010</td>
                    <td><img src="path/to/image3.jpg" alt="Sayed Fatty" width="50"></td>
                    <td>5605</td>
                    <td>
                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userName" placeholder="Enter name">
                        </div>
                        <div class="mb-3">
                            <label for="userRoom" class="form-label">Room</label>
                            <input type="text" class="form-control" id="userRoom" placeholder="Enter room">
                        </div>
                        <div class="mb-3">
                            <label for="userImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="userImage">
                        </div>
                        <div class="mb-3">
                            <label for="userExt" class="form-label">Ext.</label>
                            <input type="text" class="form-control" id="userExt" placeholder="Enter extension">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
    </main>


<?php include "../../includes/footer.php";  ?>