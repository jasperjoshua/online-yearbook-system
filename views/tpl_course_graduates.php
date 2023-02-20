<?php
    $profile_style = $_POST['layout_profile'];
?>
<div class=" ybook-flip">
    <img class="img-fluid ybook-page text-center" src="<?php echo $_POST['theme_sel']['images'][$_POST['course_sel'].'_cover'] ?>" width="100%" height="100%" alt="">
</div>

<?php foreach ($_POST['graduate_list'][$_POST['course_sel']] as $page => $list): ?>
<div>
    <center>
        <div class="container-fluid bg-light py-3 mb-0 ybook-flip" 
            style="background-image: url(<?php echo $_POST['theme_sel']['images']['content_bg_page'] ?>); "
        >  
            <?php foreach ($list as $row => $col_students): ?>   
                
                <div class="row">
                    <?php foreach ($col_students as $col => $student): ?>
                        <div class="col-md-<?php echo (12/$_POST['layout_cols'])?> m-0">
                            <div class="team-item text-center <?php echo $profile_style ?> ">
                                <div class="<?php echo $profile_style ?>-circle overflow-hidden mt-2">
                                    <img class="img-fluid" src="<?php echo $student['pic_path'] ?>" alt="">
                                </div>
                                <h6 class="mb-0"><?php echo $student['Last_Name'] ?>,</h5>
                                <p class="small text-dark m-0"><?php echo $student['First_Name'] ?></p>
                                <!--
                                <p class="small text-muted m-0"><?php echo $_POST['courses'][$_POST['course_sel']]['Course_Name'] ?></p>
                                -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php for ($filler=1; $filler < ($_POST['layout_cols']-$col); $filler++): ?>
                        <div class="col-md-<?php echo (12/$_POST['layout_cols'])?>">
                            &nbsp;
                        </div>
                    <?php endfor; ?>
                </div>

            <?php endforeach; ?>
        </div>
    </center>
</div>
<?php endforeach; ?>

<?php if (($page % 2) == 1): ?>
    <center>
        <div class=" ybook-flip">
            <img class="img-fluid ybook-page text-center" src="<?php echo $_POST['theme_sel']['images'][$_POST['course_sel'].'_filler_page'] ?>" width="100%" height="100%" alt="">
        </div>    
    </center>
<?php endif; ?>

                            