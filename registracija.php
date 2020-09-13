<?php 

     require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

 ?>
<!DOCTYPE html>
<html lang="sr">
<head>

     <title>Registracija</title>
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

     <!-- PRE LOADER -->
     <!-- <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section> -->


     <!-- MENU -->
     <?php 

          include "meni2.php";
      ?>


     


     <!-- CONTACT -->
     <section id="contact" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">
                   
                    <div class="col-md-6 col-sm-12 padding">

                         <div class="col-md-12 col-sm-12">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                                   <h2>Registracija</h2>
                              </div>
                         </div>


                              <?php 
                         

                         if(isset($_POST["dugmes"])){
                              $greske2 = [];

                              $ime = $_POST["fname"];
                              $prezime = $_POST["lname"];
                              $email = $_POST["email"];
                              $repEmail = $_POST["repEmail"];
                              $pass = md5($_POST["pass"]);

                              // reg

                              $imeRi = "/^[A-Z][a-z]{2,25}$/";
                              $emailRi = "/^(([a-z\d]+\.{1}){2}\d{1,3}\.\d{2}@ict.edu.rs)|(([a-z\d]+\.*)+@(gmail|hotmail|yahoo)\.com)$/";
                              $passRi = "/^[\w\d\S]{8,25}$/";

                              if(!preg_match($imeRi, $ime)){
                                   $greske2[] = "Ime nije ok";
                              }
                              if(!preg_match($imeRi, $prezime)){
                                   $greske2[] = "Prezime nije ok";
                              }
                              if(!preg_match($emailRi, $email)){
                                   $greske2[] = "Email nije ok";
                              }
                              if($repEmail != $email){
                                   $greske2[] = "Email nije isti";
                              }
                              // if(!preg_match($passRi, $pass)){
                              //      $greske2[] = "Sifra nije ok";
                              // }

                              if(count($greske2) > 0){
                                   $poruka = "Podaci nisu validni";
                              }
                              else{
                                   // $poruka = "Uspesno ste se registrovali";
                                   include "konekcija.php";
                                   
                                   $upit_1 = "SELECT * FROM korisnici WHERE email = :email";
               
                                   $rezultat_1 = $konekcija->prepare($upit_1);
                                   $rezultat_1->bindParam(':email', $email);

                                   $rezultat_1->execute();

                                   $korisnici = $rezultat_1->fetch();

                                   if($korisnici != null){
                                        echo "<script>alert('Vec postoji korisnik')</script>";
                                   }
                                   else{
                              // upis u bazu
                              

                              $upit = "insert into korisnici(ime, prezime, email, password) values(:ime, :prezime, :email, :pass)";
                              $priprema = $konekcija->prepare($upit);
                              $priprema->bindParam(":ime", $ime);
                              $priprema->bindParam(":prezime", $prezime);
                              $priprema->bindParam(":email", $email);
                              $priprema->bindParam(":pass", $pass);
                              $rezultat = $priprema->execute();
                              // var_dump($rezultat);
                              if($rezultat){
                                   echo "<script>alert('Uspesno ste se registrovali, proverite mail za potvrdu')</script>";

                                   // kod phpmailer


                                   $mail = new PHPMailer(true);                  

                                       try {
                                           $mail->SMTPDebug = 0; // NA 0 INACE NECE RADITI!!
                                           
                                           $mail->isSMTP();         
                                           $mail->Host = 'smtp.gmail.com';  // Za GMAIL

                                           $mail->SMTPAuth = true;         
                                           $mail->Username = 'acaglavni123@gmail.com'; 
                                           $mail->Password = 'phpAdmin123';   
                                           $mail->SMTPSecure = 'tls';                    
                                           $mail->Port = 587;  
                                           
                                           $mail->setFrom("acaglavni123@gmail.com", "Admin");
                                           $mail->addAddress($email, $ime);

                                           $mail->isHTML(true); // da bi mogao HTML kod da se salje u okviru BODY

                                           $mail->Subject= "Registracija parfimerija Lana";
                                           // $mail->Body = $body; // iz forme

                                           $mail->Body = "Postovani/a <br/> <a href='obrada?random=123'>Aktivirajte vas nalog</a>"; 

                                           $mail->send();

                                           
                                       }
                                       catch(Exception $e){
                                           echo $e->getMessage();
                                       }


                              }
                              else{
                                   echo "<script>alert('Greska pri unosu u bazi')</script>";
                              }

                         }
                    }
               }

                     ?>


                         <!-- CONTACT FORM -->
                         <form action="<?= $_SERVER['PHP_SELF']?>" onSubmit="return proveraPodataka()" method="post" class="wow fadeInUp" id="contact-form" role="form" data-wow-delay="0.8s">

                              <!-- IF MAIL SENT SUCCESSFUL  // connect this with custom JS -->
                              <!-- <h6 class="text-success">Your message has been sent successfully.</h6> -->
                              
                              <!-- IF MAIL NOT SENT -->
                              <!-- <h6 class="text-danger">E-mail must be valid and message must be longer than 1 character.</h6> -->
                             
                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" id="cf-fname" name="fname" placeholder="Ime">
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" id="cf-lname" name="lname" placeholder="Prezime">
                              </div>
                              <!-- <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" id="cf-userName" name="userName" placeholder="Korisnicko ime">
                              </div> -->

                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" id="cf-email" name="email" placeholder="Email adresa">
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" id="cf-repEmail" name="repEmail" placeholder="Ponovite email">
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" id="pass" name="pass" placeholder="Sifra">
                              </div>

                              

                              <div class="col-md-12 col-sm-12">
                                   
                                  <!--  <button type="submit" class="form-control" id="cf-submit" name="submit">Posalji</button> -->
                                   <input type="submit" name="dugmes" class="form-control prijava" id="cf-submit" value="Posalji">
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


     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>
     <script type="text/javascript" src="js/registracija.js"></script>
</body>
</html>