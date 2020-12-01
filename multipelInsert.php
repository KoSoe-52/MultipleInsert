<?php
	#####################################################
	######## DB TABLE's columns ARE id,name,email #########
	#####################################################
	/*
	CREATE TABLE `test` (
	  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  `name` varchar(40) DEFAULT NULL,
	  `email` varchar(40) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	*/
	$hostname="localhost";
	$dbname="";
	$user="root";
	$pass="";
	try{
		$conn=new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8",$user,$pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Error::". $e->getMessage();
	}
	//request multiple array
	$multiple = array(
		array('name'=>'kosoe1','email'=>'kosoe1@gmail.com'),
		array('name'=>'kosoe2','email'=>'kosoe2@gmail.com'),
		array('name'=>'kosoe3','email'=>'kosoe3@gmail.com')
	);
	$insert_values = array();
	foreach($multiple as $singleArray){
		  $question_marks[] = '('  . placeholders('?', sizeof($singleArray)) . ')';
		  $insert_values = array_merge($insert_values, array_values($singleArray));
	}
	$sql = "INSERT INTO test(name,email) VALUES " . implode(',', $question_marks);
	$query = $conn->prepare($sql);
	$query->execute($insert_values);
	
	//to detect question_marks
	function placeholders($text, $count=0, $separator=","){
		$result = array();
		if($count > 0){
			for($x=0; $x<$count; $x++){
				$result[] = $text;
			}
		}
		return implode($separator, $result);
	}
?>