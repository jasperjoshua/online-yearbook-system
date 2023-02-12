<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset(_SESSION['ybook']['logged']) || _SESSION['ybook']['logged'] == 'guest') {
    header('Location: ./index.php');
    die();
}

require_once 'config.php';
require_once 'helper.php';

include_once 'models/sql_upload.php';
$sql = new SQL_Upload; 
include_once 'models/sql_ybook_themes.php';
$theme = new SQL_Ybook_Themes; 

$_POST['draft_ybooks'] = $sql->getDraftYearbooks();

# Get themes if not yet available in session
if (!isset(_SESSION['ybook']['themes']) || empty(_SESSION['ybook']['themes'])) {
    _SESSION['ybook']['themes'] = $theme->getThemeList();
}
//print "<pre>"; print_r(_SESSION['ybook']['themes']); exit;

if (isset($_POST['save']) && $_POST['save'] == 'upload') {
    //print "<pre>"; print_r($_FILES); print_r($_POST); print_r($_GET); exit;
    # Save Data
    if (isset($_FILES['uploaded_file']) && !empty($_FILES['uploaded_file']['tmp_name'])) {
        $file = $_FILES['uploaded_file']['tmp_name'];
        if (is_file($file)) {
            $list = getCSVFileData($file, "\t");
            foreach ($list as $row) {
                $created = $sql->addTableData($_GET['type'], array($row));
            }
        }
    }
}

$_POST['title'] = $sql->getDataTitle($_GET['type']);
$_POST['headers'] = $sql->getDataHeaders($_GET['type']);
$_POST['data'] = array();
if ($_GET['type'] == 'courses') {
    $_POST['data'] = $sql->getCourses($_GET['type']);
}

//print "<pre>";
//print_r($_POST['data']);
require_once 'views/ui_common_upload.php';

?>