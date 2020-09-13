<?php 

	include "konekcija.php";

	if(isset($_POST['brend'])){
		$upit = "select * from brendovi";
		$rezultat = $konekcija->query($upit);
		$rez = $rezultat->fetchAll();

		http_response_code(200);
	    header('Content-Type: application/json');
   	 	echo json_encode($rez);
   	 	unset($_POST['brend']);
	}

 ?>