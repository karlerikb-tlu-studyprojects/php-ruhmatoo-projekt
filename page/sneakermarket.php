<?php

	require("../functions.php");

	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}


// georg




























// karl-erik

$allPosts = $Sneakers->getAllPosts();











?>

<?php require("../header.php"); ?>


<!-- 
****** kuvatakse kõikide kasutajate postitused ****** 

andmed tulevad $allPosts muutujast

-->

<div class="container">
<?php


	$html = "<div class='row'>";
		
	foreach($allPosts as $p) {
		$html .= "<div class='col-md-3'>";
			$html .= "<div class='thumbnail'>";
				$html .= "<img src='../uploads/".$p->name."'>";
				$html .= "<div class='caption'>";
					$html .= "<h3>".$p->heading."</h3>";
					$html .= "<p>".$p->description."</p>";
					$html .= "<p><a href='#' class='btn btn-primary' role='button'>Vaata</a></p>";
				$html .= "</div>";
			$html .= "</div>";
		$html .= "</div>";
	}
	
	$html .= "</div>";
	
	echo $html;



?>
</div>









































<?php require("../footer.php"); ?>