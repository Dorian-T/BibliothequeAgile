<?php

class BorrowingController extends Controller {
	public function render() {
		
		if (isset ($_POST["Rendre"])) {
			$idClient = isset($_POST['ClientID']) ? $_POST['ClientID'] : '';
			$idBook = isset($_POST['BookID']) ? $_POST['BookID'] : '';
			$this->model->deleteBorrow($idClient, $idBook);
		}
			
		
		if (isset ($_POST["Borrow"])) {
			if (isset($_POST['ClientID']) && isset($_POST['BookID'])) {
				$idClient = $_POST['ClientID'];
				$idBook = $_POST['BookID'];
				$this->model->newBorrow($idClient, $idBook);
				//redirect to borrowing page
				header('Location: index.php?action=borrowing');
			}
			$clients = $this->model->getClients();
			$books = $this->model->getUnborrowedBooks();
			require_once 'view/borrowingForm.php';
	
		}
		else {
			$borrowings = $this->model->getBorrowings();
			require_once 'view/borrowing.php';
		}
		
	}
}
