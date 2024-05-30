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

	public function getBookId() {
		return $this->bookId;
	}


	/**
	 * Renders the home page.
	 */
	public function render()
	{

		if ($this->bookId != null) {
			$bookId = $this->bookId;
			if (isset($_POST['submit'])) {
				//$books = $this->model->getAllBooks();
				//isset($_POST['email'])
				//isset($_POST['firstname'])
				//isset($_POST['lastname'])
				//$this->id
				
				//tester si la personne est deja créée


				// if get customer == null alors créer
				$customerId = $this->model->getCustomerId($_POST['email']);

				
				
				if($customerId == null){
					$customerId = $this->model->registerClient($_POST['lastname'], $_POST['firstname'], "datedenaissance", "tel", $_POST['email'], "adresse");
				}

				$this->model->reserveBook($this->bookId, $customerId);
			}
		} else {
			echo("erreur bookid vide");
			//retourner sur home
		}

		require_once 'view/reservation.php';
	}

	

}
