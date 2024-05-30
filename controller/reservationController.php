<?php

/**
 * Class ReservationController
 *
 * This class represents the controller for the home page.
 * It extends the base Controller class.
 */
class ReservationController extends Controller
{
	private int $bookId;
	// === Methods ===
	public function setId($id)
	{
		$this->bookId = $id;
	}


	/**
	 * Renders the home page.
	 */
	public function render()
	{

		if ($this->bookId != null) {
			if (isset($_POST['submit'])) {
				//$books = $this->model->getAllBooks();
				//isset($_POST['email'])
				//isset($_POST['firstname'])
				//isset($_POST['lastname'])
				//$this->id
				
				//tester si la personne est deja créée

				echo("Voici les champs récuérés:" . $_POST['email'] . " " . $_POST['firstname'] . " " . $_POST['lastname']);
				echo("Voici l'id:" . $this->bookId);
				$customerId = $this->model->getCustomerId($_POST['email']);
				echo('$customerId'. $customerId);
				
				if($customerId == null){
					$customerId = $this->model->registerClient($_POST['lastname'], $_POST['firstname'], "datedenaissance", "tel", $_POST['email'], "adresse");
				}
				echo('$customerId'. $customerId);
				$this->model->reserveBook($this->bookId, $customerId);
			}
		} else {
			//retourner sur home
		}

		require_once 'view/reservation.php';
	}

	

}
