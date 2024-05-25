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
        // Obtenez toutes les catégories
        $categories = $this->model->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer le titre du livre et l'ID de catégorie depuis le formulaire
            $title = isset($_POST['book_name']) ? trim($_POST['book_name']) : '';
            $idCategory = isset($_POST['categorie-select']) ? trim($_POST['categorie-select']) : '';

            // Initialiser la variable des livres
            $books = [];

            if (!empty($title)) {
                $books = $this->model->searchBookByName($title);
            }

            if (empty($books) && !empty($idCategory)) {
                $books = $this->model->getBooksByCategory($idCategory);
            }

            // Si aucune recherche n'a été effectuée, obtenir tous les livres
            if (empty($books)) {
                $books = $this->model->getAllBooks();
            }

        } else {
            // Si ce n'est pas une requête POST, obtenir tous les livres
            $books = $this->model->getAllBooks();
        }

        // Inclure la vue home.php avec les livres et les catégories
        require_once 'view/home.php';
    }

}
