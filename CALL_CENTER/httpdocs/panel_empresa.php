<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
include_once('cabecera.php');
?>
<div id="cuerpo">

<form action="panel_empresa.php" method="post" class="frm_plan">
<?php
echo '<p id="bienvenida">Bienvenid@ '.$_SESSION['nombre'].'</p>';
?>
<label>Selección de empresa</label>
<select name="empresa"> 
	<?php
	$con=new Conexion();
	$con->sql="SELECT * FROM empresas";
	$r=$con->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
	if($r){
		while($f=mysqli_fetch_assoc($r)){
			echo '<option value="'.$f['codigo_empresa'].'">'.$f['nombre'].'</option>';
		}
	}
	?>
</select>
<input type="submit" name="enviar" value="continuar">	
</form>
</div>
<?php
if(isset($_POST['enviar'])){
	$_SESSION['empresa']=isset($_POST['empresa']) ? $_POST['empresa'] : null;
	header('Location: panel_plan.php');
}

include_once('pie.php');
?>