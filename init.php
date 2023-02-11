<?php

require_once 'config.php';
require_once 'helper.php';

$img_dir = YBOOK_IMG_DIR.'/'.$_POST['batch'];
$batch_dir = $img_dir.'/graduates';
global $FILE_LIST; 
$FILE_LIST = array();
recursive_scan($batch_dir);
//print "<pre>"; print_r($FILE_LIST);
//exit;

$_POST['courses'] = array(
    'BSIT'      => 'BS in Information Technology',
    'BSCS'      => 'BS in Computer Science',
    'BS-ELEX'   => 'BS in Electronics Technology',
    'BS-ELEC'   => 'BS in Electrical Technology',
    'BSIT-FPSM' => 'BSIT - Food Preparation & Service Management',
);

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

?>