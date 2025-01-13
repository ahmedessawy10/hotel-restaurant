<?php
require_once "../../database/db.php";
$pageTitle = "Home";
$styles = ["profile.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

?>


<div class="myprofile">

    <div class="container ">

        <div class="row align-items-start ">
            <div class="col-md-3 nav d-flex flex-column nav-pills " id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <button class="nav-link active " id="v-pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                    aria-selected="true">my profile</button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                    aria-selected="false">password</button>


            </div>
            <div class=" col-md-9 tab-content" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab" tabindex="0">
                    <h2 class=" p-2 w-100"> my profile</h2>

                    <div class="prfile_image d-flex justify-content-center center align-items-center  my-3">
                        <button class="btn " data-toggle="modal" type="button" data-target="#updateImage">
                            <img src=" ../../assets/images/logo.png" alt="">
                        </button>
                    </div>


                    <form action="">

                        <div class="row justify-content-center">
                            <div class="col-md-10 my-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                        placeholder="Enter name">
                                </div>
                            </div>
                            <div class="col-md-10 my-2 ">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                        placeholder="Enter Email">
                                </div>

                            </div>
                            <div class="col-md-10 my-2 ">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                                        placeholder="Enter phone">
                                </div>

                            </div>

                        </div>


                        <div class="d-flex justify-content-center py-3">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>

                </div>
                <!-- change password -->
                <div class=" tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                    tabindex="0">
                    <h2 class=" p-2 w-100 ">change password</h2>

                    <form action=" ">

                        <div class="row justify-content-center">
                            <div class="col-md-10 my-2">
                                <div class="form-group">
                                    <label for="oldPassword">old password</label>
                                    <input type="text" class="form-control" id="oldPassword"
                                        aria-describedby="emailHelp" placeholder="Enter oldPassword">
                                </div>
                            </div>
                            <div class="col-md-10 my-2 ">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                        placeholder="Enter Email">
                                </div>

                            </div>
                            <div class="col-md-10 my-2 ">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                                        placeholder="Enter phone">
                                </div>

                            </div>

                        </div>


                        <div class="d-flex justify-content-center py-3">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>

                    </form>




                </div>


            </div>
        </div>

    </div>
</div>





<!-- update image modal -->



<div class=" modal fade" id="updateImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">update image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="" method="" menctype=" multipart/form-data">
                        <div class="form-group
                        ">
                            <label for="image"><img src="" alt=""></label>
                            <input type="file" name="image" class="form-control-file" id="image">
                        </div>

                        <div class="form-group
                        ">

                            <button type="submit" class="form-control-file">update</button>
                    </form>
                </div>

            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">change</button>
            </div>
        </div>
    </div>
</div>


<?php include "../../includes/footer.php";  ?>