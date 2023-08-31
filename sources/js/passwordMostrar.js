function mostrarPassword(){
		var cambio = document.getElementById("txtPassword");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('bi bi-eye-slash-fill').addClass('bi bi-eye-fill');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('bi bi-eye-fill').addClass('bi bi-eye-slash-fill');
		}
	}
function mostrarPasswordRepetir(){
		var cambio = document.getElementById("txtRepetirContraseña");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon2').removeClass('bi bi-eye-slash-fill').addClass('bi bi-eye-fill');
		}else{
			cambio.type = "password";
			$('.icon2').removeClass('bi bi-eye-fill').addClass('bi bi-eye-slash-fill');
		}
	}
function Mostrar()
{
	document.getElementById("mostrar").hidden=false;
}