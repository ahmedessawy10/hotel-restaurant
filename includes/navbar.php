<nav class="navbar navbar-expand-lg nav-color mb-5" style="background-color: #e8d59e;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img class="w-50 rounded-circle" src="<?php echo $baseURL; ?>/assets/images/logo.png" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo $baseURL; ?>/pages/user/home.php" >Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo $baseURL; ?>/pages/admin/products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo $baseURL; ?>/pages/admin/users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"  href="<?php echo $baseURL; ?>/pages/admin/manual_order.php">Manual Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Check</a>
                </li>
            </ul>
            <span class="me-0 border-1 rounded-circle txt-color"><i class="fa-solid fa-user"></i></span>
            <p class="txt-color mt-2 pt-2 ps-2">Admin Name</p>
        </div>
    </div>
</nav>