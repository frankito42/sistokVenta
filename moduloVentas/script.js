document.addEventListener("DOMContentLoaded", () => {
	const $btnEscanear = document.querySelector("#btnEscanear"),
	$input = document.querySelector("#codigoDeBarra");
	$btnEscanear.addEventListener("click", ()=>{
		window.open("leer.html");
	});

	window.onCodigoLeido = datosCodigo => {
		/* console.log("Oh sí, código leído: ")
		console.log(datosCodigo) */
		$input.nextElementSibling.classList.add("active")
		$input.value = datosCodigo.codeResult.code;
		$input.focus()

		/* const ke = new KeyboardEvent("keydown", {
			bubbles: true, cancelable: true, keyCode: 13
		});
		document.body.dispatchEvent(ke); */
		
		/* $("#target").submit((event)=>{
			event.preventDefault()
		}) */
	}
});