
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
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">About</a>
                            <div class="dropdown-menu m-0">
                                <a href="index.php?menu=vision" class="dropdown-item">Vision</a>
                                <a href="index.php?menu=mission" class="dropdown-item ">Mission</a>
                                <a href="index.php?menu=goals" class="dropdown-item">Goals</a>
                                <a href="index.php?menu=bisu-hymn" class="dropdown-item">BISU Hymn</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Yearbooks</a>
                            <div class="dropdown-menu m-0">
                                <?php foreach ($_POST['ybook_lists'] as $ybook => $desc): ?>
                                    <a href="ybook.php?batch=<?php echo $ybook ?>" target="_blank" class="dropdown-item">Batch <?php echo $ybook ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION['logged'] == 'admin'): ?>
                        <a href="index.php?menu=ybook" target="_blank" class="btn btn-primary py-2 px-4">Create a Yearbook</a>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">About</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">About</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"><?php echo $_POST['current_page'] ?></li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
        <!-- Navbar & Hero End -->
