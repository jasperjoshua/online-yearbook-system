
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fas fa-graduation-cap me-3"></i><?php echo SYSTEM_NAME ?></h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">About</a>
                            <div class="dropdown-menu m-0">
                                <a href="index.php?menu=vision" class="dropdown-item">Vision</a>
                                <a href="index.php?menu=mission" class="dropdown-item active">Mission</a>
                                <a href="index.php?menu=goals" class="dropdown-item">Goals</a>
                                <a href="index.php?menu=bisu-hymn" class="dropdown-item">BISU Hymn</a>
                            </div>
                        </div>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <a href="menu.html" class="nav-item nav-link">Menu</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Yearbooks</a>
                            <div class="dropdown-menu m-0">
                                <?php foreach ($_POST['ybook_lists'] as $ybook): ?>
                                    <a href="index.php?ybook=<?php echo $ybook ?>" target="_blank" class="dropdown-item">Batch <?php echo $ybook ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION['logged'] == 'admin'): ?>
                        <a href="index.php?menu=ybook" target="_blank" class="btn btn-primary py-2 px-4">Create Yearbook</a>
                        <a href="index.php?menu=logout" target="_blank" class="btn btn-primary py-2 px-4 m-1">Logout</a>
                    <?php else: ?>
                        <a href="index.php?menu=login" target="_blank" class="btn btn-primary py-2 px-4">Admin Login</a>
                    <?php endif; ?>
                </div>
            </nav>
            
            <?php require_once 'views/breadcrumbs.php' ?>
        </div>
        <!-- Navbar & Hero End -->
