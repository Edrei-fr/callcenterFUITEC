<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
require_once('lib/alumnos.php');
include_once('cabecera2.php');
?>

<form action="form.php" method="post" class="frm_plan" >
<label>Nombre Alumno</label>
<input type="text" name="nombre">
<label>Primer Apellido</label>
<input type="text" name="apellido1">
<label>Segundo Apellido</label>
<input type="text" name="apellido2">
<label>Teléfono</label>
<input type="text" name="telefono" required>
<label>Email</label>
<input type="text" name="email">
<label>Situación laboral</label>
<select name="s_laboral">
<option value="ocupado"> ocupado</option>
<option value="desempleado"> desempleado</option>
<option value="Empleado Publico">empleado público</option>
</select>
<label>CC AA</label>
<select name="c_autonoma">
<option value="Andalucía">Andalucía</option>
<option value="Aragón">Aragón</option>
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
<input type="submit" name="enviar" value="Enviar datos de Alumno">
<input type="reset" name="eliminar" value="Eliminar">
</form>
<?php
$alumnos = new Alumnos();
$alumnos->registrar_alumnos();
?>
<?php

include_once('pie2.php');

?>
