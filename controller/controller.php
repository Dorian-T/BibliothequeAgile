<?php

/**
 * Class Controller
 *
 * This class should be extended by all controllers.
 */
class Controller {

    // === Variables ===

    /**
     * @var Model $model The model object used by the controller.
     */
    protected Model $model;


    // === Methods ===

    /**
     * Class constructor.
     */
    public function __construct() {
        $this->model = new Model();

        if (isset($_POST["action"])) {
            if ($_POST["action"] == "registerClient") {
                $this->registerClient();
            }
        }

    }

    /**
     * Renders the view associated with the controller.
     */
    public function render() {
        echo 'This method should be overriden.';
    }

    private function registerClient() {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $date_naissance = $_POST["date_naissance"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];
        $adresse = $_POST["adresse"];

        $this->model->registerClient($nom, $prenom, $date_naissance, $telephone, $email, $adresse);
    }
}
