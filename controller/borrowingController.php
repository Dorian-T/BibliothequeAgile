<?php

class BorrowingController extends Controller {
	public function render() {
		$borrowings = $this->model->getBorrowings();
		require_once 'view/borrowing.php';
	}
}
