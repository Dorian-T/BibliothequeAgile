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
			$id = isset($_POST['book_id']) ? $_POST['book_id'] : '';
			$book = $this->model->getBookById($id);
			require_once 'view/search.php';
		} else {
			header('Location: ./');
		}
	}
}