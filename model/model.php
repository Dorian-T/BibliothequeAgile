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

    

	/**
	 * Get all books from the database.
	 *
	 * @return array The list of books.
	 */
	public function getAllBooks() {
		$requete = "SELECT * FROM BOOK";
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
     * @return array The list of authors.
     */


	// === Il faut coder ici ===



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
	
}
