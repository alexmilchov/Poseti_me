<?php
$sec_key = '9AFG762s602235df058s@15522!8453725017$918167789^670KNB23QUY731446$8755842!59@407$32';
if(isset($_POST['secure']) && isset($_POST['id'])){

	$id = (int) $_POST['id'];
	$secure = $_POST['secure'];
	
	if($secure == $sec_key && $id>0){
	
		include "map_php/init.php";
		include '../dbconnect.php';

		
		if($db->isVisitedSight($userRow['userId'],$id) == false){
		$addVisit = $db->addVisitedSight($userRow['userId'],$id);
		$updateVisited = $db->VisitedSight($id);

			if($updateVisited && $addVisit) echo 1;
		} else {
			echo 2;
		}
	}
}

?>