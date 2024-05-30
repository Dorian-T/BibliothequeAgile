<?php

/**
 * Class ReservationController
 *
 * This class represents the controller for the home page.
 * It extends the base Controller class.
 */
class ReservationController extends Controller
{
	private int $id;
	// === Methods ===
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * Renders the home page.
	 */
	public function render()
	{

		if ($this->id != null) {
			if (isset($_POST['submit'])) {
				//$books = $this->model->getAllBooks();
				//isset($_POST['email'])
				//isset($_POST['firstname'])
				//isset($_POST['lastname'])
				//$this->id
				
			}
		} else {
			//retourner sur home
		}

		require_once 'view/reservation.php';
	}

	

}
