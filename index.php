<?
	session_start();
	
	//Core files
	include("engine/config.php");
	include("engine/db.php");
	include("engine/core.php");

	//Database
	$db = new db();

	//$controller = new Controller();
	//$controller->render("index");

	new Router($_SERVER["REQUEST_URI"]);

?>