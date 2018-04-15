<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/cms/config.php";

/** Full path to the folder that images will be used as library and upload. Include trailing slash */
define('LIBRARY_FOLDER_PATH', $_SERVER['DOCUMENT_ROOT'].'/uploads/tinymce/');

/** Full URL to the folder that images will be used as library and upload. Include trailing slash and protocol (i.e. http://) */
define('LIBRARY_FOLDER_URL', URL . 'uploads/tinymce/');

/** The extensions for to use in validation */
define('ALLOWED_IMG_EXTENSIONS', 'gif,jpg,jpeg,png,jpe,pdf,doc,xls');

/**  Use these 3 functions to check cookies and sessions for permission. 
Simply write your code and return true or false */


function CanAcessLibrary(){
	return true;
}

function CanAcessUploadForm(){
	return true;
}

function CanAcessAllRecent(){
	return true;
}

function CanCreateFolders(){
	return true;
}

function CanDeleteFiles(){
	return true;
}

function CanDeleteFolder(){
	return true;
}

function CanRenameFiles(){
	return true;
}

function CanRenameFolder(){
	return true;
}
