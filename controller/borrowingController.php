<?php

/**
 * Class BorrowingController
 * 
 * This class is the controller for the borrowing page.
 * It extends the base Controller class.
 */
class BorrowingController extends Controller {

	// === Methods ===

	/**
	 * Renders the borrowing page.
	 */
	public function render() {
		
		if (isset ($_POST["Rendre"])) {
			// Delete a borrowing
			$idClient = isset($_POST['ClientID']) ? $_POST['ClientID'] : '';
			$idBook = isset($_POST['BookID']) ? $_POST['BookID'] : '';
			$this->model->deleteBorrow($idClient, $idBook);
		}
		
		if (isset ($_POST["Borrow"])) {
			if (isset($_POST['ClientID']) && isset($_POST['BookID'])) {
				// Add a new borrowing
				$idClient = $_POST['ClientID'];
				$idBook = $_POST['BookID'];
				$this->model->newBorrow($idClient, $idBook);
				header('Location: index.php?action=borrowing');
			}
			// Redirect to the borrowing form
			$clients = $this->model->getClients();
			$books = $this->model->getUnborrowedBooks();
			require_once 'view/borrowingForm.php';
	
		}
		else {
			// Redirect to the borrowing page
			$borrowings = $this->model->getBorrowings();
			require_once 'view/borrowing.php';
		}

	}
}
