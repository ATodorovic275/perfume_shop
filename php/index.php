<?php 
     session_start();

     // require 'PHPMailer/src/PHPMailer.php';
     // require 'PHPMailer/src/SMTP.php';
     // require 'PHPMailer/src/Exception.php';

     // use PHPMailer\PHPMailer\PHPMailer;
     // use PHPMailer\PHPMailer\Exception;


     if(isset($_SESSION['greske'])){
          $greska = $_SESSION['greske'];
          echo "<script>alert('$greska')</script>";

          unset($_SESSION['greske']);
     }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Eatery Cafe and Restaurant Template</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="stylesheet" href="css/magnific-popup.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/templatemo-style.css">

</head>
<body>

     <!-- PRE LOADER -->
    <!--  <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section> -->


     <!-- MENU -->
     <?php 

          include "php/meni2.php";
      ?>


     <!-- HOME -->
     <section id="home" class="slider" data-stellar-background-ratio="0.5">
          <div class="row">

                    <div class="owl-carousel owl-theme">
                         <div class="item item-first">
                   
                         </div>

                         <div class="item item-second">
                              
                         </div>

                         <div class="item item-third">
                              
                         </div>
                    </div>

          </div>
     </section>     


     <!-- TEAM -->
     <section id="team" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Najpopularniji parfemi</h2>
                         </div>
                    </div>

                    <?php 
                         include "konekcija.php";

                         $aktivan = '1';
                         $upit = 'select * from proizvodi where aktivan = :aktivan limit 3';
                         $priprema = $konekcija->prepare($upit);
                         $priprema->bindParam(":aktivan", $aktivan);
                         $rezultat = $priprema->execute();
                         $rez = $priprema->fetchAll();

                         foreach ($rez as $red) :
                     ?>

                    <div class="col-md-4 col-sm-4">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                              <?php 
                                   echo "<img src='".$red->slika."' alt='img' class='img-responsive'/>";
                               ?>
                              <!-- <img src="images/item1.jpg" class="img-responsive" alt=""> -->
                                   <div class="team-hover">
                                        <div class="team-item">
                                             <h4>
                                                  <?php 
                                                       echo $red->opis;
                                                   ?>
                                             </h4> 
                                        </div>
                                   </div>
                         </div>
                         <div class="team-info">
                              <h3><?php 
                                   echo $red->naziv;
                               ?></h3>
                              <p><?php 
                                   echo $red->cena;
                               ?></p>
                         </div>
                    </div> 
                    <?php 
                         endforeach;
                     ?>                                     
               </div>
          </div>
     </section>


     


     <!-- TESTIMONIAL -->
     <section id="testimonial" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">                           
                              <a id="anketa" href="anketa.php">Pogledajte anketu</a>
                         </div>
                    </div>  
          </div>
     </section>  


     <!-- CONTACT -->
     <section id="contact" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">
	<!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
	-->
                    <div class="wow fadeInUp col-md-6 col-sm-12" data-wow-delay="0.4s">
                         <div id="google-map">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3647.3030413476204!2d100.5641230193719!3d13.757206847615207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf51ce6427b7918fc!2sG+Tower!5e0!3m2!1sen!2sth!4v1510722015945" allowfullscreen></iframe>
                         </div>
                    </div>    

                    <?php 

                         if(isset($_POST["submit"])){
                              $greske2 = [];

                              $ime = $_POST["name"];
                              $email = $_POST["email"];
                              $poruka = $_POST["message"];

                              // reg

                              $imeRi = "/^[A-Z][a-z]{2,25}$/";
                              $emailRi = "/^(([a-z\d]+\.{1}){2}\d{1,3}\.\d{2}@ict.edu.rs)|(([a-z\d]+\.*)+@(gmail|hotmail|yahoo)\.com)$/";

                              if(!preg_match($imeRi, $ime)){
                                   $greske2[] = "Ime nije ok";
                              }
                              if(!preg_match($emailRi, $email)){
                                   $greske2[] = "Email nije ok";
                              }
                              if($poruka == ""){
                                   $greske2[] = "Morate uneti poruku";
                              }

               
                              // if(count($greske2) == 0){

                              //     // slanje poruke      

                              //      $mail = new PHPMailer(true);                  

                              //      try {
                              //         $mail->SMTPDebug = 0; // NA 0 INACE NECE RADITI!!
                                      
                              //         $mail->isSMTP();         
                              //         $mail->Host = 'smtp.gmail.com';  // Za GMAIL

                              //         $mail->SMTPAuth = true;         
                              //         $mail->Username = 'acaglavni123@gmail.com'; 
                              //         $mail->Password = 'phpAdmin123';   
                              //         $mail->SMTPSecure = 'tls';                    
                              //         $mail->Port = 587;  
                                      
                              //         $mail->setFrom("aleksamitic1@gmail.com");
                              //         $mail->addAddress('acaglavni123@gmail.com');

                              //         $mail->isHTML(true); // da bi mogao HTML kod da se salje u okviru BODY

                              //         $mail->Subject = "Neki naslov";
                              //         // $mail->Body = $body; // iz forme

                              //         $mail->Body = "Poruka"; 

                              //         $mail->send();

                                      
                              //      }
                              //      catch(Exception $e){
                              //         echo $e->getMessage();
                              //      }


                              // }


                         }


                     ?>




                    <div class="col-md-6 col-sm-12">

                         <div class="col-md-12 col-sm-12">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                                   <h2>Kontakt</h2>
                              </div>
                         </div>

                         <!-- CONTACT FORM -->
                         <form action="<?= $_SERVER['PHP_SELF']?>" onSubmit="return provera()" method="post" class="wow fadeInUp" id="contact-form" role="form" data-wow-delay="0.8s">

                              <!-- IF MAIL SENT SUCCESSFUL  // connect this with custom JS -->
                              <h6 class="text-success">Your message has been sent successfully.</h6>
                              
                              <!-- IF MAIL NOT SENT -->
                              <?php 
                                    // echo count($greske);
                                        // if(count($greske2) > 0){
                                        //      echo "<h6>Podaci nisu validni</h6>";
                                        //      unset($greske);
                                        // }


                               ?>
                              <h6 class="text-danger">Podaci nisu validni</h6>

                              <div class="col-md-6 col-sm-6">
                                   <input type="text" class="form-control" id="cf-name" name="name" placeholder="Vase ime">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <input type="email" class="form-control" id="cf-email" name="email" placeholder="Email adresa">
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" id="cf-subject" name="subject" placeholder="Naslov">

                                   <textarea class="form-control" rows="6" id="cf-message" name="message" placeholder="Vasa poruka"></textarea>

                                   <button type="submit" class="form-control" id="cf-submit" name="submit">Posalji poruku</button>
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
     <script type="text/javascript" src="js/jquery-migrate-1.4.1.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>
     <script src="js/main.js"></script>
     <script src="js/index.js"></script>
     <script src="js/kontakt.js"></script>


</body>
</html>