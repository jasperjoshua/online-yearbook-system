<?php

require_once 'models/db_connect.php';

class SQL_Upload extends DB_Connect {

    public $title_list = array(
        'ybook_cover' => 'Cover Page',
        'content_bg_page' => 'Content Page',
        'vision_mission' => 'Vision | Mission | Goals',
        'officials' => 'BISU System Officials',
        'board' => 'Board of Regents',
        'faculty' => 'Teaching Staff',
        'non_teaching' => 'Non-Teaching Staff',
        'congrats' => 'Congratulations',
        'graduates' => 'The Graduates',
        'BSIT_cover' => 'BSIT Cover Page',
        'BSIT_filler_page' => 'BSIT Filler Page',
        'BSCS_cover' => 'BSCS Cover Page',
        'BSCS_filler_page' => 'BSCS Filler Page',
        'BS-ELEC_cover' => 'BS-ELEC Cover Page',
        'BS-ELEC_filler_page' => 'BS-ELEC Filler Page',
        'BS-ELEX_cover' => 'BS-ELEX Cover Page',
        'BS-ELEX_filler_page' => 'BS-ELEX Filler Page',
        'BSIT-FPSM_cover' => 'BSIT-FPSM Cover Page',
        'BSIT-FPSM_filler_page' => 'BSIT-FPSM Filler Page',
        'awardees' => 'Awardees & Achievers',
        'song_bg_page' => 'Song Page',
        'bisu_hymn' => 'BISU Hymn',
        'grad_song' => 'Graduation Song',
        'tribute_song' => 'Tribute Song',
        'officers' => 'Batch Officers',
        'ybook_back' => 'Back Page',
        # online-only
        'courses' => 'Courses',
    );

    public function __construct() 
    {
        Parent::__construct();
    }

    public function getYearBookSections()
    {
        return array(
            'ybook_cover' => 'image',
            'vision_mission' => 'static',
            'officials' => 'uploaded',
            'board' => 'uploaded',
            'faculty' => 'uploaded',
            'non_teaching' => 'uploaded',
            'congrats' => 'image',
            //'graduates' => 'uploaded',
            'awardees' => 'uploaded',
            'bisu_hymn' => 'static',
            'grad_song' => 'uploaded',
            'tribute_song' => 'uploaded',
            'officers' => 'uploaded',
            'ybook_back' => 'image',
        );
    }

    public function getBackgroundImages()
    {
        $courses = $this->getCourseList();
        $list = array();
        $list['Common'] = array(
            'content_bg_page' => 'Content Page',
            'song_bg_page' => 'Song Page',
        );
        foreach ($courses as $course) {
            $code = $course['Course_Code'];
            $list[$code] = array(
                $code.'_cover' => 'Cover Page',
                $code.'_filler_page' => 'Filler Page',
            );
        }


        return $list;
    }

    public function getDataTitle($type='')
    {
        $title = '';
        if (isset($this->title_list[$type])) {
            $title = $this->title_list[$type];
        }

        return $title;
    }

    public function getDataPageRows($type='')
    {
        $list = array(
            'board' => 6,
            'non_teaching' => 8,
            'officers' => 8,
            'grad_song' => 18,
            'tribute_song' => 18,
        );
        $rows = 5;
        if (isset($list[$type])) {
            $rows = $list[$type];
        }

        return $rows;
    }

    public function getTableName($type='')
    {
        $list = array(
            'courses' => 'courses',
            'officials' => 'bisu_system_officials',
            'board' => 'board_of_regents',
            'faculty' => 'teaching_staff',
            'non_teaching' => 'non_teaching_staff',
            'awardees' => 'awardees_achievers',
            'officers' => 'batch_officers',
            'grad_song' => 'yearbook_songs',
            'tribute_song' => 'yearbook_songs',
            'graduates' => 'graduates',
            'yearbooks' => 'yearbooks',
        );
        $table = '';
        if (isset($list[$type])) {
            $table = $list[$type];
        }

        return $table;
    }

    public function getDataHeaders($type='')
    {
        $columns = array();
        if ($type == 'awardees') {
            $columns = array(
                'First_Name',
                'Last_Name',
                'Award',
                'Award_Type'
            );
        } elseif ($type == 'officers') {
            $columns = array(
                'Full_Name',
                'Position'
            );
        } elseif ($type == 'courses') {
            $columns = array(
                'Course_Code',
                'Course_Name',
                'Department'
            );
        } elseif ($type == 'graduates') {
            $columns = array(
                'Course_Code',
                'Pic_File',
                'First_Name',
                'Last_Name',
                'Gender',
                'Home_Address',
            );
        } else {
            $columns = array(
                'Full_Name',
                'Position',
                'Office'
            );
        }

        return $columns;
    }

    public function getTableColumns($type='')
    {
        $columns = array();
        if ($type == 'awardees') {
            $columns = array(
                'Yearbook_Key',
                'Graduate_Key',
                'Award',
                'Award_Type'
            );
        } elseif ($type == 'officers') {
            $columns = array(
                'Yearbook_Key',
                'Full_Name',
                'Position'
            );
        } elseif ($type == 'courses') {
            $columns = array(
                'Course_Code',
                'Course_Name',
                'Department'
            );
        } elseif ($type == 'yearbooks') {
            $columns = array(
                'Batch',
                'Theme',
                'Is_Published'
            );
        } elseif ($type == 'grad_song') {
            $columns = array(
                'Yearbook_Key',
                'Song_Type',
                'Song_Title',
                'Singer',
                'Lyrics'
            );
        } elseif ($type == 'tribute_song') {
            $columns = array(
                'Yearbook_Key',
                'Song_Type',
                'Song_Title',
                'Singer',
                'Lyrics'
            );
        } elseif ($type == 'graduates') {
            $columns = array(
                'Yearbook_Key',
                'Course_Key',
                'Pic_File',
                'First_Name',
                'Last_Name',
                'Gender',
                'Home_Address',
            );
        } else {
            $columns = array(
                'Yearbook_Key',
                'Full_Name',
                'Position',
                'Office'
            );
        }

        return $columns;
    }

    public function addTableData($type, $tbl_data)
    {
        $table = $this->getTableName($type);
        $tbl_columns = $this->getTableColumns($type);
        $data = array();
        foreach ($tbl_data as $values) {
            $row = array();
            foreach ($tbl_columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
        }
        //print "<pre>";
        //print_r($data);
        $res = $this->insertTableRow($table, $tbl_columns, $data);
        //var_dump($res);

        return $res;
    }

    public function getTableDataList($type, $yearbook_key, $primary_key)
    {
        $table = $this->getTableName($type);
        $sql = "
            SELECT *
            FROM {$table} 
            WHERE Yearbook_Key = $yearbook_key
            ORDER BY $primary_key
        ";
        $list = $this->getDataFromTable($sql);

        return $list;
    } 

    public function getUploadedData($type, $yearbook_key) 
    {
        $data = array();
        if ($type == 'officials') {
            $data = $this->getBISUSystemOfficials($type, $yearbook_key);
        } elseif ($type == 'board') {
            $data = $this->getBoardOfRegents($type, $yearbook_key);
        } elseif ($type == 'faculty') {
            $data = $this->getTeachingStaff($type, $yearbook_key);
        } elseif ($type == 'non_teaching') {
            $data = $this->getNonTeachingStaff($type, $yearbook_key);
        } elseif ($type == 'officers') {
            $data = $this->getBatchOfficers($type, $yearbook_key);
        } elseif ($type == 'graduates') {
            $data = $this->getGraduates($yearbook_key);
        } elseif ($type == 'grad_song') {
            $data = $this->getGraduationSong($yearbook_key);
        } elseif ($type == 'tribute_song') {
            $data = $this->getTributeSong($yearbook_key);
        } elseif ($type == 'courses') {
            $data = $this->getCourses();
        }

        return $data;
    }

    public function getYearbookList()
    {
        $sql = "
            SELECT *
            FROM yearbooks
        ";
        $list = $this->getDataFromTable($sql);

        return $list;
    } 

    public function getYearbookData()
    {
        $sql = "
            SELECT *
            FROM yearbooks
        ";
        $list = $this->getDataFromTable($sql);
        $data = array();
        foreach ($list as $row) {
            $data[$row['Batch']] = $row;
        }

        return $data;
    } 

    public function getDraftYearbooks()
    {
        $sql = "
            SELECT *
            FROM yearbooks
            WHERE Is_Published = 0
        ";
        $list = $this->getDataFromTable($sql);
        $data = array();
        foreach ($list as $row) {
            $data[$row['Batch']] = $row;
        }

        return $data;
    } 

    public function getPublishedYearbooks()
    {
        $sql = "
            SELECT *
            FROM yearbooks
            WHERE Is_Published = 1
        ";
        $list = $this->getDataFromTable($sql);
        $data = array();
        foreach ($list as $row) {
            $data[$row['Batch']] = $row;
        }

        return $data;
    } 

    public function getYearbookKey($batch)
    {
        $sql = "
            SELECT *
            FROM yearbooks
            WHERE Batch = '$batch'
        ";
        $list = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($list as $row) {
            $key = $row['Yearbook_Key'];
        }

        return $key;
    } 

    public function getYearbookTheme($batch)
    {
        $sql = "
            SELECT *
            FROM yearbooks
            WHERE Batch = '$batch'
        ";
        $list = $this->getDataFromTable($sql);
        $theme = '';
        foreach ($list as $row) {
            $theme = $row['Theme'];
        }

        return $theme;
    } 

    public function getCourseList()
    {
        $sql = "
            SELECT *
            FROM courses
        ";
        $list = $this->getDataFromTable($sql);

        return $list;
    } 

    public function getCourseKey($course_code)
    {
        $sql = "
            SELECT * 
            FROM courses
            WHERE Course_Code = '{$course_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Course_Key'];
        }

        return $key;
    }

    public function getCourses()
    {
        $list = $this->getCourseList();
        $data = array();
        $data['list'] = array();
        $data['bottom'] = array();
        $data['center'] = $list;

        return $data;
    }

    public function getGraduateList($yearbook_key)
    {
        $sql = "
            SELECT g.*, Course_Code
            FROM graduates as g
            LEFT JOIN courses as c ON g.Course_Key = c.Course_Key
            WHERE g.Yearbook_Key = $yearbook_key
            ORDER BY Course_Code, Last_Name, First_Name
        ";
        $list = $this->getDataFromTable($sql);

        return $list;
    } 

    public function getGraduatesByCourse($yearbook_key)
    {
        $list = $this->getGraduateList($yearbook_key);
        $data = array();
        foreach ($list as $grad) {
            $course = $grad['Course_Code'];
            $data[$course][] = $grad;
        }

        return $data;
    }

    public function getGraduates($yearbook_key)
    {
        $data = array();
        $data['table_headers'] = $this->getDataHeaders('graduates');
        $data['table_data'] = $this->getGraduateList($yearbook_key);

        return $data;
    }

    public function getSongData($yearbook_key, $type)
    {
        $sql = "
            SELECT *
            FROM yearbook_songs 
            WHERE Yearbook_Key = $yearbook_key
                AND Song_Type = '$type'
        ";
        $list = $this->getDataFromTable($sql);
        $song = array();
        if (!empty($list)) {
            $song = $list[0];
            $song['Lyrics'] = json_decode($song['Lyrics'], true);
        }

        return $song;
    } 

    public function getGraduationSong($yearbook_key)
    {
        $data = array();
        $data['table_headers'] = array();
        $song = $this->getSongData($yearbook_key, 'grad_song');
        $data['center'] = array();
        $data['list'] = array();
        $data['bottom'] = array();
        if (!empty($song)) {
            $data['song_title'] = $song['Song_Title'];
            $data['singer'] = $song['Singer'];
            if (!empty($song['Lyrics'])) {
                $data['center'] = $song['Lyrics'];
            }
        }

        return $data;
    }

    public function getTributeSong($yearbook_key)
    {
        $data = array();
        $data['table_headers'] = array();
        $song = $this->getSongData($yearbook_key, 'tribute_song');
        $data['center'] = array();
        $data['list'] = array();
        $data['bottom'] = array();
        if (!empty($song)) {
            $data['song_title'] = $song['Song_Title'];
            $data['singer'] = $song['Singer'];
            if (!empty($song['Lyrics'])) {
                $data['center'] = $song['Lyrics'];
            }
        }

        return $data;
    }

    public function getBISUSystemOfficials($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Bisu_Official_Key');
        $data = array();
        $data['center'] = array();
        $data['bottom'] = array();
        $data['list'] = array();
        if (!empty($list)) {
            $data['center'][] = array_shift($list);
            $data['list'] = $list;
        }

        return $data;
    }

    public function getBoardOfRegents($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Board_Key');
        $data = array();
        $data['center'] = array();
        $data['bottom'] = array();
        $data['list'] = array();
        if (!empty($list)) {
            $data['center'] = $list;
        }

        return $data;
    }

    public function getTeachingStaff($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Staff_Key');
        $data = array();
        $data['center'] = array();
        $data['bottom'] = array();
        $data['list'] = array();
        if (!empty($list)) {
            $data['center'][] = array_shift($list);
            $data['list'] = $list;
        }

        return $data;
    }

    public function getNonTeachingStaff($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Staff_Key');
        $data = array();
        $data['center'] = array();
        $data['bottom'] = array();
        $data['list'] = array();
        if (!empty($list)) {
            $data['center'] = $list;
        }

        return $data;
    }

    public function getBatchOfficers($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Officer_Key');
        $data = array();
        $data['center'] = array();
        $data['bottom'] = array();
        $data['list'] = array();
        if (!empty($list)) {
            //$data['center'][] = array_shift($list);
            //$data['bottom'][] = array_pop($list);
            $data['center'] = $list;
        }

        return $data;
    }

    public function updateYearbookTheme($batch, $new_theme)
    {
        $sql = "UPDATE yearbooks SET Theme='{$new_theme}' WHERE Batch='{$batch}' ";
        //print "<pre> $sql\n";
        if ($this->db->query($sql) === true) {
            $res = true;
        } else {
            $res = $this->db->error;
        }
        //var_dump($res);

        return $res;

    }

    public function publishYearbook($batch)
    {
        $sql = "UPDATE yearbooks SET Is_Published=1 WHERE Batch='{$batch}' ";
        //print "<pre> $sql\n";
        if ($this->db->query($sql) === true) {
            $res = true;
        } else {
            $res = $this->db->error;
        }
        //var_dump($res);

        return $res;

    }

}

?>