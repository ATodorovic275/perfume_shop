$(document).ready(function() {
	
	// drop lista
	$("#lista").change(function() {
		// console.log($(this).val())
		var idBrenda = $(this).val()

		$.ajax({
			url: "proizvodi.php",
			method: "post",
			dataType: "json",
			data: {
				poslato: "jeste",
				idBrenda: idBrenda
			},

			success: function (data) {
				console.log(data)

				// var ispis = "";
				// data.forEach( function(element) {
				// 	console.log(data)
				// ispis +=`
				// 	<div class="col-md-4 col-0-gutter">
    //                      <div class="ot-portfolio-item">
    //                           <figure class="effect-bubba">
    //                                <img src="${element.slika}" alt="img" class="img-responsive">
    //                                <figcaption>
    //                                		<h2>${element.naziv}</h2>
    //                                		<p>${element.opis}</p>
    //                                		<a href="#" data-toggle="modal" data-target="#Modal-${element.id}">Viwe more</a>                                     
    //                                </figcaption>
    //                           </figure>
    //                      </div>
    //                 </div>`
				// });
				
				
				// $(".row-0-gutter").html(ispis)




				// DODAJ MODAL
			},
			error: function (xhr, statusText ,err) {
				// console.log(x,y,z);
				if(xhr.status == 500){
					alert("Greska na serveru");
				}
			}
		})
		window.location.href = "http://localhost/MojSajt%20-%20SLIKA%202%20-%20pagincijaSredjivanje/proizvodi.php"
		

	});
});