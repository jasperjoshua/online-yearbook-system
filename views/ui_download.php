<?php
    require_once 'views/header.php';
    //require_once 'views/menu.php';
?>
<script type="text/javascript">
    $(document).ready(function() {  

        var PDF_Width = 461;
        var PDF_Height = 600;
        var pdf_cls = "pdf-page";

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const batch = urlParams.get('batch');
        var pdf_title = "BISU-BC_Class_of_"+batch+"_Yearbook";

        //Create PDf from HTML...
        $('#downloadx').on('click', function () { 

            var pdf_cls = "pdf-page";

            var HTML_Width = $("."+pdf_cls).width();
            var HTML_Height = $("."+pdf_cls).height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var PDF_Width = 461;
            var PDF_Height = 600;
            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
            html2canvas(document.querySelector("#capture")).then(canvas => {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                pdf.addImage(imgData, 'JPG');
            });

            pdf.save("BISU-BC_Class_of_"+batch+"_Yearbook.pdf");
            $("."+pdf_cls).hide();

        });

        $("#download").live("click", function () {
            var divContents = $("."+pdf_cls).html();
            var printWindow = window.open('', '', 'height='+PDF_Height',width='+PDF_Width);
                printWindow.document.write('<html><head><title>pdf_title</title>');
                printWindow.document.write('</head><body >');
                printWindow.document.write(divContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
        });
    });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

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
                <div class="tab-content" id="printContainer"> 
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
                                    <center>
                                    <div class="ybook-flip pdf-page">
                                        <img class="img-fluid ybook-page text-center" src="<?php echo $_POST['theme_sel']['images'][$_GET['type']]?>" width="100%" height="100%" alt="">
                                    </div>
                                    </center>
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
