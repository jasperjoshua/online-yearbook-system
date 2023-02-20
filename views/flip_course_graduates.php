<?php

$_POST['profile_style'] = 'square';

?>

<!-- Student Start -->
<div>
    <div class="container-xxl">
        <div class="border border-primary p-2 m-1 mt-4 mb-3">
            <div class="text-center">
                <p class="section-title ff-secondary text-center text-primary fw-normal">
                    Batch <?php echo $_POST['batch'] ?>
                </p>
                <h5 class="mb-2"><?php echo $_POST['courses'][$course] ?></h5>
            </div>
            <div class="row g-3">
            <?php foreach ($page as $student): ?>
                <div class="col-md-3">
                    <div class="text-center rounded overflow-hidden">
                        <div class="<?php echo $_POST['profile_style'] ?>-circle overflow-hidden m-1">
                            <img class="img-fluid" src="<?php echo $student['pic_path'] ?>" alt="<?php echo $student['name'] ?>">
                        </div>     
                        <span style="font-size:0.7rem"><?php echo $student['name'] ?>
                        </span>
                        <!-- <p style="font-size:0.6rem">Magsija, Balilihan, Bohol</p> -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Student End -->    