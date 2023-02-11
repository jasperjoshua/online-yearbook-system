<?php

$half = floor(count($_POST['data']['left']) / 2);
$left_1 = array_slice($_POST['data']['left'], 0, $half);
$left_2 = array_slice($_POST['data']['left'], $half);

$half = floor(count($_POST['data']['right']) / 2);
$right_1 = array_slice($_POST['data']['right'], 0, $half);
$right_2 = array_slice($_POST['data']['right'], $half);

?>

<div>
<center>
<div class="container-fluid bg-light py-3 mb-5 <?php echo $_POST['css_cls'] ?>" 
    style="background-image: url(<?php echo $_POST['theme_sel']['images']['content_bg_page'] ?>); ">

    <div class="px-5 ms-xl-4 ">
        <span class="h4 fw-bold mb-0">
            <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
            FACULTY / TEACHING STAFF
        </span>
    </div>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-sm-12">
                <?php foreach($_POST['data']['center'] as $value): ?>
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0">
                        <small>
                            <?php echo $value['Position'] ?>
                            <?php if ($value['Office'] != ''): ?>
                                 - <?php echo $value['Office'] ?>
                            <?php endif; ?>
                        </small>
                    </p>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-6 mt-0">
                <?php foreach($left_1 as $value): ?>
                <div class="row mt-3">
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0">
                        <small>
                            <?php echo $value['Position'] ?>
                            <?php if ($value['Office'] != ''): ?>
                                 - <?php echo $value['Office'] ?>
                            <?php endif; ?>
                        </small>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-6 mt-0">
                <?php foreach($left_2 as $value): ?>
                <div class="row mt-3">
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0">
                        <small>
                            <?php echo $value['Position'] ?>
                            <?php if ($value['Office'] != ''): ?>
                                 - <?php echo $value['Office'] ?>
                            <?php endif; ?>
                        </small>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</center>
</div>

<div>
<center>
<div class="container-fluid bg-light py-3 mb-5 <?php echo $_POST['css_cls'] ?>" 
    style="background-image: url(<?php echo $_POST['theme_sel']['images']['content_bg_page'] ?>); ">

    <div class="px-5 ms-xl-4 ">
        <span class="h4 fw-bold mb-0">
            <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
            FACULTY / TEACHING STAFF
        </span>
    </div>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-sm-6 mt-2">
                <?php foreach($right_1 as $value): ?>
                <div class="row mt-3">
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0">
                        <small>
                            <?php echo $value['Position'] ?>
                            <?php if ($value['Office'] != ''): ?>
                                 - <?php echo $value['Office'] ?>
                            <?php endif; ?>
                        </small>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-6 mt-2">
                <?php foreach($right_2 as $value): ?>
                <div class="row mt-3">
                    <p class="h6 text-blank m-0"><?php echo $value['Full_Name'] ?></p>
                    <p class="text-muted m-0">
                        <small>
                            <?php echo $value['Position'] ?>
                            <?php if ($value['Office'] != ''): ?>
                                 - <?php echo $value['Office'] ?>
                            <?php endif; ?>
                        </small>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</center>
</div>

