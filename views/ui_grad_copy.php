<center>
    <!-- The Graduates Page -->
    <?php foreach ($_POST['yb']['graduates'] as $course => $graduates): ?>
        <div class="p-3" style="background-image:url(<?php echo $_POST['cover_pics'][$course] ?>)">
            <div class="container-xxl text-center mt-0 pt-0 bg-dark">
                <h2 class=" pt-0 pb-2 text-primary text-xl"><br/>
                    <i class="fa fa-2x fa-user-graduate "></i>
                    THE GRADUATES
                </h2>
                <h3 class="mb-0 te xt-white"><?php echo $_POST['courses'][$course] ?></h3><br/>
            </div>
        </div>
        <?php foreach ($graduates as $page): ?>
            <div>
                <!-- Student Start -->
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
                                    <div class="rounded-circle overflow-hidden m-1">
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
                <!-- Student End -->    
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</center>