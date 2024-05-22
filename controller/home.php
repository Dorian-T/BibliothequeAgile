<?php

/**
 * Class HomeController
 *
 * This class represents the controller for the home page.
 * It extends the base Controller class.
 */
class HomeController extends Controller {

	// === Methods ===

	/**
	 * Renders the home page.
	 */
	public function render() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$title = isset($_POST['book_name']) ? $_POST['book_name'] : '';
			$books = $this->model->searchBookByName($title);
		} else {
			$books = $this->model->getAllBooks();
		}
		require_once 'view/home.php';
	}
}
