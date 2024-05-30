<?php
/**
 * The HomeController class represents the controller for the home page.
 * It extends the base Controller class.
 */
class HomeController extends Controller {

    /**
     * Renders the home page.
     * 
     * This method retrieves categories and books data based on user input
     * and renders the home page view accordingly.
     * 
     * @return void
     */
    public function render() {
        $categories = $this->model->getAllCategories();
        
        $selectedCategory = '';
        $books = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = isset($_POST['book_name']) ? trim($_POST['book_name']) : '';
            $selectedCategory = isset($_POST['categorie-select']) ? $_POST['categorie-select'] : '';

            // On traite les différents cas de recherche
            if (!empty($title) && !empty($selectedCategory)) {
                $books = $this->model->searchBookByTitleAndCategory($title, $selectedCategory);
            } elseif (!empty($title)) {
                $books = $this->model->searchBookByName($title);
            }

            if (empty($books) && !empty($selectedCategory)) {
                $books = $this->model->getBooksByCategory($selectedCategory);
            }

            if (!empty($title) && !empty($selectedCategory)) {
                $books = $this->model->searchBookByNameAndCategories($title, $selectedCategory);
            }

            if (empty($books)) {
                $books = $this->model->getAllBooks();
            }
        } else {
            $books = $this->model->getAllBooks();
        }

        require_once 'view/home.php';
    }
}