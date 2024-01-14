<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Creat Account</title>
	<link rel="stylesheet" type="text/css" href="css/create_account.css">
</head>
<body>
	<div class="caja-div">
		<img src="https://lastfm.freetls.fastly.net/i/u/770x0/09b4c3aed2d2008eb4dcc83154cc4b19.jpg">
		<form class="caja-div__form" method="post" action="controlador/con_crear_cuenta.php">
			<div class="caja-div__form-div-name">
				<p>Nombre</p>
				<input type="text" name="nombre">
			</div>
			<div class="caja-div__form-div-lastname">
				<p>Apellido</p>
				<input type="text" name="apellido">
			</div>
			<div class="caja-div__form-div">
				<p>Usuario</p>
				<input type="text" name="user" >
				<p>Contraseña</p>
				<input type="password" name="password">
				<p>Repetir contraseña</p>
				<input type="password" name="passwordrepeat">
				<input type="submit" value="Crear Cuenta" id="button">
				<a href="index.php">Return</a>
			</div>
		</form>
	</div>
</body>
</html>