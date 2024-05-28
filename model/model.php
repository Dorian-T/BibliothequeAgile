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
			SELECT B.title, B.author, B.edition, B.publication_year, C.name AS genre, B.location
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
		$requete = "SELECT * FROM BOOK WHERE title LIKE :name";
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
        $requete = "SELECT * FROM BOOK WHERE genre = :id";
        $params = ['id' => $id];
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
	public function registerClient(string $nom, string $prenom, string $date_naissance, string $telephone, string $email, string $adresse) {
		$requete = "INSERT INTO customer (last_name, first_name, birth_date, phone, email) VALUES (:nom, :prenom, :date_naissance, :telephone, :email)";
		$params = ['nom' => $nom, 'prenom' => $prenom, 'date_naissance' => $date_naissance, 'telephone' => $telephone, 'email' => $email];
		$this->executeRequest($requete, $params);
		return self::$db->lastInsertId();
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

	public function getClients() {
		$requete = "SELECT * FROM customer";
		return $this->executeRequest($requete);
	}

	/** 			------------------------               BORROWING SECTION                  ------------------------                              */
	public function getAllBorrowingsID() {
		$requete = "SELECT * FROM borrowing";
		return $this->executeRequest($requete);
	}

	public function getClientBorrowingsID($id) {
		$requete = "SELECT * FROM borrowing WHERE customer_id = :id";
		$params = ['id' => $id];
		return $this->executeRequest($requete, $params);
	}

	public function getBookBorrowingsID($id) {
		$requete = "SELECT * FROM borrowing WHERE book_id = :id";
		$params = ['id' => $id];
		return $this->executeRequest($requete, $params);
	}

	public function convertBorrowing($bookID,$ClientID) {
		$requete = "SELECT * FROM customer WHERE id = :ClientID";
		$params = ['ClientID' => $ClientID];
		$client = ($this->executeRequest($requete, $params))[0];
		$client["ClientID"] = $ClientID;
		$requete = "SELECT * FROM Book WHERE id = :bookID";
		$params = ['bookID' => $bookID];
		$book = ($this->executeRequest($requete, $params))[0];
		$book["bookID"] = $bookID;
		return $client + $book;
	}
	public function convertBorrowings($borrowings) {
		$converted = [];
		foreach ($borrowings as $borrowing) {
			$converted[] = $this->convertBorrowing($borrowing["book_id"],$borrowing["customer_id"]);
		}
		return $converted;
	}

	public function getBorrowing($ClientID,$bookID) {
		$requete = "SELECT * FROM borrowing WHERE customer_id = :ClientID AND book_id = :bookID";
		$params = ['ClientID' => $ClientID, 'bookID' => $bookID];
		return ($this->executeRequest($requete, $params))[0];
	}

	public function getBorrowings() {
		$requete = "SELECT * FROM borrowing";
		$rslt = $this->executeRequest($requete);
		return $this->convertBorrowings($rslt);
	}

	public function deleteBorrow($ClientID,$bookID) {
		$requete = "DELETE FROM borrowing WHERE customer_id = :ClientID AND book_id = :bookID";
		$params = ['ClientID' => $ClientID, 'bookID' => $bookID];
		$this->executeRequest($requete, $params);
	}

	public function newBorrow($ClientID,$bookID) {
		$requete = "INSERT INTO borrowing (customer_id, book_id, borrowing_date) VALUES (:ClientID, :bookID, NOW())";
		$params = ['ClientID' => $ClientID, 'bookID' => $bookID];
		$this->executeRequest($requete, $params);
	}

}
