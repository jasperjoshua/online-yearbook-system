<center>
<div class="container-fluid bg-light py-5 mb-5 <?php echo $_POST['css_cls'] ?>" 
    style="background-image: url(<?php echo $_POST['theme_sel']['images']['song_bg_page'] ?>); ">

    <div class="px-5 ms-xl-4 ">
        <span class="h1 fw-bold mb-0">
            <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
            TRIBUTE SONG
        </span>
    </div>

    <div class="container-fluid">
        <div class="row mt-0">
            <div class="col-sm-12">
                <?php if (isset($_POST['data']) && !empty($_POST['data']['center'])): ?>
                <div class="row mt-4">
                    <p class="h3 text-primary m-0"><?php echo $_POST['data']['center'][0] ?></p>
                    <p class="h5 text-dark m-0"><?php echo $_POST['data']['center'][1] ?></p>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-6 pt-3">
                <?php foreach($_POST['data']['left'] as $value): ?>
                    <p class="text-muted m-0"><?php echo $value ?></p>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-6">
                <?php foreach($_POST['data']['right'] as $value): ?>
                    <p class="text-muted m-0"><?php echo $value ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</center>

