<?php

/**
 * class RegisterController
 *
 * This class is the controller for the register page.
 * It extends the base Controller class.
 */
class SearchController extends Controller {

	// === Methods ===

	/**
	 * Renders the register page.
	 */
	public function render() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$title = isset($_POST['book_name']) ? $_POST['book_name'] : '';
			$books = $this->model->searchBookByName($title);
		} else {
			$books = $this->model->getAllBooks();
		}
		require_once 'view/search.php';
	}
}
