<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['ybook']['logged']) || $_SESSION['ybook']['logged'] == 'guest') {
    //header('Location: ./index.php');
    //die();
}

require_once 'config.php';
require_once 'helper.php';

//print "<pre>"; print_r($_POST); print_r($_SESSION['ybook']); exit;
if (!isset($_GET['batch'])) {
    # Redirect to create page when no batch entered
    header('Location: ./create.php');
    die();
}
//print "<pre>"; print_r($_POST); print_r($_SESSION['ybook']); exit;

include_once 'models/sql_upload.php';
$sql = new SQL_Upload; 
include_once 'models/sql_ybook_themes.php';
$theme = new SQL_Ybook_Themes; 


$yearbook_key = $sql->getYearbookKey($_GET['batch']);

$_POST['sections'] = $sql->getYearBookSections();
$_POST['bg_images'] = $sql->getBackgroundImages();
$_POST['data_list'] = array_merge($_POST['sections'], $_POST['bg_images']);
foreach ($_POST['data_list'] as $type => $uploaded) {
    $_POST[$type]['title'] = $sql->getDataTitle($type);
    $_POST[$type]['rows'] = $sql->getDataPageRows($type);
    if ($type == 'graduates') {
        $_POST['courses'] = $sql->getCourseList();
        $_POST['layout_rows'] = 2;
        $_POST['layout_cols'] = 3;
        $_POST['graduate_list'] = $sql->getGraduatesByPage($yearbook_key, $_POST['layout_rows'], $_POST['layout_cols']);
        //print "<pre>"; print_r($_POST['graduate_list']); exit;
    } elseif ($uploaded) {
        $_POST[$type]['headers'] = $sql->getDataHeaders($type);
        $_POST[$type]['data'] = $sql->getUploadedData($type, $yearbook_key);
    }
}
//print "<pre>"; print_r($_SESSION['ybook']); exit;
$ybook_dir = YBOOK_IMG_DIR.'/'.$_GET['batch'];
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

$_POST['css_cls'] = 'ybook-flip';
require_once 'views/ui_ybook.php';

?>