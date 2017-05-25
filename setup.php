<?php
include 'header.php';
connectDb();

$install = mysqli_query($GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS husers(
h_alias VARCHAR(100),
h_author VARCHAR(12),
h_avatar VARCHAR(100), 
h_center VARCHAR(100),
h_code VARCHAR(16),
h_created DATE,
h_custom VARCHAR(12),
h_description TEXT,
h_email VARCHAR(50),
h_fav INT(5),
h_key VARCHAR(100),
h_level VARCHAR(12),
h_link VARCHAR(100),
h_location VARCHAR(50),
h_logdate VARCHAR(12),
h_logip VARCHAR(20),
h_notes TEXT,
h_password VARCHAR(50),
h_phone VARCHAR(20),
h_status VARCHAR(20),
h_style VARCHAR(100),
h_type VARCHAR(50),
h_updated DATE,
h_username VARCHAR(20),
PRIMARY KEY(h_code)
);";"

CREATE TABLE IF NOT EXISTS hresources (
id INT(10) NOT NULL AUTO_INCREMENT,
h_alias VARCHAR(100),
h_author VARCHAR(12),
h_avatar VARCHAR(20),
h_by VARCHAR(20), 
h_center VARCHAR(20),
h_code VARCHAR(16),
h_created DATE,
h_custom VARCHAR(12),
h_description TEXT,
h_email VARCHAR(50),
h_fav INT(5),
h_key VARCHAR(100),
h_level VARCHAR(12),
h_link VARCHAR(100),
h_location VARCHAR(50),
h_notes TEXT,
h_phone VARCHAR(20),
h_status VARCHAR(20),
h_type VARCHAR(50),
h_updated DATE,
PRIMARY KEY(id)
)";"

CREATE TABLE IF NOT EXISTS hmessages(
id INT(10) NOT NULL AUTO_INCREMENT,
h_alias VARCHAR(100),
h_author VARCHAR(20),
h_by VARCHAR(20),
h_code VARCHAR(16),
h_created DATE,
h_description TEXT,
h_email VARCHAR(50),
h_for VARCHAR(20),
h_key VARCHAR(100),
h_level VARCHAR(12),
h_link VARCHAR(100),
h_phone VARCHAR(20),
h_status VARCHAR(20),
h_type VARCHAR(50),
PRIMARY KEY(id)
)";"

CREATE TABLE IF NOT EXISTS hnotifications(
id INT(10) NOT NULL AUTO_INCREMENT,
h_alias VARCHAR(100),
h_author VARCHAR(20),
h_by VARCHAR(20),
h_code VARCHAR(16),
h_created DATE,
h_description TEXT,
h_email VARCHAR(50),
h_for VARCHAR(20),
h_key VARCHAR(100),
h_level VARCHAR(12),
h_link VARCHAR(100),
h_status VARCHAR(20),
h_type VARCHAR(50),
h_updated DATE,
PRIMARY KEY(id)
)";"

CREATE TABLE IF NOT EXISTS huploads(
id INT(10) NOT NULL AUTO_INCREMENT,
h_alias VARCHAR(100),
h_author VARCHAR(12),
h_avatar VARCHAR(20),
h_by VARCHAR(20), 
h_center VARCHAR(20),
h_code VARCHAR(16),
h_created DATE,
h_custom VARCHAR(12),
h_description TEXT,
h_email VARCHAR(50),
h_for VARCHAR(20),
h_key VARCHAR(100),
h_level VARCHAR(12),
h_link VARCHAR(100),
h_location VARCHAR(50),
h_notes TEXT,
h_phone VARCHAR(20),
h_status VARCHAR(20),
h_type VARCHAR(50),
h_updated DATE,
PRIMARY KEY(id)
)";"

CREATE TABLE IF NOT EXISTS harticles(
id INT(10) NOT NULL AUTO_INCREMENT,
h_alias VARCHAR(300),
h_author VARCHAR(20),
h_by VARCHAR(100),
h_avatar VARCHAR(100),
h_category VARCHAR(20), 
h_center VARCHAR(20),
h_code VARCHAR(16),
h_created DATE,
h_description TEXT,
h_email VARCHAR(50),
h_fav INT(5),
h_key VARCHAR(100),
h_level VARCHAR(12),
h_link VARCHAR(100),
h_location VARCHAR(100),
h_notes TEXT,
h_phone VARCHAR(100),
h_reading VARCHAR(500),
h_status VARCHAR(20),
h_subtitle VARCHAR(100),
h_tags VARCHAR(50),
h_type VARCHAR(50),
h_updated DATE,
PRIMARY KEY(id)
)";"

CREATE TABLE IF NOT EXISTS hnotes (
id INT(10) NOT NULL AUTO_INCREMENT,
h_author VARCHAR(20),
h_by VARCHAR(100),
h_created DATE,
h_description TEXT,
h_for VARCHAR(20),
h_link VARCHAR(100),
h_type VARCHAR(50),
PRIMARY KEY(id)
)";"

CREATE TABLE IF NOT EXISTS hratings (
id INT(10) NOT NULL AUTO_INCREMENT,
h_author VARCHAR(20),
h_code VARCHAR(16),
h_for VARCHAR(20),
h_type VARCHAR(50),
PRIMARY KEY(id)
)";"

CREATE TABLE IF NOT EXISTS hfaqs (
h_alias VARCHAR(100),
h_code VARCHAR(16),
h_description TEXT,
h_type VARCHAR(50),
PRIMARY KEY(h_code)
)";

if ($install) {
	echo 'Successfully Installed!';
} else {
	echo 'Installation Error!';
}
?>
<title>Setup [ IHAP ]</title>