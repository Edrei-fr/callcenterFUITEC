<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
require_once('lib/clases.php');
include_once('cabecera2.php');
?>
<div id="fondo">
<form action="prescripciones.php" method="post" id="prescripciones" class="frm_plan">
<label>Fecha De Inscripción</label>
<input type="date" name="fecha" required>
<label>Curso</label>
<input type="text" name="curso" required>
<label>Plan</label>
<select name="plan">
<?php
$lista = new Clases();
$r = $lista->seleccion_plan();
if($r){
	$opciones =array();
	while($f = mysqli_fetch_assoc($r)){
		$opciones[]= '<option value="'.$f['codigo_plan'].'">'.
		      $f['codigo_plan'].'</option>';
	}
	$opciones = array_unique($opciones);
	foreach($opciones as $val){
		echo $val;
	}
}
?>
</select>
<label>Empresa</label>
<select name="empresa">
<?php
$lis = new Clases();
$r = $lis->seleccion_empresa();

if($r){
	$opciones =array();
	while($f = mysqli_fetch_assoc($r)){
		$opciones[]= '<option value="'.$f['codigo_empresa'].'">'.
		      $f['codigo_empresa'].'</option>';
	}
	$opciones = array_unique($opciones);
	foreach($opciones as $val){
		echo $val;
	}
}
?>
</select>
<label>Teléfono</label>
<input type="text" name="telefono" required>	
<label>Estado</label>
<select name="estado">
<option value="sin llamar">sin llamar</option>
<option value="no contesta">no contesta</option>
<option value="pendiente">pendiente</option>
<option value="ocupado">anexo ocupado</option>
<option value="desempleado">anexo desempleado</option>
<option value="pendiente">pendiente anexo</option>
</select>

<input type="submit" name="enviar" value="Enviar prescripción">
<input type="reset" name="eliminar_prescripciones" value="Eliminar">

</form>
</div>
<?php

$pr = new Clases();
$pr->prescripciones();

include_once('pie2.php');
?>

