<?php

class BorrowingController extends Controller {
	public function render() {
		var_dump($_POST);
		if (isset ($_POST["Rendre"])) {
			$idClient = isset($_POST['ClientID']) ? $_POST['ClientID'] : '';
			$idBook = isset($_POST['BookID']) ? $_POST['BookID'] : '';
			$this->model->deleteBorrow($idClient, $idBook);
		}
		$borrowings = $this->model->getBorrowings();
		require_once 'view/borrowing.php';
	}
}
