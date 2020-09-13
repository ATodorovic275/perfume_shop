<?php 
	
	include "konekcija.php";

	$x = $_POST['idBrenda'];
	// echo $x;
	
	$upit = 'select * from proizvodi2 where id_brend = '.$x;

	// ukoliko je Izaberite
	
	if($x === "0"){
		$upit = "select * from proizvodi2";
	}

	try{
		$rezultat = $konekcija->query($upit);
		$rez = $rezultat->fetchAll();
		if($rez){
			$status = 201;
			$proizvodi = $rez;
		}
		else{
			$proizvodi = "Nema ga u bazi";
			$status = 500;
		}

	}
	catch(PDOException $ex){
		$proizvodi = "Doslo je do greske u bazi";
	}

	echo json_encode($proizvodi);
	http_response_code($status);
 ?>