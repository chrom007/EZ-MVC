<?

	//DB CONNECT
	class db {
		public function __construct() {
			$this->config = new config();
			$this->connected = false;
			$this->database;
		}

		public function connect() {
			$login = $this->config->database_login;
			$password = $this->config->database_password;
			$host = $this->config->database_host;
			$port = $this->config->database_port;
			
			if (!empty($login))
				$auth = "${login}:${password}@";

			if ($mongo = new Mongo("mongodb://$auth${host}:${port}")) {
				$db = $this->config->database;
				$this->database = $mongo->$db;
				$this->connected = true;
			}
		}

		public function select($select, $where = "", $sort = false) {
			$table = $this->database->$select;
			//FIND BY VAR or ALL
			if (empty($where)) $items = $table->find();
			else $items = $table->find($where);

			if ($sort != false) {
				$items->sort($sort);
			}
			
			$data = array();
			foreach ($items as $item) {
				$data[] = $item;
			}
			return $data;
		} 

		public function insert($table, $insert) {
			$this->database->$table->insert($insert);
		}

		public function number($table, $where, $rows) {
			$arr = array('$inc'=>$rows);
			$this->database->$table->update($where, $arr);
		}

		public function arrayAdd($table, $where, $add) {
			$arr = array('$addToSet'=>$add);
			$this->database->$table->update($where, $arr);
		}

		public function arrayRemove($table, $where, $remove) {
			$arr = array('$pull'=>$remove);
			$this->database->$table->update($where, $arr);
		}

		public function update($table, $where, $update) {
			$rows = array('$set'=>$update);
			$this->database->$table->update($where, $rows);
		}

		public function delete($table, $delete) {
			$this->database->$table->remove($delete);
		}

		public function close() {
			$this->database->close();
		}



		public function default_user($array) {
			$time = time();
			$default = array(
				'avatar' => '/img/avatar/default.png',
				'gender' => 'male',
				'money' => 100,
				'reg_date' => "$time",
				'last_login' => "$time",
			);

			foreach ($default as $key => $value) {
				$array[$key] = $value;
			}

			return $array;
		}




	}
	
?>