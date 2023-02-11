<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['logged']) || $_SESSION['logged'] == 'guest') {
    header('Location: ./index.php');
    die();
}

$_POST['ybook_lists'] = array();
require_once 'config.php';
require_once 'helper.php';

if (!isset($_GET['m'])) {
    $_GET['m'] = 'home';
}

include_once 'models/sql_upload.php';
$sql = new SQL_Upload; 
include_once 'models/sql_ybook_themes.php';
$theme = new SQL_Ybook_Themes; 

$_POST['draft_ybooks'] = $sql->getDraftYearbooks();

# Get themes if not yet available in session
if (!isset($_SESSION['themes']) || empty($_SESSION['themes'])) {
    $_SESSION['themes'] = $theme->getThemeList();
}
//print "<pre>"; print_r($_SESSION['themes']); exit;

if ($_GET['m'] == 'upload') {

    if (isset($_POST['save']) && $_POST['save'] == 'upload') {
        //print "<pre>"; print_r($_FILES); print_r($_POST); print_r($_GET); exit;
        # Save Data
        if (isset($_FILES['uploaded_file']) && !empty($_FILES['uploaded_file']['tmp_name'])) {
            $file = $_FILES['uploaded_file']['tmp_name'];
            if (is_file($file)) {
                $yearbook_key = $sql->getYearbookKey($_SESSION['batch_sel']);
                if ($_GET['type'] == 'grad_song' || $_GET['type'] == 'tribute_song') {
                    $lines = getTXTFileData($file, true);
                    //print "<pre>"; print_r($lines); exit;
                    $row = array();
                    $row['Yearbook_Key'] = $yearbook_key;
                    $row['Song_Type'] = $_GET['type'];
                    $row['Song_Title'] = array_shift($lines);
                    $row['Singer'] = array_shift($lines);
                    array_shift($lines);
                    $row['Lyrics'] = json_encode($lines);
                    //print "<pre>"; print_r($row); exit;
                    $created = $sql->addTableData($_GET['type'], array($row));
                } else {
                    $list = getCSVFileData($file, "\t");
                    foreach ($list as $row) {
                        if ($_GET['type'] == 'graduates') {
                            $row['Course_Key'] = $sql->getCourseKey($row['Course_Code']);
                        }
                        $created = $sql->addTableData($_GET['type'], array($row));
                    }
                }
            }
        }
    }

    if ($_GET['type'] == 'courses') {
        $_POST['title'] = $sql->getDataTitle($_GET['type']);
        $_POST['headers'] = $sql->getDataHeaders($_GET['type']);
        $_POST['data'] = $sql->getCourses($_GET['type']);
        print "<pre>";
        print_r($_POST['data']);
        require_once 'views/ui_upload.php';
    } else {
        header('Location: ./draft.php?batch='.$_SESSION['batch_sel']);
        die();
    }

# Create yearbook
} else if (isset($_POST['create']) && $_POST['create'] == 'ybook') {
    $ybook_list = $sql->getYearbookData(); # Existing yearbooks
    //print "<pre>"; print_r($_POST); print_r($ybook_list); exit;
    if (empty($_POST['Batch'])) {
        $_POST['danger'] = "Batch cannot be blank.";
    } elseif (!preg_match('/^\d\d\d\d$/', $_POST['Batch'])) {
        $_POST['danger'] = "Batch should be a 4-digit year.";
    } elseif (isset($ybook_list[$_POST['Batch']])) {
        $_POST['danger'] = "A yearbook for Batch {$_POST['Batch']} already exists.";
    } else {
        $sel_theme = $_SESSION['themes'][$_POST['Theme']];
        $theme->createYearbookDir($_POST['Batch'], $sel_theme);
        $yearbook = array(
            'Batch' => $_POST['Batch'],
            'Theme' => $_POST['Theme'],
            'Is_Published' => 0,
        );
        $created = $sql->addTableData('yearbooks', array($yearbook));
        header('Location: ./draft.php?batch='.$_POST['Batch']);
        die();
    }
} 

require_once 'views/ui_create.php';


?>