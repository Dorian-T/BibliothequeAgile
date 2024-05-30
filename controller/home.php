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
        $categories = $this->model->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $title = isset($_POST['book_name']) ? trim($_POST['book_name']) : '';
            $idCategory = isset($_POST['categorie-select']) ? trim($_POST['categorie-select']) : '';

            $books = [];

            // Search for books by name
            if (!empty($title)) {
                $books = $this->model->searchBookByName($title);
            }
            
            // Search for books by category
            if (empty($books) && !empty($idCategory)) {
                $books = $this->model->getBooksByCategory($idCategory);
            }

            // If no search criteria, get all books
            if (empty($books)) {
                $books = $this->model->getAllBooks();
            }

        } else {
            $books = $this->model->getAllBooks();
        }

        require_once 'view/home.php';
    }

}
