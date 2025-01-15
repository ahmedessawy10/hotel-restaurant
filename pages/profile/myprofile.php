<?php
session_start();
error_reporting(0);
require_once "../../database/db.php";

if (isset($_SESSION['user']) && count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}

$pageTitle = "my profile";
$styles = ["profile.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

?>


<div class="myprofile">

    <div class="container ">

        <div class="row align-items-start ">
            <div class="col-md-3 nav d-flex flex-column nav-pills p-2" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <button class="nav-link active  mb-2" id="v-pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                    aria-selected="true">my profile</button>
                <button class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                    aria-selected="false">password</button>


            </div>
            <div class=" col-md-9 tab-content" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab" tabindex="0">
                    <h2 class=" p-2 w-100"> my profile</h2>

                    <div class="prfile_image d-flex justify-content-center center align-items-center  my-3">
                        <button class="btn " data-bs-toggle="modal" data-bs-target="#profileModal">
                            <?php
                            if ($_SESSION['user']['image']) {
                                echo "<img src= ../../" . $_SESSION['user']['image'] . " alt=''>";
                            } else {
                                echo "<img src='../../assets/images/default_profile.png' alt=''>";
                            }
                            ?>
                        </button>
                    </div>


                    <form action="../../controller/profile.php" method="POST">

                        <div class="row justify-content-center">
                            <div class="col-md-10 my-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="nameHelp"
                                        placeholder="Enter name" name="name" value="<?php echo
                                                                                    $_SESSION['user']['name']
                                                                                    ?>">
                                </div>
                            </div>
                            <div class="col-md-10 my-2 ">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                        placeholder="Enter Email" name="email"
                                        value="<?php echo $_SESSION['user']['email'] ?>">
                                </div>

                            </div>
                            <div class="col-md-10 my-2 ">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                                        name="phone"
                                        placeholder="Enter phone" value="<?php echo $_SESSION['user']['phone'] ?>">
                                </div>
                            </div>

                        </div>


                        <div class=" d-flex justify-content-center py-3">
                            <button type="submit"
                                name="update" class="btn btn-primary">update</button>
                        </div>
                    </form action="../../controller/profile.php" method="POST">

                </div>
                <!-- change password -->
                <div class=" tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                    tabindex="0">
                    <h2 class=" p-2 w-100 ">change password</h2>

                    <form action="../../controller/profile.php" method="POST">

                        <div class="row justify-content-center">
                            <div class="col-md-10 my-2">
                                <div class="form-group">
                                    <label for="oldPassword">old password</label>
                                    <input type="text"

                                        class="form-control" id="oldPassword"
                                        aria-describedby="emailHelp" name="currentpassword"
                                        placeholder="Enter oldPassword">
                                </div>
                            </div>
                            <div class="col-md-10 my-2 ">
                                <div class="form-group">
                                    <label for="newpassword ">new password </label>
                                    <input type="newpassword " class="form-control" id="newpassword"
                                        aria-describedby="newpassword Help" placeholder="Enter newpassword " name="newpassword">
                                </div>

                            </div>
                            <div class="col-md-10 my-2 ">
                                <div class="form-group">
                                    <label for="confirmpassword ">new password </label>
                                    <input type="confirmpassword " class="form-control" id="confirmpassword"
                                        aria-describedby="confirmpassword Help" placeholder="Enter confirmpassword "
                                        name="confirmpassword
                                        
                                        ">
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-center py-3">
                            <button type="submit" class="btn       btn-primary"
                                name="changepass">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- update image modal -->



    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">upload image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="../../controller/profile.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div>

                            <div class="form-group
                        ">
                                <label for="image"><img src="" alt=""></label>
                                <input type="file" name="profileimage" class="form-control-file" id="image">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="uploadimage" class="btn btn-success">Save changes</button>
                        </div>
                </form>
            </div>
        </div>



    </div>




    <?php include "../../includes/footer.php";  ?>