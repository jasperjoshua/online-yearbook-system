<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//print "<pre>"; print_r($_SESSION); exit;

if (!isset($_SESSION['ybook']['logged'])) {
    $_SESSION['ybook']['logged'] = 'guest';
}

require_once 'config.php';
require_once 'helper.php';

# Logout
if (isset($_GET['menu']) && $_GET['menu'] == 'logout') {
    logout();
}

include_once 'models/sql_upload.php';
$sql = new SQL_Upload; 
include_once 'models/sql_ybook_themes.php';
$theme = new SQL_Ybook_Themes; 

$_POST['published_ybooks'] = $sql->getPublishedYearbooks();
# Get themes if not yet available in session
if (!isset($_SESSION['ybook']['themes']) || empty($_SESSION['ybook']['themes'])) {
    $_SESSION['ybook']['themes'] = $theme->getThemeList();
}
//print "<pre>"; print_r($_POST); print_r($_SESSION['ybook']['themes']); exit;

$_POST['ybook_list'] = array();
foreach ($_POST['published_ybooks'] as $batch => $ybook) {
    $_POST['ybook_list'][$batch] = $ybook;
    $ybook_dir = YBOOK_IMG_DIR.'/'.$batch;
    $ybook_theme = $ybook['Theme'];
    $theme_images = $_SESSION['ybook']['themes'][$ybook_theme]['images'];
    $_POST['ybook_list'][$batch]['dir'] = $ybook_dir;
    $_POST['ybook_list'][$batch]['images'] = $theme_images;
    # Use ybook_cover from yearbook img dir if available
    $img_fname = basename($theme_images['ybook_cover']);
    $ybook_img_file = $ybook_dir.'/'.$img_fname;
    if (is_file($ybook_img_file)) {
        $_POST['ybook_list'][$batch]['images']['ybook_cover'] = $ybook_img_file;
    }
    # Use ybook_tile from yearbook img dir if available
    $img_fname = basename($theme_images['ybook_tile']);
    $ybook_img_file = $ybook_dir.'/'.$img_fname;
    if (is_file($ybook_img_file)) {
        $_POST['ybook_list'][$batch]['images']['ybook_tile'] = $ybook_img_file;
    }
}
//print "<pre>"; print_r($_POST['ybook_list']); exit;

# Login
if (isset($_GET['menu']) && $_GET['menu'] == 'login') {
    if (isset($_POST['login']) && $_POST['login'] == 'submit') {
        $valid = false;
        if (isset($_POST['username']) && $_POST['username'] !== '' && isset($_POST['password']) && $_POST['password'] !== '') {
            if ($_POST['username'] != ADMIN_USERNAME && $_POST['password'] != ADMIN_PASSWORD) {
                # Incorrect username
                $_POST['danger'] = "Incorrect Username and Password.";
            } elseif ($_POST['username'] != ADMIN_USERNAME) {
                # Incorrect username
                $_POST['danger'] = "Incorrect Username.";
            } elseif ($_POST['password'] != ADMIN_PASSWORD) {
                # Incorrect password
                $_POST['danger'] = "Incorrect Password.";
            } else {
                # Valid admin login
                $_SESSION['ybook']['logged'] = 'admin';
                # Reset Themes in SESSION 
                $_SESSION['ybook']['themes'] = $theme->getThemeList();
            }
        } else {
            $_POST['danger'] = "Invalid Login.";
            require_once 'views/login.php';
            exit;
        }
    } else {
        require_once 'views/login.php';
        exit;
    }
}

# About - Vision, Mission, Goals
if (isset($_GET['menu']) && $_GET['menu'] == 'about') {
    require_once 'views/ui_home.php';

# BISU Hymn
} elseif (isset($_GET['menu']) && $_GET['menu'] == 'bisu-hymn') {
    require_once 'views/ui_home.php';

# Yearbook online view
} elseif (isset($_GET['menu']) && $_GET['menu'] == 'ybook') {
    $_POST['batch'] = $_GET['batch'];
    //require_once 'init.php';
    require_once 'views/ui_ybook_online.php';

# Home
} else {
    require_once 'views/ui_home.php';
}

?>