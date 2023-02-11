<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['logged']) || $_SESSION['logged'] == 'guest') {
    //header('Location: ./index.php');
    //die();
}

require_once 'config.php';
require_once 'helper.php';

//print "<pre>"; print_r($_POST); print_r($_SESSION); exit;
if (!isset($_GET['batch'])) {
    # Redirect to create page when no batch entered
    header('Location: ./create.php');
    die();
}
//print "<pre>"; print_r($_POST); print_r($_SESSION); exit;

include_once 'models/sql_upload.php';
$sql = new SQL_Upload; 
include_once 'models/sql_ybook_themes.php';
$theme = new SQL_Ybook_Themes; 


$yearbook_key = $sql->getYearbookKey($_GET['batch']);

$_POST['data_list'] = array(
    'ybook_cover' => 'image',
    'vision_mission' => 'static',
    'officials' => 'uploaded',
    'board' => 'uploaded',
    'faculty' => 'uploaded',
    'congrats' => 'image',
    'ybook_cover' => 'image',
    'BSIT_cover' => 'image',
    'BSIT_filler_page' => 'image',
    'BSCS_cover' => 'image',
    'BSCS_filler_page' => 'image',
    'BS-ELEC_cover' => 'image',
    'BS-ELEC_filler_page' => 'image',
    'BS-ELEX_cover' => 'image',
    'BS-ELEX_filler_page' => 'image',
    'BSIT-FPSM_cover' => 'image',
    'BSIT-FPSM_filler_page' => 'image',
    //'graduates' => 'uploaded',
    //'awardees' => 'uploaded',
    'grad_song' => 'uploaded',
    'tribute_song' => 'uploaded',
    'bisu_hymn' => 'static',
    'officers' => 'uploaded',
    'ybook_back' => 'image',
);
foreach ($_POST['data_list'] as $type => $uploaded) {
    if ($uploaded) {
        $_POST[$type]['title'] = $sql->getDataTitle($type);
        $_POST[$type]['headers'] = $sql->getDataHeaders($type);
        $_POST[$type]['data'] = $sql->getUploadedData($type, $yearbook_key);
    }
}

//print "<pre>"; print_r($_POST['graduates']); exit;
//print "<pre>"; print_r($_SESSION); exit;
$ybook_dir = YBOOK_IMG_DIR.'/'.$_GET['batch'];
$ybook_theme = $sql->getYearbookTheme($_GET['batch']);
$_POST['theme_sel'] = $_SESSION['themes'][$ybook_theme];
$_POST['ybook'] = array(
    'batch' => $_GET['batch'],
    'theme' => $ybook_theme,
    'dir' => $ybook_dir,
    'images' => $_POST['theme_sel']['images'],
);

# Use ybook_cover from yearbook img dir if available
$img_fname = basename($_POST['ybook']['images']['ybook_cover']);
$ybook_img_file = $ybook_dir.'/'.$img_fname;
if (is_file($ybook_img_file)) {
    $_POST['ybook']['images']['ybook_cover'] = $ybook_img_file;
    $_POST['theme_sel']['images']['ybook_cover'] = $ybook_img_file;
}

# Use ybook_tile from yearbook img dir if available
$img_fname = basename($_POST['ybook']['images']['ybook_tile']);
$ybook_img_file = $ybook_dir.'/'.$img_fname;
if (is_file($ybook_img_file)) {
    $_POST['ybook']['images']['ybook_tile'] = $ybook_img_file;
    $_POST['theme_sel']['images']['ybook_tile'] = $ybook_img_file;
}

$courses = $sql->getCourseList();
$_POST['courses'] = $sql->getCourseList();
$graduates = $sql->getGraduatesByCourse($yearbook_key);
//print "<pre>"; print_r($graduates);
$_POST['graduate_list'] = $graduates;

$_POST['css_cls'] = 'ybook-flip';
require_once 'views/ui_ybook.php';

?>