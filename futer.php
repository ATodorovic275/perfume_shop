<<footer id="footer" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-8">
                         <div class="footer-info footer-open-hour">
                              <div class="section-title">
                                   <h2 class="wow fadeInUp" data-wow-delay="0.2s">Open Hours</h2>
                              </div>
                              <div class="wow fadeInUp" data-wow-delay="0.4s">
                                   <p>Ponedeljak: Zatvoreno</p>
                                   <div>
                                        <strong>Od Utorka do Petka</strong>
                                        <p>7:00 - 21:00</p>
                                   </div>
                                   <div>
                                        <strong>Subota - Nedelja</strong>
                                        <p>11:00 - 22:00</p>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-lg-3 col-md-2 col-sm-2">
                         <ul class="wow fadeInUp social-icon" data-wow-delay="0.4s">
                              <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                              <li><a href="#" class="fa fa-twitter"></a></li>
                              <li><a href="#" class="fa fa-instagram"></a></li>
                              <li><a href="#" class="fa fa-google"></a></li>
                         </ul>

                         <div class="wow fadeInUp copyright-text" data-wow-delay="0.8s"> 
                              <p><br>Copyright &copy; 2018 <br>Your Company Name 
                              
                              <br><br>Design: <a rel="nofollow" href="http://templatemo.com" target="_parent">TemplateMo</a></p>
                         </div>
                    </div>

                    <div class="col-lg-3 col-md-2 col-sm-2 futer">
                    	<?php 
                    		include "konekcija.php";

                    		 $upit = "select * from meni ORDER BY redosled";

	                         $rezultat = $konekcija->query($upit);
	                         if($rezultat){
	                              $rez = $rezultat->fetchAll();
	                              // var_dump($rez);
	                              $ispis = "<ul>";

	                              foreach ($rez as $red) {
	                              	if($red->link == "korpa.php")
	                              		$ispis .= "<li><a href='".$red->link."'>".'Korpa'."</a></li>";
	                              	else
	                              		$ispis .= "<li><a href='".$red->link."'>".$red->tekst."</a></li>";

	                              }
	                              $ispis .= "</ul>";
	                              echo $ispis;
	                         }    
	                         else{
	                              echo "Greska u bazi";
	                         }

                    	 ?>

                    </div>    
               </div>
          </div>
     </footer>