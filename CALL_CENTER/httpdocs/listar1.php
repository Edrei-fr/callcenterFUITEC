<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
include_once('cabecera2.php');


if(isset($_SESSION['empresa'])&&isset($_SESSION['plan'])){

$conex = new Conexion();

$conex->sql="SELECT fecha_p,curso,observaciones,estado,planes.nombre as p_nombre,empresas.nombre as e_nombre,estado,prescripciones.telefono as tel,alumnos.nombre,alumnos.email,alumnos.situacion_laboral,alumnos.ccaa,alumnos.apellido1,alumnos.apellido2 FROM prescripciones INNER JOIN alumnos ON prescripciones.telefono = alumnos.telefono INNER JOIN planes ON prescripciones.codigo_plan = planes.codigo_plan and prescripciones.codigo_empresa = planes.codigo_empresa INNER JOIN empresas ON prescripciones.codigo_empresa = empresas.codigo_empresa WHERE estado NOT IN ('sin llamar','no contesta','pendiente') and prescripciones.codigo_empresa= '".$_SESSION['empresa']."' and prescripciones.codigo_plan='".$_SESSION['plan']."' ORDER BY prescripciones.fecha_p ASC";
			 
$r = $conex->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);

}
?>
 <div class="tabla_scroll">
 <table id="table_id" class="display" border="1">
    <thead>
        <tr>
         <?php
	  echo '<th>Fecha</th><th>Nombre</th><th>1er Apellido</th><th>2o Apellido</th><th>Curso</th><th>Plan</th><th>Empresa</th>
	       <th>Estado laboral</th><th>CCAA</th><th>Email</th><th>Teléfono</th><th>Estado</th><th>Observaciones</th><th>Llamar</th><th>Historial</th>';
         ?>		 
       </tr>
    </thead>
    <tbody>
	<?php
	  if($r){
        while($fila = mysqli_fetch_assoc($r)){
        echo '<tr><td>'.$fila['fecha_p'].'</td><td>'.$fila['nombre'].'</td><td>'.$fila['apellido1'].'</td><td>'.$fila['apellido2'].'</td><td>'.$fila['curso'].'</td><td>'.
		$fila['p_nombre'].'</td><td>'.$fila['e_nombre'].'</td><td>'.$fila['situacion_laboral'].'</td><td>'.$fila['ccaa'].'</td><td>'
		.$fila['email'].'</td><td>'.$fila['tel'].'</td><td>'.$fila['estado'].'</td><td>'.$fila['observaciones'].'</td><td><a href="estado.php?telefono='.$fila['tel'].'&fecha_p='.$fila['fecha_p'].'&curso='.$fila['curso'].'&plan='.$_SESSION['plan'].'&empresa='.$_SESSION['empresa'].'"><img src="img/speech-bubble.png"></a></td>
			<td><a href="historial.php?telefono='.$fila['tel'].'"><img src="img/history.png"></a></td></tr>';

	 }	 
  }
        ?>
  
    </tbody>
</table>
</div>

<script type="text/javascript" charset="utf8" src="jquery.js"></script>
<script type="text/javascript" charset="utf8" src="DataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready( function () {
    $('#table_id').DataTable(
         {
            "language": {
                "url": "DataTables/js/es.js"
            }
        } );
} );
</script>
 <?php
 include_once('pie2.php');
?>



