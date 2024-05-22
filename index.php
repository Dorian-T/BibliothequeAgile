<?php

session_start();

// Models
require_once 'model/model.php';

// Controllers
require_once 'controller/controller.php';
require_once 'controller/home.php';
require_once 'controller/registerController.php';


// Rooter
if(isset($_GET['action'])) {
	switch($_GET['action']) {
		// case '...':
		// 	$controller = new ...
		// 	$controller->render();
		// 	break;

		case 'home':
			$controller = new HomeController();
			$controller->render();
			break;
			

		case 'register':
			$controller = new RegisterController();
			$controller->render();
			break;

		default:
			header('Location: ./');
			break;
	}
}
else {
	$controller = new HomeController();
	$controller->render();
}
