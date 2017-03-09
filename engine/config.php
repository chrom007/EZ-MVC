<?

	class config {
		public function __construct() {
			$server = $_SERVER['SERVER_NAME'];
			$remote_server = 'wayrma.rest';
			$remote_server_ip = '192.168.1.10';

			if ($server == $remote_server or $server == $remote_server_ip) {
				// LOCALHOST
				$this->db_host = "localhost";
				$this->db_name = "wayrma";
				$this->db_user = "root";
				$this->db_pass = "";
			}
			else {
				// REMOTE HOST (WEB)
				$this->db_host = "93.175.221.13";
				$this->db_name = "wayrma";
				$this->db_user = "root";
				$this->db_pass = "";
			}


			$this->domain = $_SERVER["SERVER_NAME"];
			$this->default_controller = "index";
			$this->default_action = "index";
			$this->default_title = "Wayrma REST API";
			$this->no_controller = true;
		}
	}

?>
