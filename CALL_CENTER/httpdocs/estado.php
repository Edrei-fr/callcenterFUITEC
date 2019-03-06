<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
include_once('cabecera2.php');
?>
<form method="post" action="estado.php" class="frm_plan">
<?php
if(isset($_GET['telefono'])&&isset($_GET['curso'])&&isset($_GET['fecha_p'])&&isset($_GET['plan'])&&isset($_GET['empresa'])){

$tlf=$_GET['telefono'];
$curso=$_GET['curso'];
$fecha_p=$_GET['fecha_p'];
$plan=$_GET['plan'];
$empresa=$_GET['empresa'];	
	
$con=new Conexion();
$con->sql="SELECT nombre,apellido1,apellido2 FROM alumnos WHERE telefono='".$tlf."'";
$a=$con->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);	
if($a){$f=mysqli_fetch_assoc($a);
echo '<p><h3>Alumno: '.$f['nombre'].' '.$f['apellido1'].' '.$f['apellido2'].'</h3></p>
	  <p>Teléfono: '.$tlf.'</p>
	  <p>Curso: '.$curso.'</p>
      <p>Fecha prescripción: '.$fecha_p.'</p>
	  <input type=hidden name="telefono" value="'.$tlf.'">
	  <input type=hidden name="curso" value="'.$curso.'">
	  <input type=hidden name="fecha_p" value="'.$fecha_p.'">
	  <input type=hidden name="plan" value="'.$plan.'">
	  <input type=hidden name="empresa" value="'.$empresa.'">';
}
} 
?>
<label>Estado:</label>
<select name="estado">
<option value="no contesta">no contesta</option>
<option value="rechazado">rechazado</option>
<option value="pendiente">pendiente</option>
<option value="llamado reiteradamente">llamado reiteradamente</option>
<option value="anexo ocupado">anexo ocupado</option>
<option value="anexo desempleado">anexo desempleado</option>
<option value="pendiente anexo">pendiente anexo</option>	
</select>
<label>Observaciones:</label>
<textarea rows="4" cols="40" name="obs"></textarea>
	<a href="javascript:history.back()"> Volver </a>
<input type="submit" name="guardar" value="Guardar">
</form>
<?php
if(!isset($_POST['guardar'])){
	$_SESSION['inicio']=date('Y-m-d H:i:s');		
}
if(isset($_POST['guardar'])){
	$_SESSION['fin']=date('Y-m-d H:i:s');
	$estado=isset($_POST['estado'])?$_POST['estado']:null;
	$obs=isset($_POST['obs'])?strip_tags(trim($_POST['obs'])):null;
	$con=new Conexion();
	$con->sql="UPDATE prescripciones SET observaciones='".$obs."',estado='".$estado."' WHERE fecha_p='".$_POST['fecha_p']."' 
												AND curso='".$_POST['curso']."' AND telefono='".$_POST['telefono']."'
												AND codigo_plan='".$_POST['plan']."' AND codigo_empresa='".$_POST['empresa']."'";
	$r1=$con->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
	$con->sql="INSERT INTO registro_llamadas(login,telefono,curso,fecha_p,fecha_inicio,fecha_fin,codigo_empresa,codigo_plan) 
				VALUES ('".$_SESSION['operador']."','".$_POST['telefono']."','".$_POST['curso']."','".$_POST['fecha_p']."','".$_SESSION['inicio']."','".$_SESSION['fin']."'
				,'".$_POST['empresa']."','".$_POST['plan']."')";
	$r2=$con->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
	if($r1 && $r2){
		$con->desconectar();
		header('Location: historial.php?telefono='.$_POST['telefono'].'');
	}	
	
	
}

?>
