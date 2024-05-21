<?php

/**
 * class RegisterController
 * 
 * This class is the controller for the register page.
 * It extends the base Controller class.
 */
class RegisterController extends Controller {

	// === Methods ===

	/**
	 * Renders the register page.
	 */
	public function render() {
		require_once 'view/register.php';
	}
}