<?php

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="img/logo 72x72.png">
	<!-- <link rel="manifest" href="manifest.json"> -->
	<title>Login - Broco Security</title>
	<?php include 'components/urlcss.php'; ?>
	<link rel="stylesheet" href="css/login.css">
	<!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
</head>

<body>
	<div id="contenedor" class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Acceso</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registro</label>
			<div class="login-form">
				<div class="sign-in-htm">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="user" name="username" type="text" class="input" placeholder="User99">
					</div>
					<div class="group">
						<label for="pass" class="label">contraseña</label>
						<input id="pass" name="contrasena" type="password" class="input" data-type="password" placeholder="********">
					</div>
					<div class="group">
						<input id="check" type="checkbox" class="check" checked>
						<label for="check"><span class="icon"></span> Recuerdame</label>
					</div>
					<div class="group">
						<input type="submit" id="entrarprofile" class="button" value="Entrar">
					</div>
					<div id="mensaje"></div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<a href="#forgot">¿Olvidaste tu contraseña?</a>
					</div>
				</div>
				<div class="sign-up-htm">
					<form id="reg" action="#">
						<div class="group">
							<label for="nombre" class="label">Nombre</label>
							<input id="nombre" name="nombre" type="text" class="input" placeholder="Juan">
						</div>
						<div class="group">
							<label for="apellidos" class="label">Apellidos</label>
							<input id="apellidos" name="apellidos" type="text" class="input" placeholder="Bautista">
						</div>
						<div class="group">
							<label for="fechanac" class="label">Fecha de Nacimiento</label>
							<input id="fechanac" name="fechanac" type="date" class="input">
						</div>
						<div class="group">
							<label for="user" class="label">Username</label>
							<input id="userbus" name="user" type="text" class="input" placeholder="user99">
							<div style="font-size: 12px;" id="usercons"></div>

						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="passreg" name="pass" type="password" class="input" data-type="password" min="8" max="20" placeholder="*********">
						</div>
						<div class="group">
							<label for="pass" class="label">Repeat Password</label>
							<input id="passver" type="password" class="input" data-type="password" placeholder="*********">
							<p style="font-size: 8px;" id="resultado" class='text-success'>La contraseña debe tener al menos 6 caracteres, un numero y una mayúscula</p>
							<input id="ip" name="ip" type="hidden" class="input" value="">
						</div>
					</form>
					<div class="group">
						<input id="registro" type="submit" class="button" value="Sign Up">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1">¿Ya tienes cuenta?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <script src="app.js"></script> -->
	<script>
		$(document).ready(function() {
			$("#userbus").keyup(function() {
				var username = $(this).val()
				if (username.length > 3) {
					$("#usercons").html('checking...');
					$.ajax({
						type: "POST",
						url: "backend/consUser.php",
						cache: false,
						data: $(this).serialize(),
						success: function(data) {
							if (data == 1) {
								$("#usercons").removeClass("text-success");
								$("#usercons").addClass("text-danger");
								$("#usercons").html("Usuario no disponible");
							} else if (data == 0) {
								$("#usercons").removeClass("text-danger");
								$("#usercons").addClass("text-success");
								$("#usercons").html("Usuario disponible");
							}
						}
					})
				} else {
					$("#usercons").html("");
				}
			})
		})

		$("#entrarprofile").on("click", function() {
			var username = $("#user").val()
			var pass = $("#pass").val()
			$.ajax({
				type: "POST",
				url: "backend/loginBack.php",
				data: {
					username: username,
					pass: pass
				},
				success: (response) => {
					if (response == 0)
						Swal.fire('Datos incorrectos')
					$("#user").val("")
					$("#pass").val("")
					if (response == 1)
						location.href = "components/profile";

				}
			})
		})

		$("#registro").on("click", (e) => {
			e.preventDefault();
			var datas = $("#reg").serialize()
			var pass1 = $("#passreg").val()
			var val = $("#passver").val()
			if (val !== "") {
				if (pass1 !== val) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Contraseña no coinciden!',
					})
					$("#passver").val("")
				} else if (pass1 == val) {
					$.ajax({
						type: "POST",
						url: "backend/consUser.php",
						cache: false,
						data: $(this).serialize(),
						success: function(data) {
							// if(data = null){
							// 	Swal.fire({
							// 		icon: 'error',
							// 		title: 'ha ocurrido un error!',
							// 		text: 'Estamos trabajando en ello!',
							// 	})
							// }
							if (data == 1) {
								Swal.fire({
									icon: 'error',
									title: 'Respeta webon!',
									text: 'Usuario no disponible!',
								})
							} else if (data == 0) {
								$.ajax({
									type: "POST",
									url: "backend/regUser.php",
									data: datas,
									success: (response) => {
										Swal.fire('Success')
										document.getElementById("reg").reset()
									}
								})
							}
						}
					})
				}
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Llena tus datos webon!',
				})
			}
		})

		$("#tab-2").on("click", () => {
			$("#contenedor").removeClass()
			$("#contenedor").addClass("registro")
		})
		$("#tab-1").on("click", () => {
			$("#contenedor").removeClass()
			$("#contenedor").addClass("login-wrap")
		})
	</script>
</body>

</html>