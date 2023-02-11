<?php
    require_once 'views/header.php';
    //require_once 'views/menu_ybook.php';
?>
    <div class="flipbook-viewport p-0">
        <!--<center class="mt-5 pt-5">
            <a  href="print.php?batch=<?php echo $_GET['batch'] ?>" 
                class="btn btn-primary py-2 px-4 m-2" id="btnPrint"
            >
                Download or Print This Yearbook
            </a>
        </center>-->
        <div class="container"> 
            <div class="flipbook" id="printContainer"> 
                <?php require_once 'views/ui_ybook_flip.php' ?>
            </div>
        </div>
    </div> 


    
<script type="text/javascript">

    function loadApp() {
        // Create the flipbook
        $('.flipbook').turn({
                // Width
                width:922,
                
                // Height
                height:600,

                // Elevation
                elevation: 50,
                
                // Enable gradients
                gradients: true,
                
                // Auto center this flipbook
                autoCenter: true
        });
    }

    // Load the HTML4 version if there's not CSS transform
    yepnope({
        test : Modernizr.csstransforms,
        yep: ['turnjs/lib/turn.js'],
        nope: ['turnjs/lib/turn.html4.min.js'],
        both: ['turnjs/css/basic.css'],
        complete: loadApp
    });

</script>

<?php
    require_once 'views/footer_ybook.php';
?>


