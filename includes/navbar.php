<nav class="navbar navbar-expand-lg nav-color ">
    <div class="container-fluid">
        <a class="navbar-brand " href="#">
            <img src="<?php echo $baseURL; ?>/assets/images/logo.png" class="w-49" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " aria-current="page"
                        href="<?php echo $baseURL; ?>/pages/admin/products.php">products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page"
                        href="<?php echo $baseURL; ?>/pages/admin/users.php">users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#">manual order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#">check</a>
                </li>
            </ul>

            <?php
            if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {
                echo "<span class='me-0 border-1 rounded-circle txt-color'><i class='fa-solid fa-user'></i></span>";
                echo "<p class='txt-color mt-2 pt-2 ps-2'>{$_SESSION['user']['name']}</p>";
            } else {
                echo "<span class='me-0 border-1 rounded-circle txt-color'><i class='fa-solid fa-user'></i></span>";
                echo "<p class='txt-color mt-2 pt-2 ps-2'>no user</p>";
            }
            ?>
        </div>
    </div>
</nav>