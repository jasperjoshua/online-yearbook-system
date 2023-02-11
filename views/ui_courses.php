<center>
    <div class="px-5 ms-xl-4 ">
        <span class="h1 fw-bold mb-0">
            <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
            COURSES
        </span>
    </div>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-sm-12">
                <?php foreach($_POST['data']['center'] as $value): ?>
                <div class="row mt-4">
                    <p class="h6 text-blank m-0"><?php echo $value['Course_Name'] ?> (<?php echo $value['Course_Code'] ?>) </p>
                    <p class="text-muted m-0"><?php echo constant($value['Department']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</center>

