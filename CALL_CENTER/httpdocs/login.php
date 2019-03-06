<?php
include_once('cabecera.php');
?>

<div id="cuerpo">

<form action="lib/checklogin.php" method="post" class="frm_plan">

<label>Login:</label><br>
<input name="login" type="text" id="login" required>
<br><br>

<label>Password:</label><br>
<input name="pass" type="password" id="pass" required>
<br><br>

<input type="submit" name="enviar" value="ENTRAR">
	<?php
	if(isset($_GET['acceso'])&&$_GET['acceso']=='error'){
		echo '<p id="incorrecto">*Usuario o contraseña incorrectos</p>';
	}
	?>
</form>
	

</div>


<footer>
 &copy;2018 <a href="http://call.fuitec.com">call.fuitec.com</a>
</footer>
</body>
</html>