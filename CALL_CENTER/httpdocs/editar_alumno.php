<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
require_once('lib/funcion_editar.php');
include_once('cabecera2.php');
?>

<?php
$editar_datos=new Editar();
$telefono = isset($_POST['telefono'])?strip_tags(trim($_POST['telefono'])):null;
if (!$editar_datos->existe_editar($telefono)) {
		echo "No existe telefono";
}
else {

?>


<form id="frm_plan" name="frm_plan" action="editar_alumno.php" method="post" class="frm_plan" >
<label>Telefono:<?php echo $telefono?></label>
<input type="hidden" id="telefono" name="telefono" value="<?php echo $telefono?>">
<label>Nombre</label>
<input type="text" name="nombre" value="<?php echo $editar_datos->nombre?>">
<label>Apellido1</label>
<input type="text" name="apellido1" value="<?php echo $editar_datos->apellido1?>">
<label>Apellido2</label>
<input type="text" name="apellido2" value="<?php echo $editar_datos->apellido2?>">
<label>Email</label>
<input type="text" name="email" value="<?php echo $editar_datos->email?>">
<label>Situacion laboral</label>
<select name="s_laboral" id="s_laboral" value="<?php echo $editar_datos->s_laboral?>">
<option value="ocupado">Ocupado</option>
<option value="desempleado">Desempleado</option>
<option value="Empleado Publico">Empleado Publico</option>
</select>
<label>CCAA</label>
<select id="c_autonoma" name="c_autonoma" value="<?php echo $editar_datos->c_autonoma?>">
<option value="Andalucia">Andalucia</option>
<option value="Aragon">Aragon</option>
<option value="Canarias">Canarias</option>
<option value="Cantabria">Cantabria</option>
<option value="Castilla - La Mancha">Castilla - La Mancha</option>
<option value="Castilla y León">Castilla y León</option>
<option value="Catalunya">Catalunya</option>
<option value="Extremadura">Extremadura</option>
<option value="Euskadi">Euskadi</option>
<option value="Galicia">Galicia</option>
<option value="Illes Balears">Illes Balears</option>
<option value="La Rioja">La Rioja</option>
<option value="Madrid">Madrid</option>
<option value="Murcia">Murcia</option>
<option value="Navarra">Navarra</option>
<option value="País Valencià">País Valencià</option>
<option value="Principado de Asturias">Principado de Asturias</option>
<option value="Ceuta">Ceuta</option>
<option value="Melilla">Melilla</option>
</select>
<input type="submit" name="enviar"  value="enviar">
<input type="reset" name="eliminar"  value="eliminar">
</form>

<script language="JavaScript">
	 document.frm_plan.c_autonoma.value="<?php echo $editar_datos->c_autonoma?>";
	 document.frm_plan.s_laboral.value="<?php echo $editar_datos->s_laboral?>";
</script>

<?php
$editar_datos->editar_alumnos();
}

include_once('pie2.php');
?>



