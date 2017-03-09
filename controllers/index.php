<?

	class ControllerIndex extends Controller {
		public function index() {
			//Redirect to Home action
			$this->render("home", true);
		}


		/* ---------- METHODS ------------ */

		public function get_login() {

		}

		
	}

?>