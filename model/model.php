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
     * @param string $nom The name of the book.
     * @return array The list of books that match the name.
     */
	public function searchBookByName(string $nom) {
        $requete = "SELECT * FROM BOOK WHERE name LIKE :name";
        $params = ['name' => '%' . $nom . '%'];
        return $this->executeRequest($requete, $params);
    }


	// === Il faut coder ici ===
}
