
        <!-- Theme List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Available</h5>
                    <h1 class="mb-5">Yearbook Themes</h1>
                </div>
                <div class="row g-2">
                    
                    <?php foreach ($_SESSION['ybook']['themes'] as $theme => $theme_data): ?>
                        
                        <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item rounded pt-3">
                                <img class="img-fluid " src="<?php echo $theme_data['images']['ybook_tile'] ?>" width="100%" alt="">
                                <div class="p-4 text-success pt-20">
                                    <!--
                                    <i class="fa fa-3x fa-user-graduate text-white mb-4"></i>
                                    <h5 class="text-white bg-primary">Batch <?php echo $ybook ?></h5>
                                    <p><?php echo $desc ?></p>
                                    -->
                                    <h5 class="text-white bg-primary p-3"><?php echo $theme_data['name'] ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <!-- Theme List End -->
        