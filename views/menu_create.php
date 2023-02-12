
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fas fa-graduation-cap me-3"></i>BISU - Balilihan Campus</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="create.php" class="nav-item nav-link 
                            <?php if (!isset($_GET['type']) && !isset($_GET['batch'])): ?>
                                    active
                                <?php endif; ?>
                        ">Create</a>
                        <a href="upload.php?type=courses" class="nav-item nav-link 
                            <?php if (isset($_GET['type']) && $_GET['type'] == 'courses'): ?>
                                active
                            <?php endif; ?>
                        ">Upload Courses</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle  
                                <?php if (isset($_GET['batch']) && $_GET['batch'] != ''): ?>
                                    active
                                <?php endif; ?>
                            " data-bs-toggle="dropdown">Yearbooks</a>
                            <div class="dropdown-menu m-0">
                                <?php foreach ($_POST['draft_ybooks'] as $yearbook): ?>
                                    <a href="draft.php?batch=<?php echo $yearbook['Batch'] ?>"  class="dropdown-item ">
                                        Batch <?php echo $yearbook['Batch'] ?>
                                        <?php if ($yearbook['Is_Published'] == 1): ?>
                                            <em>(published)</em>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
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
