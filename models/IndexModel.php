<?php 
	include_once sysPrefix . 'safemysql' . sysPostfix;
	
	function getTaskList($orderField, $orderSorting, $offset){

		$db = connetDb();
		$sql='SELECT * 	FROM `task` ORDER BY `' . $orderField . '` ' . $orderSorting . ' LIMIT 3 OFFSET ' . $offset;
		$res = $db->query($sql);
		
		$tr=array();
		while($row=mysqli_fetch_assoc($res))		{ 
		  $tr[]=$row;
		}
		
		return $tr;	
	}
	
	function getTaskCount(){
		$db = connetDb();	
		$sql='SELECT count(*) FROM `task`';
		$res = $db->getOne($sql);

		return $res;	
	}
	
	function issetIdTask($id){
		$db = connetDb();
		$sql='SELECT count(*) FROM `task` WHERE `id`=?i';
		$res = $db->getOne($sql, $id);

		return $res;		
	}
	
	function createTask($data){
		$db = connetDb();
		$sql='INSERT INTO `task` SET ?u'; 
		$res = $db->query($sql, $data);

		return $res;
	}
	
	function updateTask($id, $data){
		$db = connetDb();
		$sql='UPDATE `task` SET ?u WHERE id=?i';
		$res = $db->query($sql, $data, $id);

		return $res;
	}
	
	function connetDb(){
		$db = new SafeMySQL();
		$sqlUse = 'USE ?n';
		$res = $db->query($sqlUse, dbdata);
		return $db;
	}
	
	

?>