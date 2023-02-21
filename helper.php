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

function getImagesFromDir($path, $name_filter='') 
{
    $files = scandir($path);
    $images = array();
    foreach($files as $file) {
        $fpath = $path.'/'.$file;
        if (is_file($fpath)) {
            $type = mime_content_type($fpath);
            if (preg_match('/^image/', $type)) {
                $base_fn = preg_replace('/\..+$/', '', $file);
                if ($name_filter != '') {
                    if (preg_match("/{$name_filter}/", $base_fn)) {
                        $images[$base_fn] = dirname($fpath).'/'.$file;
                    }
                } else {
                    $images[$base_fn] = dirname($fpath).'/'.$file;
                }
            }
        }
    }
    //print "<pre>$path - $name_filter\n"; print_r($files); print_r($images); exit;

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

function splitDataForDisplay($data)
{
    $row_orig = $_POST['rows'];
    $cnt = count($data['list']);
    $split = array();
    $split[0]['center'] = isset($data['center']) ? $data['center'] : array();
    $start = 0;
    $rows = $row_orig - count($split[0]['center']);
    if ($rows < 0) {
        $rows = $row_orig;
    }
    $range = (($cnt-$start) > $rows) ? $rows : $cnt-$start;
    $page = -1;
    //print "<pre> Rows: $rows | Start: $start | Cnt: $cnt | Range: $range\n";
    while ($range > 0) {
        $page++;
        if (!isset($split[$page]['center']) || empty($split[$page]['center'])) {  
            $split[$page]['center'] = array();          
            $rows = $row_orig;
        }
        $range = (($cnt-$start) > $rows) ? $rows : $cnt-$start;
        $split[$page]['left'] = array_slice($data['list'], $start, $range);
        //print "<pre> Rows: $rows | Start: $start | Cnt: $cnt | Range: $range\n";
        //print_r($split[$page]['left']);
        $start += $range;
        $range = (($cnt-$start) > $rows) ? $rows : $cnt-$start;
        $split[$page]['right'] = array();
        if ($range > 0) {
            $split[$page]['right'] = array_slice($data['list'], $start, $range);
            //print "<pre> Rows: $rows | Start: $start | Cnt: $cnt | Range: $range\n";
            //print_r($split[$page]['right']);
            $start += $range;
            $range = (($cnt-$start) > $rows) ? $rows : $cnt-$start;
        } else {
            //print "<pre> Rows: $rows | Start: $start | Cnt: $cnt | Range: $range\n";
            $split[$page]['center'] = array_merge($split[$page]['center'], $split[$page]['left']);
            $split[$page]['left'] = array();
            $split[$page]['right'] = array();
        }
        $split[$page]['bottom'] = array();
        //print_r($split[$page]);
    }
    if (isset($data['bottom']) && !empty($data['bottom'])) {
        if (empty($split[$page]['left'])) {
            $split[$page]['center'] = array_merge($split[$page]['center'], $data['bottom']);
        } else {
            $split[$page]['bottom'] = $data['bottom'];
        }
    }
    $split = checkCenterData($split, $rows);
    if (isset($data['song_title'])  && isset($data['singer'])) {
        $split[0]['song_title'] = $data['song_title'];
        $split[0]['singer'] = $data['singer'];
    }
    //print "<pre> $rows\n"; 
    //print_r($data); 
    //print_r($split); exit;

    return $split;
}

function checkCenterData($split, $row_orig=5)
{
    $center = $split[0]['center'];
    $cnt = count($split[0]['center']);
    if ( $cnt > $row_orig) {
        $page = 0;
        for ($start = 0; $start < $cnt; $start += $row_orig) {
            $range = (($cnt-$start) > $row_orig) ? $row_orig : $cnt-$start;
            $split[$page]['center'] = array_slice($center, $start, $range);
            if (!isset($split[$page]['left']) || empty($split[$page]['left'])) {  
                $split[$page]['left'] = array();     
            }
            if (!isset($split[$page]['right']) || empty($split[$page]['right'])) {  
                $split[$page]['right'] = array();     
            }
            if (!isset($split[$page]['bottom']) || empty($split[$page]['bottom'])) {  
                $split[$page]['bottom'] = array();     
            }
            $page++;
        }
    }

    return $split;
}

?>