<?php
    require_once 'views/header.php';
    require_once 'views/menu_create.php';
?>

<div class="container-xxl bg-white p-0">
    <div class="form-floating">
        <div class="text-center wow fadeInUp mt-5 pt-5" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Create a Yearbook</h5>
            <h1 class="mb-5">Draft Yearbook for BATCH <?php echo $_SESSION['batch_sel'] ?>
                <form action="draft.php?m=publish&batch=<?php echo $_GET['batch'] ?>" method="POST" enctype="multipart/form-data" class="p-3">
                    <button class="btn btn-primary py-4 px-5" type="submit" name="publish" value="publish">Publish Yearbook</button>
                </form>
            </h1>
        </div>
        <div class="m-5 mt-0 mb-0">
            <?php require_once 'views/ui_alert.php' ?>
        </div>
        <div class="row g-3">
            <form action="draft.php?m=apply_theme&batch=<?php echo $_GET['batch'] ?>" method="POST" enctype="multipart/form-data" class="p-3">
                <div class="row g-3 p-5 m-5 mb-0 mt-0 pt-0 pb-0">
                        <div class="col-md-9">
                            <p class="h4 text-primary text-uppercase mb-2">YEARBOOK THEME</p>
                            <select class="form-control selectpicker"  id="theme" name="theme">
                                <?php foreach ($_SESSION['themes'] as $theme => $theme_data) : ?>
                                    <option value="<?php echo $theme ?>"
                                        <?php if ($theme == $_POST['ybook']['theme']): ?>
                                            selected="selected"
                                        <?php endif; ?>
                                    >
                                        <?php echo $theme_data['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 text-center">
                            <input type="hidden" name="orig_theme" value="<?php echo $_POST['ybook']['theme'] ?>" />
                            <button class="btn btn-primary py-4 px-5" type="submit">Apply Theme</button>
                        </div>
                </div>
            </form>
            <div class="row g-3 m-2 mt-0">
                <div class="col-sm-6">
                    <p class="h5 text-primary mb-0">Cover Page</p> 
                    <form action="draft.php?m=upload&type=image&batch=<?php echo $_GET['batch'] ?>" method="POST" enctype="multipart/form-data" class="p-3">
                        <div class="row m-1">
                            <div class="col-sm-5">
                                <img class="img-fluid " src="<?php echo $_POST['ybook']['images']['ybook_cover'] ?>" width="100%" alt="">
                            </div>
                            <div class="col-sm-7">
                                <input type="file" name="uploaded_file" accept="image/*" class="form-control form-control-lg" id="uploaded_file" />
                                <p class="text-muted mt-0">
                                    <small>
                                        <strong>Note:</strong> 
                                        <em>This image will be used as front page in the print-version of the yearbook.</em>
                                    </small>
                                </p>
                                <input type="hidden" name="orig_fname" value="<?php echo basename($_POST['ybook']['images']['ybook_cover']) ?>" />
                                <input type="hidden" name="save" value="upload" />
                                <button class="btn btn-primary mt-2 p-3" type="submit">Upload Image</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <p class="h5 text-primary mb-0">Yearbook Thumbnail</p> 
                    <form action="draft.php?m=upload&type=image&batch=<?php echo $_GET['batch'] ?>" method="POST" enctype="multipart/form-data" class="p-3">
                        <div class="row m-1">
                            <div class="col-sm-5">
                                <img class="img-fluid " src="<?php echo $_POST['ybook']['images']['ybook_tile'] ?>" width="100%" alt="">
                            </div>
                            <div class="col-sm-7">
                                <input type="file" name="uploaded_file" accept="image/*" class="form-control form-control-lg" id="uploaded_file" />
                                <p class="text-muted mt-0">
                                    <small>
                                        <strong>Note:</strong> 
                                        <em>This image will be used as the yearbook thumbnail in the list of yearbooks.</em>
                                    </small>
                                </p>
                                <input type="hidden" name="orig_fname" value="<?php echo basename($_POST['ybook']['images']['ybook_tile']) ?>" />
                                <input type="hidden" name="save" value="upload" />
                                <button class="btn btn-primary mt-2 p-3" type="submit">Upload Image</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="container">
            <?php foreach ($_POST['data_list'] as $type => $page_type): ?>
                <div class="row g-3 mt-5">
                    <?php
                        $_GET['type'] = $type;
                        $_POST['title'] = $_POST[$type]['title'];
                        if ($page_type == 'uploaded') {
                            $_POST['headers'] = $_POST[$type]['headers'];
                            $_POST['data'] = $_POST[$type]['data'];
                        }
                    ?>
                    <?php if ($page_type == 'uploaded'): ?>
                        <div class="row g-2">
                            <form method="POST" enctype="multipart/form-data" 
                                action="draft.php?m=upload&type=<?php echo $_GET['type'] ?>&batch=<?php echo $_GET['batch'] ?>" >
                                
                                <?php if ($_GET['type'] == 'grad_song' || $_GET['type'] == 'tribute_song'): ?>
                                    <div class="row g-3">
                                        <p class="text-primary text-uppercase mb-2">Select TXT file (.txt) to upload <?php echo $_POST['title'] ?> list</p>
                                        <div class="col-md-9">
                                            <input type="file" name="uploaded_file" accept="text/txt" class="form-control form-control-lg" id="uploaded_file" />
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <input type="hidden" name="save" value="upload" />
                                            <button class="btn btn-primary py-3 px-5" type="submit">Upload</button>
                                        </div>
                                        <p class="text-muted mt-0">
                                            <small>
                                                <strong>Note:</strong> 
                                                The TXT file should contain the lyrics of the song with the <em>title</em> and <em>singer</em> as the first two lines. 
                                            </small>
                                        </p>
                                    </div>
                                <?php else: ?>
                                    <div class="row g-3">
                                        <p class="text-primary text-uppercase mb-2">Select TSV (Tab Separated Values) file (.txt) to upload <?php echo $_POST['title'] ?> list</p>
                                        <div class="col-md-9">
                                            <input type="file" name="uploaded_file" accept="text/tsv" class="form-control form-control-lg" id="uploaded_file" />
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <input type="hidden" name="save" value="upload" />
                                            <button class="btn btn-primary py-3 px-5" type="submit">Upload</button>
                                        </div>
                                        <p class="text-muted mt-0">
                                            <small>
                                                <strong>Note:</strong> 
                                                    The TSV file should contain the following column headers - 
                                                    <em><?php echo implode(', ', $_POST['headers']) ?></em>
                                            </small>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>

                    <?php elseif ($page_type == 'image'): ?>
                        <center>
                                <img class="img-fluid ybook-page" src="<?php echo $_POST['theme_sel']['images'][$_GET['type']]?>" width="100%" alt="">
                        </center>
                    <?php endif; ?>

                    <div style="padding-top:30px">
                        <?php
                            $ui_file = 'views/ui_'.$_GET['type'].'.php';
                            if (is_file($ui_file)) {
                                require_once $ui_file;
                            }
                        ?>
                    </div>
                </div>
                <hr class="hr-blurry" />
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
    require_once 'views/ui_theme_list.php';
?>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<?php
    require_once 'views/footer.php';
?>
