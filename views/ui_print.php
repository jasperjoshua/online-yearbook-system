<?php
    require_once 'views/header.php';
    //require_once 'views/menu.php';
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script type="text/javascript">
    $(document).ready(function() {  

        var PDF_Width = 460;
        var PDF_Height = 600;
        var pdf_cls = "pdf-page";

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const batch = urlParams.get('batch');
        var pdf_title = "BISU-BC_Class_of_"+batch+"_Yearbook";

        $("#download").on("click", function () {
            var HTML_Width = $(".html-content").width();
            var HTML_Height = $(".html-content").height();
            var top_left_margin = 0
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
            //console.log($(".html-content")[0]);

            html2canvas($(".html-content")[0]).then(function(canvas) {
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var x_position = -(PDF_Width-45);
                pdf.addImage(imgData, 'JPG', x_position, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', x_position, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save(pdf_title+'.pdf'); // Generated PDF
            });
            //$(".html-content").hide();
        });
    });
</script>

<div class="container-xxl bg-white p-0">
    <div class="form-floating">
        <div class="text-center wow fadeInUp mt-5 pt-5" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Print a Yearbook</h5>
            <h1 class="mb-5">
                CLASS of <?php echo $_SESSION['ybook']['batch_sel'] ?>
            </h1>
            <button id="download" class="btn btn-primary py-4 px-5" type="submit">
                <i class="bi bi-file-earmark-arrow-down"></i>
                Download PDF
            </button>
        </div>
        <center>
            <div class="container py-5">
                <div class="html-content" id="printContainer"> 
                    <?php foreach ($_POST['data_list'] as $type => $page_type): ?>
                            <?php
                                $_GET['type'] = $type;
                                $_POST['title'] = $_POST[$type]['title'];
                                if ($page_type == 'uploaded') {
                                    $_POST['headers'] = $_POST[$type]['headers'];
                                    $_POST['data'] = $_POST[$type]['data'];
                                }
                            ?>

                            <?php if ($page_type == 'image'): ?>
                                <div>
                                    <img class="img-fluid ybook-page text-center" src="<?php echo $_POST['theme_sel']['images'][$_GET['type']]?>" width="100%" height="100%" alt="">
                                </div>
                                    

                            <?php else: ?>
                                <?php
                                    $ui_file = 'views/flip_'.$_GET['type'].'.php';
                                    if (is_file($ui_file)) {
                                        require_once $ui_file;
                                    }
                                ?>
                            <?php endif; ?>
                    <?php endforeach; ?>                                      
                </div>
            </div>
        </center>
    </div>
</div>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<?php
    require_once 'views/footer.php';
?>
