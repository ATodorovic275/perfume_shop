<?php 
	
	include "konekcija.php";

	if(isset($_POST['id'])){

		// 1 svi korisnici
		if($_POST["id"] == "1"){
			$upit = "select * from korisnici";
			$rezultat = $konekcija->query($upit);
			$rez = $rezultat->fetchAll();
			// var_dump($rez);
			// echo $_GET["id"];
			
			$status = 200;

			http_response_code($status);
		    header('Content-Type: application/json');
		    echo json_encode($rez);
		}

		//2 dodavanje korisnika
		else if($_POST['id'] == '2'){
			$ime = $_POST['ime'];
			$prezime = $_POST['prezime'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$uloga = $_POST['uloga'];

			// echo "$ime, $prezime";
			// validacija podataka

			$greske = [];

			$imeRi = "/^[A-Z][a-z]{2,25}$/";
	          $emailRi = "/^(([a-z\d]+\.{1}){2}\d{1,3}\.\d{2}@ict.edu.rs)|(([a-z\d]+\.*)+@(gmail|hotmail|yahoo)\.com)$/";
	          $passRi = "/^[\w\d\S]{8,25}$/";

	          if(!preg_match($imeRi, $ime)){
	               $greske[] = "Ime nije ok";
	          }
	          if(!preg_match($imeRi, $prezime)){
	               $greske[] = "Prezime nije ok";
	          }
	          if(!preg_match($emailRi, $email)){
	               $greske[] = "Email nije ok";
	          }
	          if($uloga == 0){
	          	$greske[] = "Izaberite ulogu";
	          }


	          if(count($greske) > 0){
	          		echo "Podaci nisu validni";  	 		
	          }
	          else{

			 $upit = "insert into korisnici values(null, :ime, :prezime, :email, :password, :uloga)";
			 $priprema = $konekcija->prepare($upit);
			 $priprema->bindParam(":ime", $ime);
			 $priprema->bindParam(":prezime", $prezime);
			 $priprema->bindParam(":email", $email);
			 $priprema->bindParam(":password", $password);
			 $priprema->bindParam(":uloga", $uloga);
			 $rezultat = $priprema->execute();
			 $message = "Uspesno dodat korisnik";
			 if($rezultat){
			 	http_response_code(200);
			    header('Content-Type: application/json');
			    echo json_encode(['message' => $message]);
			 }
			}
			 // var_dump($rezultat);			
		}

		// svi proizvodi
		else if($_POST['id'] == "3"){
			$upit = "select * from proizvodi";
			$rezultat = $konekcija->query($upit);
			$rez = $rezultat->fetchAll();
			// var_dump($rez);
			
			$status = 200;
			http_response_code($status);
		    header('Content-Type: application/json');
		    echo json_encode($rez);
		}
	}

	else if(isset($_POST["idUpdate"])){
		$id = $_POST['idUpdate'];

		$upit = "select * from proizvodi where id = :id";
		$priprema = $konekcija->prepare($upit);
		$priprema->bindParam(":id", $id);
		$rezultat = $priprema->execute();
		$rez = $priprema->fetch();

		$status = 200;
		http_response_code($status);
	    header('Content-Type: application/json');
   	 	echo json_encode($rez);
	}

	
	else{
		echo "Nema ovde nista";
		header("Location: index.php");
	}


 ?>