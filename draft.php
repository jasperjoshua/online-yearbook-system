<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['ybook']['logged']) || $_SESSION['ybook']['logged'] == 'guest') {
        header('Location: ./index.php');
        die();
    }

    require_once 'config.php';
    require_once 'helper.php';
    require_once 'init.php';

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

    $courses = $sql->getCourseList();
    if (empty($courses)) {
        $_GET['type'] = 'courses';
        $_POST['danger'] = 'Please upload courses first.';
        $_POST['title'] = $sql->getDataTitle($_GET['type']);
        $_POST['headers'] = $sql->getDataHeaders($_GET['type']);
        $_POST['data'] = $sql->getCourses($_GET['type']);
        require_once 'views/ui_common_upload.php';
        die();
    }

    $yearbook_key = $sql->getYearbookKey($_GET['batch']); 
    $ybook_dir = YBOOK_IMG_DIR.'/'.$_GET['batch'];
    $_SESSION['ybook']['batch_sel'] = $_GET['batch'];
    //print "<pre>"; print_r($_FILES); print_r($_POST); print_r($_GET); exit;
    
    if (isset($_GET['m'])) {
        if ($_GET['m'] == 'delete') {
            # Delete image 
            //print "<pre>"; print_r($_FILES); print_r($_POST); print_r($_GET); exit;
            if (is_file($_POST['image_path'])) {
                unlink($_POST['image_path']);
                $_POST['success'] = 'The image has been deleted.';
            } else {                
                $_POST['danger'] = 'The image does not exist.';
            }

        } elseif ($_GET['m'] == 'upload') {
            if (isset($_POST['save']) && $_POST['save'] == 'upload') {
                //print "<pre>"; print_r($_FILES); print_r($_POST); print_r($_GET); exit;
                # Save Data
                if (isset($_FILES['uploaded_file']) && !empty($_FILES['uploaded_file']['tmp_name'])) {
                    $file = $_FILES['uploaded_file']['tmp_name'];
                    if (is_file($file)) {
                        $yearbook_key = $sql->getYearbookKey($_SESSION['ybook']['batch_sel']);
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
                        } elseif ($_GET['type'] == 'image') {
                            //print "<pre>"; print_r($_POST); print_r($_SESSION['ybook']); exit;
                            $orig_fname = $_POST['orig_fname'];
                            $ybook_dir = YBOOK_IMG_DIR.'/'.$_GET['batch'];
                            $uploaded_img = $ybook_dir.'/'.$orig_fname;
                            copy($file, $uploaded_img);
                        } elseif ($_GET['type'] == 'image-multi-optional') {                            
                            $orig_fname = $_FILES['uploaded_file']['name'];
                            //print "<pre>"; print_r($_POST); print_r($_FILES); exit;
                            $new_fname = $_GET['img_type'].'_page_'.time();
                            $ext = preg_replace("/([^\.]+)\.(.+)$/", '.$2', $orig_fname);
                            $ybook_dir = YBOOK_IMG_DIR.'/'.$_GET['batch'];
                            $uploaded_img = $ybook_dir.'/'.$new_fname.$ext;
                            //print "<pre>$file - $uploaded_img\n"; exit;
                            copy($file, $uploaded_img);
                        } else {
                            $list = getCSVFileData($file, "\t");
                            foreach ($list as $row) {
                                $row['Yearbook_Key'] = $yearbook_key;
                                if ($_GET['type'] == 'graduates') {
                                    $row['Course_Key'] = $sql->getCourseKey($row['Course_Code']);
                                }
                                //print "<pre>"; print_r($row); exit;
                                $created = $sql->addTableData($_GET['type'], array($row));
                            }
                        }
                    }
                } else {
                    $_POST['danger'] = 'No file selected.';
                }
            } 
        } elseif ($_GET['m'] == 'publish') {
            //print "<pre>"; print_r($_POST); print_r($_SESSION['ybook']); exit;
            $grad_dir = $ybook_dir.'/graduates';
            $grad_data = array();
            if (is_dir($grad_dir)) {
                $grad_data = getFoldersFromDir($grad_dir);
                $_POST['danger'] = 'Please add graduates profile images in '.$grad_dir.' folder first.';
            } else {
                $_POST['danger'] = 'Graduates folder in '.$ybook_dir.' does not exist.';
            }

            if (!empty($grad_data)) {
                # Update yearbook theme
                $updated = $sql->publishYearbook($_GET['batch']);            
                if ($updated) {
                    $_POST['success'] = 'The yearbook has been published.';
                    # Redirect to create page when no batch entered
                    header('Location: ./index.php');
                    die();
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } elseif ($_GET['m'] == 'layout') {
            # Update yearbook layouot
            $updated = $sql->updateYearbookLayout($_GET['batch'], $_POST);            
            if ($updated) {
                $_POST['success'] = 'The yearbook layout has been updated.';
            } else {
                $_POST['danger'] = 'Something went wrong.';
            }
            
        } elseif ($_GET['m'] == 'apply_theme') {
            //print "<pre>"; print_r($_POST); print_r($_SESSION['ybook']); exit;
            if (isset($_POST['theme']) && $_POST['theme'] != '') {
                $new_theme = $_POST['theme'];
                if ($_POST['orig_theme'] == $new_theme) {
                    $_POST['warning'] = 'No changes. Please select another theme.';
                } elseif (isset($_SESSION['ybook']['themes'][$new_theme])) {
                    # Update yearbook theme
                    $updated = $sql->updateYearbookTheme($_GET['batch'], $new_theme);
                    if ($updated) {
                        $_POST['success'] = 'The yearbook theme has been updated. You may need to re-upload some images to fit the new theme.';
                    } else {
                        $_POST['danger'] = 'Something went wrong.';
                    }
                } else {
                    $_POST['danger'] = 'The selected theme does not exist.';
                }
            } else {
                $_POST['danger'] = 'No theme selected.';
            }
        }
    }
   
    $_POST['ybook_layout'] = $sql->getYearbookSettings($yearbook_key);
    //print "<pre>"; print_r($_POST); exit;
    $_POST['sections'] = $sql->getYearBookSections();
    $_POST['image-multi-optional'] = array();
    foreach ($_POST['sections'] as $type => $section_type) {
        $_POST[$type]['title'] = $sql->getDataTitle($type);
        $_POST[$type]['rows'] = $sql->getDataPageRows($type);
        if ($section_type == 'uploaded') {
            $_POST[$type]['headers'] = $sql->getDataHeaders($type);
            $_POST[$type]['data'] = $sql->getUploadedData($type, $yearbook_key);
        } elseif ($section_type == 'image-multi-optional') {
            $_POST['image-multi-optional'][$type] = getImagesFromDir($ybook_dir, $type.'_page_');
        }
    }
    $_POST['data_list'] = $_POST['sections'];
    $_POST['bg_images'] = $sql->getBackgroundImages();
    foreach ($_POST['bg_images'] as $img_type => $images) {
        foreach ($images as $type => $title) {
            $_POST['data_list'][$type] = 'image';
            $_POST[$type]['title'] = $sql->getDataTitle($type);
        }
    }
    //print "<pre>"; print_r($_POST['image-multi-optional']); exit;

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
    $_POST['css_cls'] = 'ybook-page';
    $_POST['active'] = isset($_GET['type']) ? $_GET['type'] : 'ybook_cover';
    require_once 'views/ui_draft_theme.php';
    
?>