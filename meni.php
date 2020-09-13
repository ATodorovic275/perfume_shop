<?php
	include "konekcija.php";

	$upit = "select * from meni ORDER BY redosled";
	$rezultat = $konekcija->query($upit);
	if($rezultat){
		$rez = $rezultat->fetchAll();
		// var_dump($rez);
		$ispis = "";
		$ispis.="<ul class='nav navbar-nav navbar-nav-first'>";
		foreach ($rez as $red) {
			if($red->tekst == "Prijava"){
				break;
			}
			$ispis.="<li><a href='".$red->link."'class='smoothScroll'>".$red->tekst."</a></li>";
		}
		if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->id_uloga == "1"){
			$ispis.="<li><a href='"."admin.php"."'class='smoothScroll'>"."Admin"."</a></li>";
		}
		$ispis.="</ul>";
		$ispis.="<ul class='nav navbar-nav navbar-right'>";	
		foreach ($rez as $red) {
			if($red->tekst == "Prijava"){
				if(isset($_SESSION['korisnik'])){
					continue;
				}
				else{
					$ispis.="<li><a href='".$red->link."'>".$red->tekst."</a></li>";
				}
			}

			else if ($red->tekst == "Odjavite se") {
				if(!isset($_SESSION['korisnik'])){
					continue;
				}
				else{
					$ispis.="<li><a href='".$red->link."'>".$red->tekst."</a></li>";
				}
			}

			if($red->link == "korpa.php"){
				$ispis.="<a href='".$red->link."'class='korpa'>"."<i class='fa fa-shopping-bag' aria-hidden='true'></i></a>";
			}
		}
		$ispis.="</ul>";
		echo $ispis;

	}
	else{
		echo "Nema konekcije";
	}


 ?>