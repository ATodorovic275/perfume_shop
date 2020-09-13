<?php 
	include "konekcija.php";
		if(isset($_GET['idSviProiz'])){
			// echo $_GET['idSviProiz'];
			$upit = "select * from proizvodi limit 3";
			$rezultat = $konekcija->query($upit);
			$rez = $rezultat->fetchAll();
			// var_dump($rez);
			
			$status = 200;
			http_response_code($status);
		    header('Content-Type: application/json');
		    echo json_encode($rez);
		}
		else{
			echo "Nema";
		}

			// $upit = "select * from proizvodi";
			// $rezultat = $konekcija->query($upit);
			// $rez = $rezultat->fetchAll();
			// var_dump($rez);
			
			// $status = 200;
			// http_response_code($status);
		 //    header('Content-Type: application/json');
		 //    echo json_encode($rez);
		


 ?>