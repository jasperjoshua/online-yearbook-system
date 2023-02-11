<div>
<center>
<div class="container-fluid bg-light py-3 mb-5 ybook-flip" 
    style="background-image: url(<?php echo $_POST['theme_sel']['images']['song_bg_page'] ?>); ">

    <div class="px-5 ms-xl-4 ">
        <span class="h4 fw-bold mb-0">
            <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
            BISU HYMN
        </span>
    </div>

    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-sm-12">
                <?php if (isset($_POST['data']) && !empty($_POST['data']['center'])): ?>
                <div class="row mt-0">
                    <p class="h6 text-primary m-0 pt-4">INTRO:</p>
                    <p class="text-dark m-0">A dream, a thought, a reality</p>
                    <p class="text-dark m-0">Bohol Island State University</p>

                    <p class="h6 text-primary m-0 pt-3">REFRAIN:</p>
                    <p class="text-dark m-0">Sail BISU sail</p>
                    <p class="text-dark m-0">From the North to South, East to West</p>
                    <p class="text-dark m-0">Fly BISU fly</p>
                    <p class="text-dark m-0">From the Island of Bohol to the World</p>

                    <p class="h6 text-primary m-0 pt-3">I.</p>
                    <p class="text-dark m-0">Happy are we as we go through</p>
                    <p class="text-dark m-0">Nurtured with thoughts of wisdom</p>
                    <p class="text-dark m-0">Leading towards certainty</p>
                    <p class="text-dark m-0">As we cross the Land</p>

                    <p class="h6 text-primary m-0 pt-3">II.</p>
                    <p class="text-dark m-0">You are everybody's dream</p>
                    <p class="text-dark m-0">Whose vision and mission bring</p>
                    <p class="text-dark m-0">The values and expertise</p>
                    <p class="text-dark m-0">Of Scientists and Technologists</p>

                    <p class="h6 text-primary m-0 pt-3">CODA:</p>
                    <p class="text-dark m-0">A Dream, a Thought, a Reality</p>
                    <p class="text-dark m-0">Bohol Island State University</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</center>
</div>
