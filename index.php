<?php

session_start();

// Models
require_once 'model/model.php';

// Controllers
require_once 'controller/controller.php';
require_once 'controller/home.php';
require_once 'controller/registerController.php';
require_once 'controller/borrowingController.php';


// Rooter
if(isset($_GET['action'])) {
	switch($_GET['action']) {
		case 'home':
			$controller = new HomeController();
			$controller->render();
			break;

		case 'register':
			$controller = new RegisterController();
			$controller->render();
			break;

		case 'borrowing':
			$controller = new BorrowingController();
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
