<?


class Controller {

	public function __construct() {
		$this->config = new config();
		$this->db = new db();
		$this->db->connect();
	}

	//HELP -> render("View_name", "Ask - render_layout?", "Main Layout")
	public function render($view, $render_layout = false, $layout = "main") {
		if (empty($this->title)) $this->title = $this->config->default_title;
		$layout = "views/layouts/".$layout.".php";
		$this->template = $view;
		$view = "views/".$view.".php";
		
		//render_layout - RENDER VIEW / LAYOUT
		if ($render_layout == false) {
			if (file_exists($view)) 
				include($view);
			else new Page_404();
		}
		else {
			if (file_exists($layout))
				include($layout);
			else new Page_404();
		}
	}

	public function json($data) {
		echo json_encode($data);
	}

	public function json_return($data) {
		return json_encode($data);
	}

}

class Router {

	public function __construct($uri) {
		$config = new config();
		$uri = explode("/", $uri);
		$controller = $uri[1];
		$action = $uri[2];
		$variable = $uri[3];
		$value = $uri[4];

		if (empty($controller)) $controller = $config->default_controller;
		if (empty($action)) $action = $config->default_action;


		// ONE CONTROLLER LOGIC
		if ($config->no_controller) {
			$controller_file = "controllers/".$config->default_controller.".php";
			$controller = $config->default_controller;
			$action = $uri[1];

			if (empty($action))
				$action = $config->default_action;

		}
		else {
			$controller_file = "controllers/".$controller.".php";
		}

		// OPEN FILES AND RUN ACTION
		if (file_exists($controller_file)) {
			include($controller_file);
			$controller_name = "Controller".ucfirst($controller);
			$controller = new $controller_name;
			if (method_exists($controller, $action)) {
				$controller->uri = $uri;
				$controller->$action();
			}
			else {
				new Page_404();
			}
		}
		else {
			new Page_404();
		}
	}

}

class Page_404 {
	public function __construct() {
		include("views/layouts/404.php");
	}
}

?>