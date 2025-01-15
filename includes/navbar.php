<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"></h5>
        <button type="button" class="btn-close " style="width:15px;height:15px;border:1px dotted #777;border-radius: 50%;color:#000;" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column align-items-center">

        <div class="logo">
            <img alt="" data-cfsrc="img/logo.png" src="<?php echo $baseURL; ?>/assets/images/logo.png" alt=" " /></a>
        </div>

        <section class=" links d-flex flex-column my-2">

            <nav class="" id="menulist" style="transition: all 0.5s ease-in-out;">
                <ul class="d-flex  flex-column align-items-start justify-content-center">
                    <?php
                    if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {
                        if ($_SESSION['user']['role'] == "admin") {
                    ?>

                            <li class="py-2 fs-6 fw-bold"><a class="underline-link" href="<?php echo $baseURL; ?>/pages/user/home.php">Home</a></li>

                            <li class="py-2 fs-6 fw-bold"><a class="underline-link" href="index.html ">orders</a></li>
                            <li class="py-2 fs-6 fw-bold"><a class="underline-link" href="<?php echo $baseURL; ?>/pages/admin/manual_order.php">manual orders</a></li>
                            <li class="py-2 fs-6 fw-bold"><a class="underline-link" href="<?php echo $baseURL; ?>/pages/admin/users.php">users</a></li>
                            <li class="py-2 fs-6 fw-bold"><a class="underline-link" href="<?php echo $baseURL; ?>/pages/admin/products.php">products</a></li>


                        <?php  } elseif ($_SESSION['user']['role'] == "user") { ?>
                            <li class="py-2 fs-6 fw-bold"><a class="underline-link" href="<?php echo $baseURL; ?>/pages/user/home.php">Home</a></li>

                            <li class="py-2 fs-6 fw-bold"><a class="underline-link" href="index.html ">my orders</a></li>
                        <?php  } ?>

                    <?php } else {
                    } ?>

                </ul>
            </nav>


        </section>

        <div class="col-lg-3 px-2  d-flex align-items-center">
            <?php
            if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {

            ?>
                <div class="dropdown">

                    <button class="btn btn-secondary dropdown-toggle d-flex justify-content-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $baseURL . '/' . $_SESSION['user']['image']  ?>" alt="">
                        <span class="mx-1"><?php echo $_SESSION['user']['name']  ?></span>

                    </button>
                    <ul class="dropdown-menu w-100 " aria-labelledby="dropdownMenuButton1">
                        <div class="d-flex flex-column">
                            <li><a class="dropdown-item" href="<?php echo $baseURL ?>/pages/profile/myprofile.php"><i class="fa-solid fa-user-gear mx-2"></i>profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo $baseURL ?>/pages/logout.php"><i class="fa-solid fa-right-to-bracket mx-2"></i>logout</a></li>
                        </div>

                    </ul>
                </div>

            <?php } else { ?>
                <a class=" f-5 fw-bold px-3 py-2 login-link mx-2 d-inline-block" href="<?php echo $baseURL; ?>/pages/login.php">Login</a>
            <?php } ?>


        </div>



    </div>
</div>



<!-- start header -->
<header class="py-3 px-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-10 px-2 d-flex align-items-center">
                <section class="logo">
                    <img src="<?php echo $baseURL; ?>/assets/images/logo.png" alt=" " />
                </section>
            </div>
            <div class="col-lg-7  d-none  d-lg-block">
                <nav class="d-lg-flex h-100 ">
                    <ul class="d-flex justify-content-end align-items-baseline w-100 m-0">
                        <?php
                        if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {
                            if ($_SESSION['user']['role'] == "admin") {
                        ?>

                                <li class="px-2 "><a class="underline-link" href="index.html ">Home</a></li>
                                <li class="px-2 "><a class="underline-link" href="index.html ">my orders</a></li>
                                <li class="px-2 "><a class="underline-link" href="index.html ">orders</a></li>
                                <li class="px-2 "><a class="underline-link" href="<?php echo $baseURL; ?>/pages/admin/users.php">users</a></li>
                                <li class="px-2 "><a class="underline-link" href="<?php echo $baseURL; ?>/pages/admin/products.php ">products</a></li>



                            <?php  } elseif ($_SESSION['user']['role'] == "user") { ?>

                                <li class="px-2 fs-6 fw-bold"><a class="underline-link" href="<?php echo $baseURL; ?>/pages/user/home.php">Home</a></li>

                                <li class="px-2 fs-6 fw-bold"><a class="underline-link" href="index.html ">my orders</a></li>

                            <?php  } ?>

                        <?php } else {
                        } ?>

                    </ul>
                </nav>
            </div>

            <div class="col-lg-3 px-2  d-none  d-lg-flex align-items-center">
                <?php
                if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {

                ?>
                    <div class="dropdown">

                        <button class="btn btn-secondary dropdown-toggle d-flex justify-content-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $baseURL . '/' . $_SESSION['user']['image']  ?>" alt="">
                            <span class="mx-1"><?php echo $_SESSION['user']['name']  ?></span>

                        </button>
                        <ul class="dropdown-menu w-100 " aria-labelledby="dropdownMenuButton1">
                            <div class="d-flex flex-column">
                                <li><a class="dropdown-item" href="<?php echo $baseURL ?>/pages/profile/myprofile.php"><i class="fa-solid fa-user-gear mx-2"></i>profile</a></li>
                                <li><a class="dropdown-item" href="<?php echo $baseURL ?>/pages/logout.php"><i class="fa-solid fa-right-to-bracket mx-2"></i>logout</a></li>
                            </div>

                        </ul>
                    </div>

                <?php } else { ?>
                    <a class=" f-5 fw-bold px-3 py-2 login-link mx-2 d-inline-block" href="<?php echo $baseURL; ?>/pages/login.php">Login</a>
                <?php } ?>


            </div>
            <div class="col-2  d-block d-lg-none ">
                <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    <i class="fa-solid fa-bars fs-4 outline-0"></i>
                </button>
            </div>

        </div>
</header>