<?php
    require_once 'views/header.php';
    require_once 'views/menu_create.php';
?>
    
    <div class="container-xxl py-5">
        <div class="container">
            <?php require_once 'views/ui_alert.php' ?>
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal"><?php echo $_POST['title'] ?></h5>
                <h4 class="mb-5">Upload Data</h4>
            </div>
            <div class="row g-2">
                <form action="upload.php?type=<?php echo $_GET['type'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <p class="text-primary text-uppercase mb-2">Select TSV (Tab Separated Values) file to upload <?php echo $_POST['title'] ?> list</p>
                        <div class="col-md-9">
                            <input type="file" name="uploaded_file" accept="text/tsv" class="form-control form-control-lg" id="uploaded_file" />
                        </div>
                        <div class="col-md-3 text-center">
                            <input type="hidden" name="save" value="upload" />
                            <button class="btn btn-primary py-3 px-5" type="submit">Upload</button>
                        </div>
                        <p class="text-muted mt-0">
                            <small>
                                <strong>Note:</strong> The TSV file should contain the following column headers - 
                                <em><?php echo implode(', ', $_POST['headers']) ?></em>
                            </small>
                        </p>
                    </div>
                </form>
            </div>
            <div style="padding-top:30px">
                <?php
                    $ui_file = 'views/ui_'.$_GET['type'].'.php';
                    if (is_file($ui_file)) {
                        require_once $ui_file;
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<?php
    require_once 'views/footer.php';
?>
