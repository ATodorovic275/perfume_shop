<?php 
     session_start();
	
 ?>

 <!DOCTYPE html>
<html lang="en">
<html lang="sr">
<head>

     <title>Korisnik</title>
     <link rel="shortcut icon" href="images/favicon.ico"/>
<!-- 

Eatery Cafe Template 

http://www.templatemo.com/tm-515-eatery

-->
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="Najsiriji asortiman origrinalnih parfema">
     <meta name="keywords" content="parfimerija, miris, beograd, lana">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="stylesheet" href="css/magnific-popup.css">
     <link rel="stylesheet" href="css/mojstyle.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/templatemo-style.css">

</head>
<body>

     <!-- MENU -->
     <?php 
          include "meni2.php";
      ?>



      <?php 

        if(isset($_POST['izmeni'])){
          include "konekcija.php";

          $id = $_SESSION['korisnik']->id_korisnik;
          $ime = $_POST['ime'];
          $prezime = $_POST['prezime'];
          $email = $_POST['email'];
          $pass = md5($_POST['sifra']);


          $upit = 'update korisnici set ime = :ime, prezime = :prezime, email = :email, password = :pass where id_korisnik = :id';
          $priprema = $konekcija->prepare($upit);
          $priprema->bindParam(":ime", $ime);
          $priprema->bindParam(":prezime", $prezime);
          $priprema->bindParam(":email", $email);
          $priprema->bindParam(":pass", $pass);
          $priprema->bindParam(":id", $id);

          $rezultat = $priprema->execute();
          if($rezultat){
            echo "<script>alert('Uspesno ste izmenili podatke')</script>";
          }
          else{
            echo "<script>alert('Doslo je do greske')</script>";
          }

          unset($_POST['izmeni']);
        }

       ?>











     <section id="" data-stellar-background-ratio="0.5">
           <div class="container">
               <div class="row">
                 <div class="col-md-6 col-sm-12 padding">
                  <?php 
                      include "konekcija.php";

                      // var_dump($_SESSION['korisnik']);

                      $korisnik = $_SESSION['korisnik'];
                      // echo $korisnik->id_korisnik;
                      ?>

                      <form action="<?= $_SERVER['PHP_SELF']?>" onSubmit="return proveraPodataka()" method="post" class="wow fadeInUp" id="contact-form" role="form" data-wow-delay="0.8s">                  
                           
                            <div class="col-md-12 col-sm-12">
                              <?php 
                                echo "<input type='text' value='".$korisnik->ime."'class='form-control' id='cf-fname' name='ime' placeholder='Ime'>"
                               ?>
                                 <!-- <input type="text" class="form-control" id="cf-fname" name="fname" placeholder="Ime"> -->
                            </div>

                            <div class="col-md-12 col-sm-12">
                                 <?php 
                                echo "<input type='text' value='".$korisnik->prezime."'class='form-control' id='cf-lname' name='prezime' placeholder='Ime'>"
                               ?>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                 <?php 
                                echo "<input type='text' value='".$korisnik->email."'class='form-control' id='cf-lname' name='email' placeholder='Ime'>"
                               ?>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                 <input type="text" class="form-control" id="cf-sifra" name="sifra" placeholder="Nova sifra">
                            </div>              
                      
                            <div class="col-md-12 col-sm-12">                                  
                                 <input type="submit" name="izmeni" class="form-control prijava izmena" id="cf-submit" value="Izmeni">
                            </div>
                       </form>  
                     </div>                 
               </div>
          </div>
     </section>          


     <!-- FOOTER -->
     <?php 
          include "futer.php";
      ?>

     <script src="js/jquery.js"></script>
     <script type="text/javascript" src="js/jquery-migrate-1.4.1.min.js"></script>
     <!-- <script src="js/bootstrap.min.js"></script> -->
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>
     <!-- <script src="js/main.js"></script>
     <script src="js/index.js"></script> -->
     <script type="text/javascript" src="js/jquery.js"></script>


   </body>

   </html>