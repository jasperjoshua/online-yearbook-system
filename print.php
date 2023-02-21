<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once 'config.php';
    require_once 'helper.php';
    require_once 'init.php';

    //print "<pre>"; print_r($_POST); print_r($_SESSION['ybook']); exit;
    if (!isset($_GET['batch'])) {
        # Redirect to create page when no batch entered
        header('Location: ./index.php');
        die();
    }
    //print "<pre>"; print_r($_POST); print_r($_SESSION['ybook']); exit;

    include_once 'models/sql_upload.php';
    $sql = new SQL_Upload; 
    include_once 'models/sql_ybook_themes.php';
    $theme = new SQL_Ybook_Themes; 

    $yearbook_key = $sql->getYearbookKey($_GET['batch']);
    $_SESSION['ybook']['batch_sel'] = $_GET['batch'];
    $ybook_dir = YBOOK_IMG_DIR.'/'.$_GET['batch'];
    //print "<pre>"; print_r($_FILES); print_r($_POST); print_r($_GET); exit;
    
    $_POST['sections'] = $sql->getYearBookSections();
    foreach ($_POST['sections'] as $type => $section_type) {
        $_POST[$type]['title'] = $sql->getDataTitle($type);
        $_POST[$type]['rows'] = $sql->getDataPageRows($type);
        if ($type == 'graduates') {
            $_POST['courses'] = $sql->getCourseList();
   
            $_POST['ybook_layout'] = $sql->getYearbookSettings($yearbook_key);
            $_POST['layout_cols'] = $_POST['ybook_layout']['Grad_Page_Cols'];
            $_POST['layout_rows'] = $_POST['ybook_layout']['Grad_Page_Rows'];
            $_POST['layout_profile'] = $_POST['ybook_layout']['Grad_Profile'];
            $_POST['graduate_list'] = $sql->getGraduatesByPage($yearbook_key, $_POST['layout_rows'], $_POST['layout_cols']);
            //print "<pre>"; print_r($_POST['graduate_list']); exit;
        } elseif ($section_type == 'uploaded') {
            $_POST[$type]['headers'] = $sql->getDataHeaders($type);
            $_POST[$type]['data'] = $sql->getUploadedData($type, $yearbook_key);
        } elseif ($section_type == 'image-multi-optional') {
            $_POST['image-multi-optional'][$type] = getImagesFromDir($ybook_dir, $type.'_page_');
        }
    }
    $_POST['data_list'] = $_POST['sections'];
    //print "<pre>"; print_r($_POST); exit;

    //print "<pre>"; print_r($_SESSION['ybook']); exit;
    $ybook_theme = $sql->getYearbookTheme($_GET['batch']);
    $_POST['theme_sel'] = $_SESSION['ybook']['themes'][$ybook_theme];
    $_POST['ybook'] = array(
        'batch' => $_GET['batch'],
        'theme' => $ybook_theme,
        'dir' => $ybook_dir,
        'images' => $_POST['theme_sel']['images'],
    );

    # Use images from yearbook img dir (uploaded) if available, instead of default theme images
    $theme->setYearbookImages($ybook_dir);
    
    //print "<pre>"; print_r(($_POST['theme_sel'])); print_r($_POST['ybook']); exit;
    $_POST['css_cls'] = 'ybook-flip';
    require_once 'views/ui_print.php';
    
?>