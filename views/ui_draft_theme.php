<?php
    require_once 'views/header.php';
    require_once 'views/menu_create.php';
?>
<script type="text/javascript">
    $(document).ready(function() {  
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const img_type = urlParams.get('img_type');
        if (document.getElementById(img_type)) {
            document.getElementById(img_type).click();
        }
    });
</script>

<div class="container-xxl bg-white p-0">
    <div class="form-floating">
        <div class="text-center wow fadeInUp mt-5 pt-5" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Create a Yearbook</h5>
            <h1 class="mb-5">Draft Yearbook for BATCH <?php echo $_SESSION['ybook']['batch_sel'] ?>
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
                                <?php foreach ($_SESSION['ybook']['themes'] as $theme => $theme_data) : ?>
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
                        <div class="col-md-3 text-left">
                            <input type="hidden" name="orig_theme" value="<?php echo $_POST['ybook']['theme'] ?>" />
                            <button class="btn btn-primary py-4 px-5" type="submit">Apply Theme</button>
                        </div>
                </div>
            </form>
            </div>
        </div>
        <div class="container py-5">
            <hr class="hr-blurry" />
            <div class="container">
                <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                    <?php foreach ($_POST['sections'] as $type => $page_type): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link 
                            <?php if ($_POST['active'] == $type): ?>
                                active
                            <?php endif; ?>
                            " data-bs-toggle="tab" type="button" role="tab" aria-selected="false" 
                            id="<?php echo $type ?>" data-bs-target="#<?php echo $type ?>-pane" aria-controls="<?php echo $type ?>-pane" >
                            <?php echo $_POST[$type]['title'] ?>                                               
                        </button>
                    </li>
                    <?php endforeach; ?>
                    <li class="nav-item dropdown ">
                        <a class="nav-link 
                            <?php if ($_POST['active'] == 'image'): ?>
                                active
                            <?php endif; ?>
                            dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Background Images
                        </a>
                        <div id="bg_images-select" class="dropdown-menu">
                            <?php foreach ($_POST['bg_images'] as $img_type => $images): ?>
                                <?php foreach ($images as $type => $img_title): ?>
                                    <a class="dropdown-item 
                                        <?php if (isset($_POST['image_type']) && $_POST['image_type'] == $type): ?>
                                            selected
                                        <?php endif; ?>
                                        " href="#<?php echo $type ?>-pane" id="<?php echo $type ?>"
                                        data-bs-toggle="tab" role="tab" aria-selected="false" aria-controls="<?php echo $type ?>-pane">
                                        <?php echo $img_type.' '.$img_title ?>  
                                    </a>
                                <?php endforeach; ?>
                                <?php if ($img_type == 'Common'): ?>
                                    <div class="dropdown-divider"></div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </li>
                </ul>
            </div>
            <hr class="hr-blurry" />
            <div class="container mt-5">
                <div class="tab-content" id="myTabContent">              
                    <?php foreach ($_POST['data_list'] as $type => $page_type): ?>
                        <div class="tab-pane fade
                            <?php if ($_POST['active'] == $type): ?>
                                show active
                            <?php endif; ?>
                            " id="<?php echo $type ?>-pane" role="tabpanel" aria-labelledby="<?php echo $type ?>" tabindex="0"
                        >  
                            <?php
                                $_GET['type'] = $type;
                                $_POST['title'] = $_POST[$type]['title'];
                                $_POST['rows'] = $_POST[$type]['rows'];
                                if ($page_type == 'uploaded') {
                                    $_POST['headers'] = $_POST[$type]['headers'];
                                    $_POST['display'] = splitDataForDisplay($_POST[$type]['data']);
                                }
                            ?>
                            
                            <p class="h4 text-primary ff-secondary fw-normal text-center mb-2"><?php echo $_POST[$type]['title'] ?></p> 
                            <?php if ($page_type == 'uploaded'): ?>
                                <div class="row g-2">
                                    <form method="POST" enctype="multipart/form-data" 
                                        action="draft.php?m=upload&type=<?php echo $_GET['type'] ?>&batch=<?php echo $_GET['batch'] ?>" >
                                        
                                        <?php if ($_GET['type'] == 'grad_song' || $_GET['type'] == 'tribute_song'): ?>
                                            <div class="row g-3">
                                                <p class="text-secondary text-uppercase mb-2">Select TXT file (.txt) to upload <?php echo $_POST['title'] ?> list</p>
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
                                                <p class="text-secondary text-uppercase mb-2">Select TSV (Tab Separated Values) file (.tsv) to upload <?php echo $_POST['title'] ?> list</p>
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
                                <form action="draft.php?m=upload&type=image&batch=<?php echo $_GET['batch'] ?>&img_type=<?php echo $type ?>" method="POST" enctype="multipart/form-data" class="p-3">
                                    <div class="row m-1">
                                        <div class="col-sm-5">
                                            <img class="img-fluid ybook-page" src="<?php echo $_POST['theme_sel']['images'][$type]?>" width="100%" alt="">
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="file" name="uploaded_file" accept="image/*" class="form-control form-control-lg" id="uploaded_file" />
                                            <p class="text-muted mt-0">
                                                <small>
                                                    <strong>Note:</strong> 
                                                    <em>This image will be used in the print-version of the yearbook.</em>
                                                </small>
                                            </p>
                                            <input type="hidden" name="orig_fname" value="<?php echo basename($_POST['ybook']['images'][$type]) ?>" />
                                            <input type="hidden" name="image_type" value="<?php $type ?>" />
                                            <input type="hidden" name="save" value="upload" />
                                            <button class="btn btn-primary mt-2 p-3" type="submit">Upload Image</button>
                                        </div>
                                    </div>
                                </form>

                            <?php endif; ?>

                            <?php
                                $ui_file = 'views/ui_'.$_GET['type'].'.php';
                                if (is_file($ui_file)) {
                                    require_once $ui_file;
                                }
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <hr class="hr-blurry" />
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
