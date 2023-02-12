<?php  
    //print "<pre>"; print_r($_POST['ybook_list']); exit;
?>
    <?php if (!empty($_POST['ybook_list'])): ?>

        <!-- Yearbook List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Graduates</h5>
                    <h1 class="mb-5">Explore Our Yearbooks</h1>
                </div>
                <div class="row g-2">
                    
                    <?php foreach ($_POST['ybook_list'] as $batch => $ybook_data): ?>
                        <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="ybook.php?batch=<?php echo $batch ?>" target="_blank">
                                <div class="service-item rounded pt-3">
                                    <img class="img-fluid " src="<?php echo $ybook_data['images']['ybook_cover'] ?>" width="100%" alt="">
                                    <div class="p-4 text-success pt-20">
                                        <!--
                                        <i class="fa fa-3x fa-user-graduate text-white mb-4"></i>
                                        <h5 class="text-white bg-primary">Batch <?php echo $ybook ?></h5>
                                        <p><?php echo $desc ?></p>
                                        -->
                                        <h5 class="text-center text-white bg-primary p-3">Class of <?php echo $batch ?></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <!-- Yearbook List End -->

    <?php endif; ?>