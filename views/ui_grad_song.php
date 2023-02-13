<?php foreach ($_POST['display'] as $i => $_POST['data']): ?>
    <?php if (($i % 2) == 0): ?>
        <div class="row m-0">
    <?php endif; ?>
            <div class="col-sm-6">
                <center>
                <div class="container-fluid bg-light py-3 m-0 mb-5 p-0 ybook-page" 
                    style="background-image: url(<?php echo $_POST['theme_sel']['images']['song_bg_page'] ?>); "
                >
                    <?php include 'views/tpl_song.php' ?>
                </div>
                </center>
            </div>
    <?php if (($i % 2) == 1): ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php if ((count($_POST['display']) % 2) == 1): ?>
    </div>
<?php endif; ?>