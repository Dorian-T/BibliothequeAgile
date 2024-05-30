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
				// if get customer == null alors créer
				$customerId = $this->model->getCustomerId($_POST['email']);

				if($customerId == null){
					$customerId = $this->model->registerClient($_POST['lastname'], $_POST['firstname'], "datedenaissance", "tel", $_POST['email'], "adresse");
				}else{
					$customerId = $customerId[0]['id'];
				}

				$this->model->reserveBook($this->bookId, $customerId);
				header('Location: ./');
			}
			require_once 'view/reservation.php';
		} else if($_SESSION['admin']) {
            $reservations = $this->model->getReservedBooks();
            require_once 'view/AdminReservation.php';
        } else {
            header('Location: ./');
		}
	}
}
