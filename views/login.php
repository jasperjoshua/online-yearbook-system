<?php
    require_once 'views/header.php';
?> 

    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">

                    <div class="px-5 ms-xl-4 ">
                        <span class="h1 fw-bold mb-0">
                            <img class="img-fluid " src="img/bisu_logo.png" width="70%" alt="">
                        </span>
                    </div>

                    <div class="d-flex align-items-center px-5 ms-xl-4 mt-1 pt-1 pt-xl-0 mt-xl-n5">
                        <form action="index.php?menu=login" method="POST" style="width: 30rem;">
                            <?php require_once 'views/ui_alert.php' ?>
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"></h3>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example18">Username</label>
                                <input name="username" type="text" id="form2Example18" class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example28">Password</label>
                                <input  name="password" type="password" id="form2Example28" class="form-control form-control-lg" />
                            </div>
                            <div class="pt-1 mb-4 log">
                                <input type="hidden" name="login" value="submit" />
                                <button  type="submit">LOG IN</button>
                            </div>
                        </form>
                   
                    </div>

                            </div>
                            <div class="col-md-6">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="img/login_img0.png" class="d-block w-100" alt="login_1">
                </div>
                <div class="carousel-item">
                <img src="img/login_img1.png" class="d-block w-100" alt="login_2">
                </div>
                <div class="carousel-item">
                <img src="img/login_img2.png" class="d-block w-100" alt="login_3">
                </div>
            </div>
            </div>
            </div>
                 
               
            </div>  
                           
            </div>
        </div>
    </section>
   
<?php
    require_once 'views/footer.php';
?>
