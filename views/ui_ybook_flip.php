
<?php foreach ($_POST['data_list'] as $type => $page_type): ?>
        <?php
            $_GET['type'] = $type;
            $_POST['title'] = $_POST[$type]['title'];
            $_POST['rows'] = isset($_POST[$type]['rows']) ? $_POST[$type]['rows']: 0;
            if ($page_type == 'uploaded' && $type != 'graduates') {
                $_POST['headers'] = $_POST[$type]['headers'];
                $_POST['display'] = splitDataForDisplay($_POST[$type]['data']);
            }
        ?>

        <?php if ($page_type == 'image'): ?>
            <div class=" ybook-flip">
                <img class="img-fluid ybook-page text-center" src="<?php echo $_POST['theme_sel']['images'][$_GET['type']] ?>" width="100%" height="100%" alt="">
            </div>

        <?php elseif ($page_type == 'image-multi-optional'): ?>
            
            <?php foreach (array_values($_POST['image-multi-optional'][$type]) as $i => $img_path): ?>
                <div class=" ybook-flip">
                    <img class="img-fluid ybook-page text-center" src="<?php echo $img_path ?>" width="100%" height="100%" alt="">
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <?php
                $ui_file = 'views/flip_'.$_GET['type'].'.php';
                if (is_file($ui_file)) {
                    //print "<pre>"; print_r($_POST['display']); exit;
                    require_once $ui_file;
                }
            ?>
        <?php endif; ?>
<?php endforeach; ?>