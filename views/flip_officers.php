<?php

$center = array_shift($_POST['data']['center']);
$bottom = array_pop($_POST['data']['center']);
$half = floor(count($_POST['data']['center']) / 2);
$_POST['data']['left'] = array_slice($_POST['data']['center'], 0, $half);
$_POST['data']['right'] = array_slice($_POST['data']['center'], $half);
$_POST['data']['center'] = array($center);
$_POST['data']['bottom'] = array($bottom);

?>

<div>
<center>
    <div class="container-fluid bg-light py-4 mb-5 <?php echo $_POST['css_cls'] ?>" 
    style="background-image: url(<?php echo $_POST['theme_sel']['images']['content_bg_page'] ?>); ">

    <div class="px-5 ms-xl-4 ">
        <span class="h4 fw-bold mb-0">
            <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
            BATCH OFFICERS
        </span>
    </div>
    <div class="container-fluid">
        <div class="row mt-1">
            <div class="col-sm-12 mt-4">
                <?php foreach($_POST['data']['center'] as $value): ?>
                <div class="row mt-4">
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0"><?php echo $value['Position'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-6 mt-4">
                <?php foreach($_POST['data']['left'] as $value): ?>
                <div class="row mt-4">
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0"><?php echo $value['Position'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-6 mt-4">
                <?php foreach($_POST['data']['right'] as $value): ?>
                <div class="row mt-4">
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0"><?php echo $value['Position'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-12 mt-5 pt-2">
                <?php foreach($_POST['data']['bottom'] as $value): ?>
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0"><?php echo $value['Position'] ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</center>
</div>

