-- CREATE database bisu_ybook;
-- USE bisu_ybook;

--
-- Table structure for table courses
--
CREATE TABLE courses (
  Course_Key int(10) unsigned NOT NULL auto_increment,
  Course_Code char(15) NOT NULL,
  Course_Name char(255) NOT NULL,
  Department char(10) NOT NULL,
  PRIMARY KEY  (Course_Key),
  UNIQUE KEY tbl_unique (Course_Code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table yearbooks
--
CREATE TABLE yearbooks (
  Yearbook_Key int(10) unsigned NOT NULL auto_increment,
  Batch int(10) NOT NULL,
  Theme char(100) NOT NULL,
  Is_Published int(1) NOT NULL Default 0,
  PRIMARY KEY  (Yearbook_Key),
  UNIQUE KEY tbl_unique (Batch)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table graduates
--
CREATE TABLE graduates (
  Graduate_Key int(10) unsigned NOT NULL auto_increment,
  Yearbook_Key int(10) NOT NULL,
  Course_Key int(10) NOT NULL,
  Pic_File varchar(100) NOT NULL,
  First_Name varchar(100) NOT NULL,
  Middle_Name varchar(100),
  Last_Name varchar(100) NOT NULL,
  Birth_Date int(10) unsigned,
  Gender varchar(15) NOT NULL,
  Home_Address varchar(100) NOT NULL,
  PRIMARY KEY  (Graduate_Key),
  UNIQUE KEY tbl_unique (Yearbook_Key, Course_Key, First_Name, Middle_Name, Last_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table bisu_officials
--
CREATE TABLE bisu_system_officials (
  Bisu_Official_Key int(10) unsigned NOT NULL auto_increment,
  Yearbook_Key int(10) NOT NULL,
  Full_Name varchar(255) NOT NULL,
  Position varchar(100),
  Office varchar(100) NOT NULL,
  PRIMARY KEY  (Bisu_Official_Key),
  UNIQUE KEY tbl_unique (Yearbook_Key, Full_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table board_of_regents
--
CREATE TABLE board_of_regents (
  Board_Key int(10) unsigned NOT NULL auto_increment,
  Yearbook_Key int(10) NOT NULL,
  Full_Name varchar(255) NOT NULL,
  Position varchar(100),
  Office varchar(100),
  PRIMARY KEY  (Board_Key),
  UNIQUE KEY tbl_unique (Yearbook_Key, Full_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table teaching_staff
--
CREATE TABLE teaching_staff (
  Staff_Key int(10) unsigned NOT NULL auto_increment,
  Yearbook_Key int(10) NOT NULL,
  Full_Name varchar(255) NOT NULL,
  Position varchar(100),
  Office varchar(100) NOT NULL,
  PRIMARY KEY  (Staff_Key),
  UNIQUE KEY tbl_unique (Yearbook_Key, Full_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table non_teaching_staff
--
CREATE TABLE non_teaching_staff (
  Staff_Key int(10) unsigned NOT NULL auto_increment,
  Yearbook_Key int(10) NOT NULL,
  Full_Name varchar(255) NOT NULL,
  Position varchar(100),
  Office varchar(100) NOT NULL,
  PRIMARY KEY  (Staff_Key),
  UNIQUE KEY tbl_unique (Yearbook_Key, Full_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table awardees_achievers
--
CREATE TABLE awardees_achievers (
  Awardee_Key int(10) unsigned NOT NULL auto_increment,
  Graduate_Key int(10) NOT NULL,
  Award varchar(100) NOT NULL,
  Award_Type varchar(10) NOT NULL,
  PRIMARY KEY  (Awardee_Key),
  UNIQUE KEY tbl_unique (Graduate_Key, Award)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table batch_officers
--
CREATE TABLE batch_officers (
  Officer_Key int(10) unsigned NOT NULL auto_increment,
  Yearbook_Key int(10) NOT NULL,
  Full_Name varchar(255) NOT NULL,
  Position varchar(100),
  PRIMARY KEY  (Officer_Key),
  UNIQUE KEY tbl_unique (Yearbook_Key, Full_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table yearbook_songs
--
CREATE TABLE yearbook_songs (
  Yaerbook_Song_Key int(10) unsigned NOT NULL auto_increment,
  Yearbook_Key int(10) NOT NULL,
  Song_Type varchar(30) NOT NULL,
  Song_Title varchar(100),
  Singer varchar(100),
  Lyrics longtext,
  PRIMARY KEY  (Yaerbook_Song_Key),
  UNIQUE KEY tbl_unique (Yearbook_Key, Song_Type)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

-- CREATE user 'bisu'@'localhost' identified by 'B!su';
-- GRANT ALL PRIVILEGES ON bisu_ybook.* TO 'bisu'@'localhost';
-- FLUSH PRIVILEGES;