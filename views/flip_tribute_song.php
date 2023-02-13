<?php foreach ($_POST['display'] as $_POST['data']): ?>
    <div>
        <center>
            <div class="container-fluid bg-light py-3 mb-5 ybook-flip" 
                style="background-image: url(<?php echo $_POST['theme_sel']['images']['song_bg_page'] ?>); "
            >  
                <?php include 'views/tpl_center.php' ?>
            </div>
        </center>
    </div>
<?php endforeach; ?>
<?php foreach ($_POST['display'] as $_POST['data']): ?>
    <div>
        <center>
            <div class="container-fluid bg-light py-3 mb-5 ybook-flip" 
                style="background-image: url(<?php echo $_POST['theme_sel']['images']['song_bg_page'] ?>); "
            >  
                <?php include 'views/tpl_song.php' ?>
            </div>
        </center>
    </div>
<?php endforeach; ?>
