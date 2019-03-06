<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
include_once('cabecera2.php');

if(isset($_GET['telefono'])){
$var1 = $_GET['telefono'];

$conex = new Conexion();
$conex->sql="SELECT fecha_p,curso,planes.nombre as p_nombre,estado,empresas.nombre as e_nombre,prescripciones.telefono as tel ,
              alumnos.nombre,alumnos.email,alumnos.situacion_laboral,alumnos.ccaa,alumnos.apellido1,alumnos.apellido2,observaciones,prescripciones.codigo_plan,prescripciones.codigo_empresa
			  FROM prescripciones 
             INNER JOIN alumnos ON prescripciones.telefono = alumnos.telefono
			 INNER JOIN planes ON prescripciones.codigo_plan = planes.codigo_plan
			 INNER JOIN empresas ON prescripciones.codigo_empresa = empresas.codigo_empresa 
			 WHERE prescripciones.telefono = ".$var1." ";
 $r = $conex->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);

 $conex->desconectar();
}
 ?>
 
 <table id="table_id" class="display" border="1">
    <thead>
        <tr>
         <?php
	  echo '<th>Prescripción</th><th>Curso</th><th>Plan</th><th>Empresa</th><th>Estado</th><th>Observaciones</th><th>Teléfono</th>';
         ?>		 
       </tr>
    </thead>
    <tbody>
	<?php
	  if($r){
        while($fila = mysqli_fetch_assoc($r)){
        echo '<tr><td>'.$fila['fecha_p'].'</td><td>'.$fila['curso'].'</td><td>'.$fila['p_nombre'].'</td><td>'.$fila['e_nombre'].'</td><td>'.$fila['estado'].'</td><td>'.$fila['observaciones'].'</td><td>'.$fila['tel'].'<a href="estado.php?telefono='.$fila['tel'].'&fecha_p='.$fila['fecha_p'].'&curso='.$fila['curso'].'&plan='.$fila['codigo_plan'].'&empresa='.$fila['codigo_empresa'].'"><img src="img/speech-bubble.png"></a></td></tr>';

	 }	 
  }
        ?>
  
    </tbody>
</table>


<div id="mitad">
<?php
$conex = new Conexion();
$conex->sql="SELECT login,fecha_p,curso,fecha_inicio,fecha_fin,telefono,codigo_empresa, codigo_plan FROM registro_llamadas 
WHERE  telefono = ".$var1." ";
 $r = $conex->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
 ?>
 <table id="table_id2" class="display" border="1">
    <thead>
        <tr>
         <?php
	  echo '<th>Operador</th><th>Prescripción</th><th>Curso</th><th>Código Empresa</th><th>Código Plan</th><th>Inicio llamada</th><th>Fin llamada</th>';
         ?>		 
       </tr>
    </thead>
    <tbody>
	<?php
	  if($r){
        while($fila = mysqli_fetch_assoc($r)){
        echo '<tr><td>'.$fila['login'].'</td><td>'.$fila['fecha_p'].'</td><td>'.$fila['curso'].'</td><td>'.$fila['codigo_empresa'].'</td><td>'.$fila['codigo_plan'].'</td>
		<td>'.$fila['fecha_inicio'].'</td><td>'.$fila['fecha_fin'].'</td></tr>';

	 }	 
  }
        ?>
  
    </tbody>
</table>
</div><script type="text/javascript" charset="utf8" src="jquery.js"></script>
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
<script type="text/javascript">
$(document).ready( function () {
    $('#table_id2').DataTable(
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