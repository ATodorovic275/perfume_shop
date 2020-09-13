$(document).ready(function() {
	
	$(".glasaj").click(slanje)
	$("#rez").click(rezultat)
});


function slanje (argument) {
	var id = $(this).data("id") // id ankete
	console.log(id)

	// koji odgovor je cekiran

	let radio = document.getElementsByName("odg")
	console.log(radio)
	for (el of radio) {
		if(el.checked){
			var cekiran = el
			break
		}

	}

	// console.log(cekiran.value)
	var vrednost = cekiran.value



	$.ajax({
		url: "anketa3.php",
		method: "post",
		dataType: "json",
		data:{
			idAnketa: id,
			odgovor: vrednost
		},
		success: function (data, textStatus, xhr) {
			console.log(xhr.status)
			switch (xhr.status) {
				case 202:
					alert("Vec ste glasali")
					break;
				case 200:
					alert("Uspesno ste glasali")
					break;
			}
		},
		
		error: function (xhr, statusText ,err) {
			 console.log(xhr.status, statusText, err);
			 if(xhr.status){
			 	alert("Ne mozete ponovo glasati")
			 }	
		}
	}) 
}


function rezultat () {
	// console.log('radi')
	let id = $(this).data("id")

	// $.ajax({
	// 	url: "anketaRezultat.php",
	// 	method: "post",
	// 	dataType: "json",
	// 	data:{
	// 		idAnketaZbir: id,			
	// 	},
	// 	success: function (data, textStatus, xhr) {
	// 		console.log(xhr.status)
	// 		console.log(data)
	// 	},
		
	// 	error: function (xhr, statusText ,err) {

	// 	}
	// }) 



	$.ajax({
		url: "anketaRezultat.php",
		method: "post",
		dataType: "json",
		data:{
			idAnketaRezultat: id,			
		},
		success: function (data, textStatus, xhr) {
			console.log(xhr.status)
			console.log(data)
			ispis(data)		
		},
		
		error: function (xhr, statusText ,err) {

		}
	}) 
}




function ispis (data) {
	let ispis = "";
	let br = 0;
	data.forEach( function(el) {
		br += parseInt(el.rezultat) 
	});
	ispis += `<h3>Ukupan broj glasova: ${br}</h3>`

	data.forEach( function(ele) {
		ispis += `<p>${ele.odgovor}`
		ispis += `

			<div class="progress">
			  <div class="progress-bar" role="progressbar" aria-valuenow="70"
			  	aria-valuemin="0" aria-valuemax="100" style="width:${Math.round(100/br*ele.rezultat)}%">${Math.round(100/br*ele.rezultat)}%
			  </div>
			</div>


		`
	});
	
	$("#ispisRezultata").html(ispis)
}