<?php

class DB{
	
	function __construct($config){
		$attributes = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");
		$dbopts = $config['db_opts'];
		$this->pdo = new PDO("mysql:host=" . $dbopts['DB_host'] . ";dbname=" . $dbopts['DB_name'], $dbopts['DB_user'], $dbopts['DB_pass'], $attributes);
	}

	public function getAllSights(){
		$sql = "SELECT * FROM `sights`";

		$query = $this->pdo->prepare($sql);
		$query->execute();
		$result_array = $query->fetchAll(PDO::FETCH_ASSOC);

		if(count($result_array) > 0){
			return $result_array;
		}
		return array();
	}
	
	public function VisitedSight($id){
		$sql = "UPDATE `sights` SET visited = visited+1 WHERE s_id = $id";

		$query = $this->pdo->prepare($sql);
		return $query->execute();

	}
	public function addVisitedSight($id,$user_id){
		$sql = "INSERT INTO `user_visits` (user_id,s_id) VALUES ($user_id, $id)";

		$query = $this->pdo->prepare($sql);
		return $query->execute();

	}
		public function isVisitedSight($id,$user_id){
		$sql = "SELECT count(*) AS count FROM `user_visits` WHERE s_id = $id AND user_id = $user_id";

		$query = $this->pdo->prepare($sql);
		$query->execute();
	 
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if($result['count'] == 0){
			return false;
		} else {
			return true;
		}

	}
	public function getTopVisited(){
		$sql = "SELECT * FROM `sights` ORDER BY `visited` DESC LIMIT 4";
		$query = $this->pdo->prepare($sql);
		$query->execute();
		$result_array = $query->fetchAll(PDO::FETCH_ASSOC);

		if(count($result_array) > 0){
			return $result_array;
		}
		return array();
	}

	public function getUserVisited($user_id){
	    $sql = "SELECT * FROM `user_visits` JOIN `sights` ON `user_visits`.`user_id`=`sights`.`s_id` WHERE `user_visits`.`s_id`=?";
        $query = $this->pdo->prepare($sql);
        $query->execute(array($user_id));
        $result_array = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($result_array) > 0){
            return $result_array;
        }
        return array();
    }
}


?>