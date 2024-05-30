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

	public function __construct() {
		parent::__construct();
		$this->bookId = -1;
	}

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
		if ($this->bookId != -1) {
			$bookId = $this->bookId;
			if (isset($_POST['submit'])) {
				// if get customer == null alors créer
				$customerId = $this->model->getCustomerId($_POST['email']);

				if($customerId == null){
					$customerId = $this->model->registerClient($_POST['lastname'], $_POST['firstname'], $_POST['birthdate'], $_POST['phone'], $_POST['email']);
				}else{
					$customerId = $customerId[0]['id'];
				}

				$this->model->reserveBook($this->bookId, $customerId);
				header('Location: ./');
			}
			require_once 'view/reservation.php';
		} elseif($_SESSION['admin']) {
            $reservations = $this->model->getReservedBooks();
			if(isset($_POST['valider'])) {
				$this->model->borrowBook($_POST['bookId'], $_POST['customerId']);
				$this->model->cancelReservation($_POST['bookId'], $_POST['customerId']);
				header('Location: index.php?action=reservation');
			} elseif(isset($_POST['annuler'])) {
				$this->model->cancelReservation($_POST['bookId'], $_POST['customerId']);
				header('Location: index.php?action=reservation');
			}
            require_once 'view/AdminReservation.php';
        } else {
            header('Location: ./');
		}
	}
}
