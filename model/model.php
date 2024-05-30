<?php

require_once 'model/db_connection.php';

/**
 * Model class.
 */
class Model {
	/**
	 * Database connection.
	 */
	private static $db;

	/**
	 * Constructor for the model class.
	 */
	public function __construct() {
		try {
			self::$db = new PDO('mysql:host='.SERVER.';dbname='.BASE.';charset=utf8', USER, PASSWD);
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}

	/**
	 * Execute an SQL request.
	 *
	 * @param string $requete The SQL query.
	 * @param array $params The parameters for the query.
	 * @return array The result set.
	 */
	public function executeRequest(string $requete, array $params = []) {
		try {
			$stmt = self::$db->prepare($requete);
			$stmt->execute($params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}

    
	/** 			-------------			   BOOK SECTION                     ----------------                              */


	/**
	 * Get all books from the database.
	 *
	 * @return array The list of books.
	 */
	public function getAllBooks() {
		$requete = "
			SELECT B.id, B.title, B.author, B.edition, B.publication_year, C.name AS genre, B.location
			FROM BOOK AS B JOIN CATEGORY AS C ON B.genre = C.id
			ORDER BY genre, author, title;
		";
		return $this->executeRequest($requete);
	}


	/**
	 * Search for a book by name.
	 *
	 * @param string $id The name of the book.
	 * @return array The book that match the name.
	 */
	public function getBookById($id) {
		$requete = "SELECT * FROM BOOK WHERE 'id' = ".$id."";
		return ($this->executeRequest($requete))[0];
	}

	/**
	 * Search for a book by name.
	 *
	 * @param string $nom The name of the book.
	 * @return array The list of books that match the name.
	 */
	public function searchBookByName(string $nom) {
		$requete = "SELECT B.id, B.title, B.author, B.edition, B.publication_year, C.name AS genre, B.location
			FROM BOOK AS B JOIN CATEGORY AS C ON B.genre = C.id WHERE title LIKE :name";
		$params = ['name' => '%' . $nom . '%'];
		return $this->executeRequest($requete, $params);
	}

    /**
     * Get for book by categories.
     *
     * @param string $id The id of the category.
     * @return array The list of authors.
     */
    public function getBooksByCategory($id) {
        $requete = "SELECT B.id, B.title, B.author, B.edition, B.publication_year, C.name AS genre, B.location
			FROM BOOK AS B JOIN CATEGORY AS C ON B.genre = C.id WHERE genre = :id";
        $params = ['id' => $id];
        return $this->executeRequest($requete, $params);
    }

	public function searchBookByTitleAndCategory(string $title, string $categoryID) {
		$requete = "SELECT * FROM BOOK WHERE title LIKE :name AND genre = :category";
		$params = ['name' => '%' . $title . '%', 'category' => $categoryID];
		return $this->executeRequest($requete, $params);
	}
	

    /**
     * Get all categories from the database.
     * 
     * @return array The list of categories.
     */
    public function getAllCategories() {
        $requete = "SELECT * FROM CATEGORY";
        return $this->executeRequest($requete);
    }

    /**
     * Search for a book by name and categories.
     *
     * @param string $nom The name of the book.
     * @return array The list of books that match the name.
     */
    public function searchBookByNameAndCategories(string $nom, string $id) {
        $requete = "SELECT B.id, B.title, B.author, B.edition, B.publication_year, C.name AS genre, B.location
			FROM BOOK AS B JOIN CATEGORY AS C ON B.genre = C.id WHERE title LIKE :name AND genre = :id";
        $params = ['name' => '%' . $nom . '%', 'id' => $id];
        return $this->executeRequest($requete, $params);
    }


	/**              ------------------------               CLIENT SECTION                  ------------------------                              */

	/**
	 * Register a new client in the database.
	 * 
	 * @param string $nom The last name of the client.
	 * @param string $prenom The first name of the client.
	 * @param string $date_naissance The birth date of the client.
	 * @param string $telephone The phone number of the client.
	 * @param string $email The email address of the client.
	 * @param string $adresse The address of the client.
	 * @return int The id of the new client.
	 */
	public function registerClient(string $nom, string $prenom, string $date_naissance, string $telephone, string $email) {
		$requete = "INSERT INTO customer (last_name, first_name, birth_date, phone, email, password, is_admin) VALUES (:nom, :prenom, :date_naissance, :telephone, :email, :password, 0)";
		$params = ['nom' => $nom, 'prenom' => $prenom, 'date_naissance' => $date_naissance, 'telephone' => $telephone, 'email' => $email, 'password' => "None"];
		$this->executeRequest($requete, $params);
		return self::$db->lastInsertId();
	}

	public function connexionAdmin($email, $password) {
		// Préparer et exécuter la requête SQL pour vérifier les informations d'identification
		$sql = "SELECT * FROM Customer WHERE email = :email AND password = :password AND is_admin = 1";
		$params = ['email' => $email, 'password' => $password];
		$result = $this->executeRequest($sql, $params);
	
		// Vérifier si un administrateur a été trouvé
		if (count($result) > 0) {
			return $result[0]; // Retourne les informations de l'administrateur
		} else {
			return false; // Aucune correspondance trouvée
		}
	}
	

	/**
	 * Search for a client by ID
	 * 
	 * @param int $id The id of the client.
	 * @return array The client that match the id.
	 */

	public function getClientById($id) {
		$requete = "SELECT * FROM customer WHERE id = :id";
		$params = ['id' => $id];
		return ($this->executeRequest($requete, $params))[0];
	}

	/**
	 * Get all clients from the database.
	 * 
	 * @return array The list of clients.
	 */
	public function getClients() {
		$requete = "SELECT * FROM customer";
		return $this->executeRequest($requete);
	}

	function getCustomerId($email){
		$requete = "SELECT id FROM customer WHERE email=:customer_email";
		$params = ['customer_email' => $email];
		return $this->executeRequest($requete, $params);
	}

	function borrowBook($book_id, $customer_id) { // on verra ça au moment du merge
		$sql = "INSERT INTO Borrowing (book_id, customer_id) VALUES (:book_id, :customer_id)";
		$params = ['book_id' => $book_id, 'customer_id' => $customer_id];
		return $this->executeRequest($sql, $params);
	}

	public function getReservedBooks() {
		$sql = "SELECT B.id AS book_id, B.title, B.author, C.id AS customer_id, C.first_name, C.last_name
				FROM BOOK AS B
					JOIN Reservation AS R ON B.id = R.book_id
					JOIN Customer AS C ON R.customer_id = C.id";
		return $this->executeRequest($sql);
	}

	/**
	 * Reserve a book for a customer.
	 *
	 * @param int $book_id The ID of the book to reserve.
	 * @param int $customer_id The ID of the customer reserving the book.
	 */
	public function reserveBook($book_id, $customer_id) {
		$sql = "INSERT INTO Reservation (book_id, customer_id) VALUES (:book_id, :customer_id)";
		$params = ['book_id' => $book_id, 'customer_id' => $customer_id];
		$this->executeRequest($sql, $params);
	}

	/**
	 * Cancel a reservation.
	 *
	 * @param int $book_id The ID of the book to cancel the reservation for.
	 * @param int $customer_id The ID of the customer who reserved the book.
	 */
	public function cancelReservation($book_id, $customer_id) {
		$sql = "DELETE
				FROM Reservation
				WHERE book_id = :book_id AND customer_id = :customer_id";
		$params = ['book_id' => $book_id, 'customer_id' => $customer_id];
		$this->executeRequest($sql, $params);
	}

	/** 			------------------------               BORROWING SECTION                  ------------------------                              */

	/**
	 * Get all borrowings from the database.
	 * 
	 * @return array The list of borrowings.
	 */
	public function getAllBorrowingsID() {
		$requete = "SELECT * FROM borrowing";
		return $this->executeRequest($requete);
	}

	/**
	 * Get all borrowings from a client by ID.
	 * 
	 * @param int $id The id of the client.
	 * @return array The list of borrowings.
	 */
	public function getClientBorrowingsID($id) {
		$requete = "SELECT * FROM borrowing WHERE customer_id = :id";
		$params = ['id' => $id];
		return $this->executeRequest($requete, $params);
	}

	/**
	 * Get all borrowings for a book by ID.
	 * 
	 * @param int $id The id of the book.
	 * @return array The list of borrowings.
	 */
	public function getBookBorrowingsID($id) {
		$requete = "SELECT * FROM borrowing WHERE book_id = :id";
		$params = ['id' => $id];
		return $this->executeRequest($requete, $params);
	}

	/**
	 * Aggregates the info from a client and a book.
	 * 
	 * @param int $bookID The id of the book.
	 * @param int $ClientID The id of the client.
	 * @return array The client and book info.
	 */
	public function convertBorrowingID($bookID,$ClientID) {
		$requete = "SELECT * FROM customer WHERE id = :ClientID";
		$params = ['ClientID' => $ClientID];
		$client = ($this->executeRequest($requete, $params))[0];
		$client["ClientID"] = $ClientID;
		$requete = "SELECT * FROM Book WHERE id = :bookID";
		$params = ['bookID' => $bookID];
		$book = ($this->executeRequest($requete, $params))[0];
		$book["BookID"] = $bookID;
		return $client + $book;
	}

	/**
	 * Converts a list of borrowings.
	 * 
	 * @param array $borrowings The list of borrowings.
	 * @return array The list of converted borrowings.
	 */
	public function convertBorrowings($borrowings) {
		$converted = [];
		foreach ($borrowings as $borrowing) {
			$converted[] = $this->convertBorrowingID($borrowing["book_id"],$borrowing["customer_id"]);
		}
		return $converted;
	}

	/**
	 * Get a borrowing by client and book ID.
	 * 
	 * @param int $ClientID The id of the client.
	 * @param int $bookID The id of the book.
	 * @return array The borrowing.
	 */
	public function getBorrowing($ClientID,$bookID) {
		$requete = "SELECT * FROM borrowing WHERE customer_id = :ClientID AND book_id = :bookID";
		$params = ['ClientID' => $ClientID, 'bookID' => $bookID];
		return ($this->executeRequest($requete, $params))[0];
	}

	/**
	 * Get all borrowings from the database.
	 * 
	 * @return array The list of borrowings.
	 */
	public function getBorrowings() {
		$requete = "SELECT * FROM borrowing";
		$rslt = $this->executeRequest($requete);
		return $this->convertBorrowings($rslt);
	}

	/**
	 * Deletes a borrowing from the database.
	 * 
	 * @param int $ClientID The id of the client.
	 * @param int $bookID The id of the book.
	 */
	public function deleteBorrow($ClientID,$bookID) {
		$requete = "DELETE FROM borrowing WHERE customer_id = :ClientID AND book_id = :bookID";
		$params = ['ClientID' => $ClientID, 'bookID' => $bookID];
		$this->executeRequest($requete, $params);
	}

	/**
	 * Adds a new borrowing to the database.
	 * 
	 * @param int $ClientID The id of the client.
	 * @param int $bookID The id of the book.
	 */
	public function newBorrow($ClientID,$bookID) {
		$requete = "INSERT INTO borrowing (customer_id, book_id) VALUES (:ClientID, :bookID)";
		$params = ['ClientID' => $ClientID, 'bookID' => $bookID];
		$this->executeRequest($requete, $params);
	}

	/**
	 * Get all unborrowed books from the database.
	 * 
	 * @return array The list of unborrowed books.
	 */
	public function getUnborrowedBooks() {
		$requete = "SELECT * FROM book WHERE id NOT IN (SELECT book_id FROM borrowing)";
		$requete .= " ORDER BY title";
		return $this->executeRequest($requete);
	}

}
