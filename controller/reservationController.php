<?php

/**
 * Class ReservationController
 *
 * This class represents the controller for the home page.
 * It extends the base Controller class.
 */
class ReservationController extends Controller
{

	// === Methods ===

	/**
	 * Renders the home page.
	 */
	public function render()
	{

		if ($this->id != null) {
			if (isset($_POST['submit'])) {
				//$books = $this->model->getAllBooks();
			}
		} else {
			//retourner sur home
		}

		require_once 'view/reservation.php';
	}

	public function setId($id)
	{
		$this->id = $id;
	}

}
