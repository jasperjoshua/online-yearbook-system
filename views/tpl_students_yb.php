
        <!-- Student Start -->
        <div class="container-xxl">
            <div>
                <div class="text-center">
                    <p class="section-title ff-secondary text-center text-primary fw-normal">
                        Batch <?php echo $_POST['batch_sel'] ?>
                    </p>
                    <h5 class="mb-5"><?php echo $_POST['course_sel'] ?></h5>
                </div>
                <div class="row g-3">
                <?php foreach ($_POST['students'] as $student): ?>
                    <div class="col-md-4">
                        <div class="text-center rounded overflow-hidden">
                            <div class="rounded-circle overflow-hidden m-1">
                                <img class="img-fluid" src="<?php echo $student['pic_path'] ?>" alt="">
                            </div>     
                            <p class="mb-0"><?php echo $student['name'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- Student End -->