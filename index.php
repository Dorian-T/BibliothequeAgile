<?php

session_start();

// Models
require_once 'model/model.php';

// Controllers
require_once 'controller/controller.php';
require_once 'controller/home.php';
require_once 'controller/registerController.php';
require_once 'controller/borrowingController.php';
require_once 'controller/adminLoginController.php';


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
				if (!isset($_SESSION['admin'])) {
					// Redirige vers la page de connexion admin si pas connecté
					header('Location: index.php?action=adminlogin');
					exit();
				}
				$controller = new BorrowingController();
				$controller->render();
				break;

		case 'adminlogin':
			$controller = new AdminLoginController();
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
