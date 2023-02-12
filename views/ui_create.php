<?php
    require_once 'views/header.php';
    require_once 'views/menu_create.php';
?>

    <div class="container-xxl bg-white p-3">

        <div class="form-floating">
            <form action="create.php?m=create" method="POST" enctype="multipart/form-data">
                <?php require_once 'views/ui_alert.php' ?>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="batch" name="Batch" placeholder="XXXX">
                            <label for="batch">Enter Batch (e.g 2022)</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-control selectpicker"  id="theme" name="Theme">
                                <?php foreach ($_SESSION['ybook']['themes'] as $theme => $theme_data) : ?>
                                    <option value="<?php echo $theme ?>"><?php echo $theme_data['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="theme">Select Theme</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <input type="hidden" name="create" value="ybook" />
                        <button class="btn btn-primary py-3 px-5" type="submit">Create Yearbook</button>
                    </div>
                </div>
            </form>
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
