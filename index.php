<?php

session_start();

// Models
require_once 'model/model.php';

// Controllers
require_once 'controller/controller.php';
require_once 'controller/home.php';


// Rooter
if(isset($_GET['action'])) {
	switch($_GET['action']) {
		// case '...':
		// 	$controller = new ...
		// 	$controller->render();
		// 	break;

		default:
			header('Location: ./');
			break;
	}
}
else {
	$controller = new HomeController();
	$controller->render();
}
