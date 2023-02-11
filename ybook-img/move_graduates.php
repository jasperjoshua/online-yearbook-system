<?php

$file = './graduates.csv';
$data = getCSVFileData($file);
foreach ($data as $grad) {
    $pic_path = './2021-2022/graduates/'.$grad['Picture'];
    $dir = './'.$grad['Batch'].'/graduates/'.$grad['Course_Code'];
    if (is_file($pic_path)) {
        if (!is_dir($dir)) {
            $subdir = dirname($dir);
            if (!is_dir($subdir)) {
                print "Sub Dir: $subdir\n";
                mkdir($subdir);
            }
            print "Dir: $dir\n";
            mkdir($dir);
        }
        if (is_dir($dir)) {
            print_r($grad);
            $new_file = $dir.'/'.basename($pic_path);
            rename($pic_path, $new_file);
        }
    }
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
                $row[$header] = $token[$i];
            }
            $data[] = $row;
        }
        fclose($fd);
    }

    return $data;
}

?>