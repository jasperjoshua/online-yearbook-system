<div class="px-3 ms-xl-4 ">
    <span class="h4 fw-bold m-0">
        <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
        <?php echo $_POST['title'] ?>
    </span>
</div>

<div class="container-fluid">
    <div class="row m-0">
        <div class="col-sm-12">
            <div class="row mt-4 mb-4">
                <?php if (isset($_POST['data']['song_title']) && isset($_POST['data']['singer'])): ?>
                    <p class="h6 text-primary m-0"><strong><?php echo $_POST['data']['song_title'] ?></strong></p>
                    <p class="small text-dark m-0"><strong><?php echo $_POST['data']['singer'] ?></strong></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-12 mt-0">
            <?php foreach($_POST['data']['center'] as $value): ?>
            <div class="row mt-1" style="text-align:center;">
                <p class="small text-dark m-0"><?php echo $value ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-6 mt-0">
            <?php foreach($_POST['data']['left'] as $value): ?>
            <div class="row mt-1" style="text-align:center;">
                <p class="small text-dark m-0"><?php echo $value ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-6 m-0">
            <?php foreach($_POST['data']['right'] as $value): ?>
            <div class="row mt-1" style="text-align:center;">
                <p class="small text-dark m-0"><?php echo $value ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-12">
            <?php foreach($_POST['data']['bottom'] as $value): ?>
            <div class="row mt-1" style="text-align:center;">
                <p class="small text-dark m-0"><?php echo $value ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>