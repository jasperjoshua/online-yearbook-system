
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fas fa-graduation-cap me-3"></i>BISU - Balilihan Campus</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.php" class="nav-item nav-link ">Home</a>
                        <a href="index.php?menu=ybook&batch=<?php echo $_GET['batch'] ?>" class="nav-item nav-link <?php echo (($_GET['menu'] === 'ybook') ? 'active' : '') ?>">The Graduates</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown <?php echo (($_GET['menu'] === null) ? 'active' : '') ?> ">Yearbooks</a>
                            <div class="dropdown-menu m-0">
                                <?php foreach ($_POST['ybook_lists'] as $ybook => $desc): ?>
                                    <a href="index.php?menu=ybook&batch=<?php echo $ybook ?>" target="_blank" class="dropdown-item ">Batch <?php echo $ybook ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <a href="ybook.php?batch=<?php echo $_GET['batch'] ?>" class="btn btn-primary py-2 px-4">View Yearbook</a>
                    <?php if ($_SESSION['ybook']['logged'] == 'admin'): ?>
                        <a href="index.php?menu=logout" class="btn btn-primary py-2 px-4 m-1">Logout</a>
                    <?php else: ?>
                        <a href="index.php?menu=login" class="btn btn-primary py-2 px-4">Admin Login</a>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
            </div>

        </div>
        <!-- Navbar & Hero End -->
