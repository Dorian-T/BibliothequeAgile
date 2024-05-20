<?php

/**
 * Class HomeController
 *
 * This class represents the controller for the home page.
 * It extends the base Controller class.
 */
class HomeController extends Controller {

	// === Methods ===

	/**
	 * Renders the home page.
	 */
	public function render() {
		// TODO: Implement some code here

		require_once 'view/home.php';
	}
}
