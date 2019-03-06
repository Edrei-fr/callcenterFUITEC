<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
include_once('cabecera2.php');
?>
<div id="cuerpo">

<form action="Mllamadas.php" method="POST" class="frm_plan">

<label>Selección de Usuario</label>
<select name="usuario"> 
	<?php
	$con=new Conexion();
	$con->sql="SELECT login FROM usuarios ";
	$r=$con->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
	if($r){
		while($f=mysqli_fetch_assoc($r)){
			echo '<option value="'.$f['login'].'" > '.$f['login'].'</option>';
		}
	}
	?>
</select>
<input type="submit" value="Mostrar">	
</form>
</div>
<?php

include_once('pie.php');
?>