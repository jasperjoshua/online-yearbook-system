<?php


function logout()
{
    unset($_SESSION['ybook']['themes']);
    unset($_SESSION['ybook']['logged']);
    $_SESSION['ybook']['logged'] = 'guest';
    header('Location: index.php');
    exit;

}

/**
 * 
 * @function recursive_scan
 * @description Recursively scans a folder and its child folders
 * @param $path :: Path of the folder/file
 * 
 * */
function recursive_scan($path)
{
    global $FILE_LIST;
    $path = rtrim($path, '/');
    if (!is_dir($path)) {
        $FILE_LIST[] = $path;
    } else {
        $files = scandir($path);
        foreach($files as $file) {
            if ($file != '.' && $file != '..') {
                recursive_scan($path . '/' . $file);
            }
        }
    }
}

function getBatchImgFolders($path)
{
    $files = scandir($path);
    $list = array();
    foreach($files as $file) {
        if ($file == '.' || $file == '..') continue;
        if (is_dir($path.'/'.$file) && preg_match('/^\d{4,4}$/', $file)) {
            $list[] = $file;

        }
    }

    return $list;
}

function getFoldersFromDir($path) 
{
    $files = scandir($path);
    $folders = array();
    foreach($files as $file) {
        if ($file == '.' || $file == '..') continue;
        if (is_dir($path.'/'.$file)) {
            $folders[] = $file;
        }
    }

    return $folders;
}

function getImagesFromDir($path) 
{
    $files = scandir($path);
    $images = array();
    foreach($files as $file) {
        $fpath = $path.'/'.$file;
        if (is_file($fpath)) {
            $type = mime_content_type($fpath);
            if (preg_match('/^image/', $type)) {
                $base_fn = preg_replace('/\..+$/', '', $file);
                $images[$base_fn] = dirname($fpath).'/'.$file;
            }
        }
    }

    return $images;
}

function createDir($dir)
{
    if (!is_dir($dir)) {
        mkdir($dir);
    }
}

function getStudentsByPage($student_list, $page_items=8)
{
    $students = array();
    foreach ($student_list as $course => $list) {
        $students[$course] = array();
        $page = 0;
        foreach ($list as $i => $student) {
            $students[$course][$page][] = $student;
            if ((($i+1) % $page_items) == 0) {
                $page++;
            }
        }
    }
    //print "<pre>"; print_r($students);
    //exit;

    return $students;
}

function getCSVFileData($file, $separator=",") 
{
    $data = array();
    if (is_file($file)) {
        $fd = fopen($file, "r");
        if ($fd == null) {
            die("Command 'fopen' failed for $file.");
        }
        $line = trim(fgets($fd));
        $headers = explode($separator, $line);
        while (!feof($fd)) {
            $line = trim(fgets($fd));
            if (empty($line)) continue;
            $token = explode($separator, $line);
            $row = array();
            foreach ($headers as $i => $header) {
                $row[$header] = isset($token[$i]) ? trim($token[$i]) : '';
            }
            $data[] = $row;
        }
        fclose($fd);
    }

    return $data;
}

function getTXTFileData($file, $remove_quotes=false) 
{
    $data = array();
    if (is_file($file)) {
        $fd = fopen($file, "r");
        if ($fd == null) {
            die("Command 'fopen' failed for $file.");
        }
        while (!feof($fd)) {
            $line = trim(fgets($fd));
            if ($remove_quotes) {
                $line = str_replace("'", "", $line);
                $line = stripslashes($line);
            }
            $data[] = empty($line) ? "&nbsp;" : $line;
        }
        fclose($fd);
    }

    return $data;
}

?>