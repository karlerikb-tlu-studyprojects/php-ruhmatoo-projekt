<?php

	require("../../../../config.php");
	require("../functions.php");
	
	
	//kui on see siis suunan data lehele
	if(isset($_SESSION["userId"])){
		
		header("Location: sneakermarket.php");
		exit();
		
	}

	$signinEmailError= "";
	$signinPasswordError= "";
	$signinemail= "";
	
	$signupEmailError= "";
	$signupPasswordError= "";
	$reenterpasswordError= "";
	
	$signupemail = "";
	$signupGender = "";
	$signupGenderError = "";
	$signupAge = "";
	$signupAgeError= "";
	$signupCountry = "";
	$signupCity = "";
	$signupShoesize = "";
	
	if(isset($_POST["signupemail"])){
		
		if(empty($_POST["signupemail"])){
			
			$signupEmailError= "See vali on kohustuslik";
			
		}else{
			
			$signupemail = $_POST["signupemail"];
			
		}
		
		if(isset($_POST["signupGender"])) {
			
			$signupGender = $_POST["signupGender"];
			
		} else {
			
			$signupGenderError= "See vali on kohustuslik";
			
		}
		
		if(empty($_POST["signupAge"])) {
			
			$signupAgeError= "See vali on kohustuslik";
			
		} else {
			
			$signupAge = $_POST["signupAge"];
			
		}
		
		if(empty($_POST["signupCountry"])) {
			
			$signupCountry = "-";
			
		} else {
			
			$signupCountry= $_POST["signupCountry"];
			
		}
		
		if(empty($_POST["signupCity"])) {
			
			$signupCity = "-";
			
		} else {
			
			$signupCity= $_POST["signupCity"];
			
		}
		
		if(empty($_POST["signupShoesize"])) {
			
			$signupShoesize = "-";
			
		} else {
			
			$signupShoesize= $_POST["signupShoesize"];
			
		}
	}
	
	if(isset($_POST["signuppassword"])){
		
		if(empty($_POST["signuppassword"])){
			
			$signupPasswordError= "See vali on kohustuslik";
			
		} else {
			
			if( strlen($_POST["signuppassword"]) <8 ){
			
				$signupPasswordError = "Parool peab olema vahemalt 8 tahemarki pikk";
				
			}
		}
	}
	
	if(isset($_POST["reenterpassword"])){
		
		if($_POST["reenterpassword"] == $_POST["signuppassword"]){
			
			$reenterpasswordError= "";
			
		} else {
			
			$reenterpasswordError= "Parool ei olnud sama";
			
		}
	}
	
	//if(isset($_POST["signupGender"])){
		
		//if(!empty($_POST["signupGender"])){
			
			//$signupGender = $_POST["signupGender"];
			
		//}
		
	//}
	
	
	if(isset($_POST["signupemail"]) &&
		isset($_POST["signuppassword"]) &&
		isset($_POST["signupGender"]) &&
		isset($_POST["signupAge"]) &&
		$signupEmailError=="" &&
		$signupPasswordError=="" &&
		$signupGenderError=="" &&
		$signupAgeError== ""
		) {
		
		//echo "Salvestan... <br>";
		
		//echo "email: ".$signupemail."<br>";
		//echo "password: ".$_POST["signuppassword"]."<br>";
		//echo "gender: ".$signupGender."<br>";
		//echo "age: ".$signupAge."<br>";
		//echo "country: ".$signupCountry."<br>";
		//echo "city: ".$signupCity."<br>";
		//echo "shoesize: ".$signupShoesize."<br>";
		
		$password = hash("sha512", $_POST["signuppassword"]);
		
		//echo "password hashed: ".$password."<br>";
		
		//echo $serverUsername;
		
		$User->signUp($Helper->cleanInput($signupemail), $Helper->cleanInput($password), $Helper->cleanInput($signupGender), $Helper->cleanInput($signupAge), $Helper->cleanInput($signupCountry), $Helper->cleanInput($signupCity), $Helper->cleanInput($signupShoesize));
		
	}


?>

<?php require("../header.php"); ?>

<div class="container">
	
	<div class="row">
	
		<div class="col-sm-2 col-sm-offset-4">

			<h1>Loo Kasutaja</h1>
			Tärniga väljad on kohustuslikud
			<form method="POST">
			
				<br>
				<b><label>*E-mail:</label></b><br>
				<input name="signupemail" placeholder="example@mail.com" type="text" value="<?=$signupemail;?>"> <text style="color:red;"><?php echo $signupEmailError; ?></text>
				<br><br>
			
				<b><label>*Parool:</label></b><br>
				<input name="signuppassword" placeholder="********" type="password"> <text style="color:red;"><?php echo $signupPasswordError; ?></text>
				<br><br>
				
				<b><label>*Sisesta parool uuesti:</label></b><br>
				<input name="reenterpassword" placeholder="********" type="password"> <text style="color:red;"><?php echo $reenterpasswordError; ?></text>
				<br><br>
				
				<b><label>*Sugu:</label></b> <text style="color:red;"><?php echo $signupGenderError; ?></text><br><br>
				<?php if($signupGender == "male") { ?>
					<input name="signupGender" type="radio" value="male" checked> Male<br>
				<?php }else { ?>
					<input name="signupGender" type="radio" value="male"> Male<br>
				<?php } ?>
				
				<?php if($signupGender == "female") { ?>
					<input name="signupGender" type="radio" value="female" checked> Female<br>
				<?php }else { ?>
					<input name="signupGender" type="radio" value="female"> Female<br>
				<?php } ?>
				
				<?php if($signupGender == "other") { ?>
					<input name="signupGender" type="radio" value="other" checked> Other<br>
				<?php }else { ?>
					<input name="signupGender" type="radio" value="other"> Other<br>
				<?php } ?>
				
				<br>
				
				<b><label>*Vanus:</label></b> <text style="color:red;"><?php echo $signupAgeError; ?></text><br>
				<input name="signupAge" type="integer">
				<br><br>
				
				<b><label>Riik:</label></b><br>
				<input name="signupCountry" type="text">
				<br><br>
				
				<b><label>Linn:</label></b><br>
				<input name="signupCity" type="text">
				<br><br>
				
				<b><label>Jalanumber (EUR):</label></b><br>
				<input name="signupShoesize" type="float">
				<br><br>
				
				<input name="spam" type="checkbox"> Soovin saada teateid oma meilile
				<br><br>
				
				<input type="submit" value="Loo Kasutaja">
				
				
				<br><br><br><br>
				
			</form>
		</div>
	</div>
</div>
<?php require("../footer.php"); ?>