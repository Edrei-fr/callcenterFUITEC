<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
include_once('cabecera.php');
?>
<div id="cuerpo">
<form action="panel_plan.php" method="post" class="frm_plan">
<label>Selección de plan</label>
<select name="plan"> 
	<?php
	$con=new Conexion();
	$con->sql="SELECT codigo_plan,nombre FROM planes WHERE codigo_empresa='".$_SESSION['empresa']."'";
	$r=$con->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
	if($r){
		while($f=mysqli_fetch_assoc($r)){
			echo '<option value="'.$f['codigo_plan'].'">'.$f['nombre'].'</option>';
		}
	}
	?>
</select>
<input type="submit" name="enviar" value="continuar">	
</form>
</div>
<?php
$con->desconectar();
if(isset($_POST['enviar'])){
	$_SESSION['plan']=isset($_POST['plan']) ? $_POST['plan'] : null;
	header('Location: listar.php');
}

include_once('pie.php');
?>