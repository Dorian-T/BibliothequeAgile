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
        $selectedCategory = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = isset($_POST['book_name']) ? trim($_POST['book_name']) : '';
            $selectedCategory = isset($_POST['categorie-select']) ? $_POST['categorie-select'] : '';

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
            } elseif (!empty($selectedCategory)) {
                $books = $this->model->getBooksByCategory($selectedCategory);
            } else {
                $books = $this->model->getAllBooks();
            }
        } else {
            $books = $this->model->getAllBooks();
        }

        require_once 'view/home.php';
    }
}
