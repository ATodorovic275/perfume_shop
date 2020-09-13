jQuery(document).ready(function($) {
	$("#dodAnketu").click(ispisAnkete)
});


function ispisAnkete () {
	let ispis = "" 
	ispis += `
		<form action='novaAnketa.php' method='post'>
			<span class='i-name'>Pitanje:</span> <input class='forma' type="text" name="pitanje" id="pitanje"><br/>
			<a id='odgovor'>Odgovor</a><br>
			<div id='odgovori'></div>
			<input type='submit' name='dodajAnketu' value='Dodaj anketu'/>     
		</form>`

	$("#ispis").html(ispis)

	$("#odgovor").click(odgovor)
}



function odgovor () {
	ispis += `<span class='i-name'>Odgovor:</span> <input class='forma' type="text" name="odgovor" id="odgovor"><br/>`

	$("#odgovori").html(ispis)
}