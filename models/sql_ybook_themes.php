<?php

require_once 'models/db_connect.php';

class SQL_Ybook_Themes extends DB_Connect {

    public function __construct() 
    {
        Parent::__construct();
    }

    public function getThemeList()
    {
        $image_list = array(
            'ybook_tile', 
            'ybook_cover', 
            'ybook_back', 
            'content_bg_page', 
            'song_bg_page', 
        );
        $path = './ybook_themes/';
        $dirs = getFoldersFromDir($path);
        $list = array();
        foreach ($dirs as $theme) {
            $theme_dir = $path.$theme.'/';
            $theme_images = getImagesFromDir($theme_dir);
            $list[$theme] = array(
                'name' => ucwords(preg_replace('/\_/', ' ', $theme)),
                'dir' => $theme_dir,
                'images' => $theme_images,
            );
            /*
            foreach ($image_list as $img_name) {
                if (isset($theme_images[$img_name])) {
                    $list[$theme][$img_name] = $theme_images[$img_name];
                }
            }
            */
        }
        
        return $list;
    }

    public function createYearbookDir($batch, $theme)
    {
        $dir = YBOOK_IMG_DIR.'/'.$batch;
        createDir($dir);
        if (is_dir($dir)) {
            $grad_dir = $dir.'/graduates';
            createDir($grad_dir);
            /*
             * Disabled - theme images will be referenced instead of copied over due to image caching
            foreach ($theme['images'] as $img) {
                copy($img, $dir.'/'.basename($img));
            }
            */
        }
    }

    public function setYearbookImages($ybook_dir)
    {
        foreach ($_POST['ybook']['images'] as $img_type =>  $img_fpath) {
            # Use image from yearbook img dir if available
            $img_fname = basename($img_fpath);
            $ybook_img_file = $ybook_dir.'/'.$img_fname;
            if (is_file($ybook_img_file)) {
                $_POST['ybook']['images'][$img_type] = $ybook_img_file;
                $_POST['theme_sel']['images'][$img_type] = $ybook_img_file;
            }
        }
        //print "<pre>"; print_r($_POST['ybook']['images']); exit;
    }

}

?>