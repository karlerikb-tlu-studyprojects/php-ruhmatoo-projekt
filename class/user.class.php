<?php
class User {
	
		private $connection;
		
		function __construct($mysqli){
			
			$this->connection=$mysqli;
			
		}

		
		
		
	function signUp ($email, $password, $fistname, $lastname, $gender, $username, $DoB) {
		
		$stmt = $this->connection->prepare("INSERT INTO sm_users(firstname, lastname, dateofbirth, gender, username, email, password, userlevel) VALUES(?, ?, ?, ?, ?, ?, ?, 1)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("sssssss", $fistname, $lastname, $DoB, $gender, $username, $email, $password);
		
		if($stmt->execute()) {
			
			echo "salvestamine onnestus";
			
		} else {
			
			echo "ERROR".$stmt->error;
		}
		
		$stmt->close();
		$this->connection->close();
		
	}

	function login($username, $password) {
		
		$error="";
		
		$stmt = $this->connection->prepare("SELECT id, username, password, created, userlevel FROM sm_users WHERE username=?");
	
		echo $this->connection->error;
		
		
		//asendan kysimargi
		$stmt->bind_param("s", $username);
		
		//maaran vaartused muutujatesse
		$stmt->bind_result($id, $usernameFromDb,$passwordFromDb, $created, $userlevel);
		
		$stmt->execute();
		
		//kas andmed tulid v mitte
		if($stmt->fetch()){
			
			//oli selline meil
			$hash=hash("sha512", $password);
			if($hash==$passwordFromDb){
				
				echo"Kasutaja logis sisse ".$id;
				
				$_SESSION["userId"]=$id;
				$_SESSION["username"]=$usernameFromDb;
				$_SESSION["userlevel"]=$userlevel;
				
				header("Location: sneakermarket.php");
				exit();
				
			}else {
				$error="Vale parool";
			}
			
			
		}else{
			
			//ei olnud seda meili
			$error="Ei ole sellist emaili";
			
		}
		
		return $error;
	
	}
	
}
?>