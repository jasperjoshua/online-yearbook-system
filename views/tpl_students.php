
        <!-- Student Start -->
        <div class="container-xxl pt-5 pb-3"  style="background: url(<?php echo $_POST['bg_img']?>); background-repeat: repeat;">
            <div class="container">
                <?php foreach ($_POST['students'] as $course => $pages): ?>
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Batch <?php echo $_POST['batch'] ?></h5>
                        <h1 class="mb-5"><?php echo $course ?></h1>
                    </div>
                    <div class="row g-4">
                        <?php foreach ($pages as $student): ?>
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="team-item text-center rounded overflow-hidden">
                                    <div class="rounded-circle overflow-hidden m-4">
                                        <img class="img-fluid" src="<?php echo $student['pic_path'] ?>" alt="">
                                    </div>
                                    <h5 class="mb-0"><?php echo $student['name'] ?></h5>
                                    <br/>
                                    <!-- 
                                    <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                                    <small>Magsija, Balilihan, Bohol</small>
                                    -->
                                    <div class="d-flex justify-content-center mt-3">
                                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Student End -->