<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
include_once('cabecera2.php');


if(isset($_SESSION['empresa'])&&isset($_SESSION['plan'])){
$conex = new Conexion();
$conex->sql="SELECT max(prescripciones.fecha_p) as fecha_p,planes.nombre as p_nombre,empresas.nombre as e_nombre,prescripciones.telefono as tel ,
              alumnos.nombre,alumnos.email,alumnos.situacion_laboral,alumnos.ccaa,alumnos.apellido1,alumnos.apellido2
			  FROM prescripciones INNER JOIN alumnos ON prescripciones.telefono = alumnos.telefono INNER JOIN planes ON prescripciones.codigo_plan = planes.codigo_plan and prescripciones.codigo_empresa = planes.codigo_empresa INNER JOIN empresas ON prescripciones.codigo_empresa = empresas.codigo_empresa WHERE estado IN ('sin llamar','no contesta','pendiente') and prescripciones.codigo_empresa='".$_SESSION['empresa']."' and prescripciones.codigo_plan='".$_SESSION['plan']."'group by planes.nombre ,empresas.nombre ,prescripciones.telefono ,
              alumnos.nombre,alumnos.email,alumnos.situacion_laboral,alumnos.ccaa,alumnos.apellido1,alumnos.apellido2 order by prescripciones.fecha_p ";
 $r = $conex->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
 

}
 ?>
 
 <table id="table_id" class="display" " border="1">
    <thead>
        <tr>
         <?php
	  echo '<th>Fecha Prescripcion</th><th>Nombre</th><th>1er Apellido</th><th>2o Apellido</th><th>Plan</th><th>Empresa</th>
	       <th>Estado laboral</th><th>CCAA</th><th>Email</th><th>Teléfono</th><th>Historial</th>';
         ?>		 
       </tr>
    </thead>
    <tbody>
	<?php
	  if($r){
        while($fila = mysqli_fetch_assoc($r)){
        echo '<tr><td>'.$fila['fecha_p'].'</td><td>'.$fila['nombre'].'</td><td>'.$fila['apellido1'].'</td><td>'.$fila['apellido2'].'</td><td>'.
		$fila['p_nombre'].'</td><td>'.$fila['e_nombre'].'</td><td>'.$fila['situacion_laboral'].'</td><td>'.$fila['ccaa'].'</td><td>'
		.$fila['email'].'</td><td>'.$fila['tel'].'</td><td><a href="historial.php?telefono='.$fila['tel'].'"><img src="img/history.png"></a></td></tr>';

	 }	 
  }
        ?>
  
    </tbody>
</table>

<script type="text/javascript" charset="utf8" src="jquery.js"></script>
<script type="text/javascript" charset="utf8" src="DataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

							  
											
$(document).ready(function() {
    
	$('#table_id').DataTable(
         {
            "language": {
                "url": "DataTables/js/es.js"
            }
        } );						  
							  
	var table = $('#table_id').DataTable();
 
 table
    .column( '0:visible' )
    .order( 'desc' )
    .draw();						  
							  
						  					  
							  
} );											
											
</script>
									
											
 <?php
 include_once('pie2.php');
?>



