<?php
require_once "../../database/db.php";
$pageTitle = "Home";
$styles = ["profile.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="myprofile">
        <div class="container">
            <div class="row align-items-start">
                <!-- Vertical Navigation -->
                <div class="col-md-3 nav d-flex flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">My Profile</button>
                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Password</button>
                </div>

                <!-- Tab Content -->
                <div class="col-md-9 tab-content" id="v-pills-tabContent">
                    <!-- My Profile Tab -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                        <h2 class="p-2 w-100">My Profile</h2>
                        <div class="prfile_image d-flex justify-content-center align-items-center my-3">
                            <button class="btn" data-toggle="modal" type="button" data-target="#updateImage">
                                <img src="../../assets/images/logo.png" alt="Profile Image">
                            </button>
                        </div>
                        <form action="">
                            <div class="row justify-content-center">
                                <div class="col-md-10 my-2">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="col-md-10 my-2">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-md-10 my-2">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" placeholder="Enter phone">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center py-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password Tab -->
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                        <h2 class="p-2 w-100">Change Password</h2>
                        <form action="">
                            <div class="row justify-content-center">
                                <div class="col-md-10 my-2">
                                    <div class="form-group">
                                        <label for="oldPassword">Old Password</label>
                                        <input type="password" class="form-control" id="oldPassword" placeholder="Enter old password">
                                    </div>
                                </div>
                                <div class="col-md-10 my-2">
                                    <div class="form-group">
                                        <label for="newPassword">New Password</label>
                                        <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                                    </div>
                                </div>
                                <div class="col-md-10 my-2">
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center py-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php include "../../includes/footer.php";  ?>