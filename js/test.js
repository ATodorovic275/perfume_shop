$(document).ready(function() {
	
	$.ajax({

		url: "data/test.json",
		method: "post",
		dataType: "json",
		success: function (data) {
			console.log(data); 
			var ispis = "";
			data.forEach( function(element) {
				ispis += `
				<div class="col-md-4 col-sm-4">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.6s">
                              <img src="${element.slika}" class="img-responsive" alt="">
                                   <div class="team-hover">
                                        <div class="team-item">
                                             <h4>Note</h4>
                                            <!--  <ul class="social-icon">
                                                  <li><a href="#" class="fa fa-github"></a></li>
                                                  <li><a href="#" class="fa fa-google"></a></li>
                                             </ul> -->
                                        </div>
                                   </div>
                         </div>
                         <div class="team-info">
                              <h3>Naziv parfema</h3>
                              <p>Cena</p>
                         </div>
                    </div>
			`
			});
			

			$("#team .container .row").html(ispis);
		},
		error: function (err){
			console.log(err);
		}
	})

});