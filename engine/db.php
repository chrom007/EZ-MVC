<?

	//DB CONNECT
	class db {

		public function __construct() {
			$this->config = new config();
			$this->connected = false;
			$this->database;
		}

		public function connect() {
			$host = $this->config->db_host;
			$user = $this->config->db_user;
			$pass = $this->config->db_pass;
			$db_name = $this->config->db_name;

			$db = mysql_connect($host, $user, $pass);
			mysql_select_db($db_name);
			mysql_set_charset("utf8", $db);

			$this->connected = true;
		}


		/* -------------- MODELS --------------- */

		public function cutString($string, $length) {

			$size = strlen($string);

			if ($size > $length) {
				$text = substr($string, 0, $length).'...';
				return $text;
			}
			else {
				return $string;
			}

		}

		public function getAll($query) {

			$data = array();
			$sql = mysql_query($query);
			while($temp = mysql_fetch_assoc($sql)) {
				$data[] = $temp;
			}

			return $data;

		}
		public function getAllFrom($table) {

			$data = array();
			$sql = mysql_query("SELECT * FROM `$table`");
			while($temp = mysql_fetch_assoc($sql)) {
				$data[] = $temp;
			}

			return $data;

		}

		public function getAllExt($table, $parameters) {

			$data = array();
			$sql = mysql_query("SELECT * FROM `$table` $parameters");
			while($temp = @mysql_fetch_assoc($sql)) {
				$data[] = $temp;
			}

			return $data;

		}

		public function getOne($query) {
			$data = array();
			$sql = mysql_query($query);
			$data = mysql_fetch_assoc($sql);

			return $data;
		}


		public function query($query) {
			return mysql_query($query); 
		}


	}
	
?>