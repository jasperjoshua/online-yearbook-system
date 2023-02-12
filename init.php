<?php

require_once 'config.php';
require_once 'helper.php';

/*
$img_dir = YBOOK_IMG_DIR.'/'.$_POST['batch'];
$batch_dir = $img_dir.'/graduates';
global $FILE_LIST; 
$FILE_LIST = array();
recursive_scan($batch_dir);
//print "<pre>"; print_r($FILE_LIST);
//exit;


$student_list = array();
foreach ($FILE_LIST as $file) {
    if (preg_match('/\.((jpg)|(png))$/', $file)) {
        $pic_path = $file;
        $name = preg_replace('/\.([^\.]+)$/', '', basename($file));
        $name = preg_replace('/\_/', ',<br/>', $name);
        $dir = dirname($file);
        $course = basename($dir);
        $student = array(
            'name' => $name,
            'pic_path' => $pic_path,
        );

        $student_list[$course][] = $student;
    }
}

$_POST['students'] = $student_list;
$_POST['bg_img'] = $img_dir.'/bg.png';
*/


include_once 'models/sql_upload.php';
$sql = new SQL_Upload; 
//$_POST['draft_ybooks'] = $sql->getDraftYearbooks();
# Get all yearbooks (editable) instead of just draft yearbooks
$_POST['draft_ybooks'] = $sql->getYearbookData();
//print "<pre>"; print_r($_POST['draft_ybooks']);


include_once 'models/sql_ybook_themes.php';
$theme = new SQL_Ybook_Themes; 
# Get themes if not yet available in session
if (!isset($_SESSION['ybook']['themes']) || empty($_SESSION['ybook']['themes'])) {
    $_SESSION['ybook']['themes'] = $theme->getThemeList();
}
//print "<pre>"; print_r($_SESSION['ybook']['themes']); exit;

?>