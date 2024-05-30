<?php

/**
 * class RegisterController
 * 
 * This class is the controller for the register page.
 * It extends the base Controller class.
 */
class borrowController extends Controller {

	// === Methods ===

	/**
	 * Renders the register page.
	 */
	public function render() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$book_id = isset($_POST['book_id']) ? $_POST['book_id'] : '';
			$customer_email = isset($_POST['customer_email']) ? $_POST['customer_email'] : '';
			$customer_id = $this->model->getCustomerId($customer_email);
			$state = $this->model->borrowBook($book_id, $customer_id);
			
			if ($state){
				require_once 'view/search.php';
			}
			echo("Erreur lors de l'empreint");
		} else {
			header('Location: ./');
		}
	}
}