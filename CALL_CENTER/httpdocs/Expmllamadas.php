<?php
require_once('lib/seguridad.php');
require_once('lib/config.php');
require_once('lib/conexion.php');
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1 " />
<?php 


if(isset($_GET['usuario'])){
	$login = $_GET['usuario'];
	$filename = 'registro_llamadas_'.date('d-m-Y').'.xls';
	header('Content-Type: application/vnd.ms-excel charset=iso-8859-1"');
	header('Content-Disposition: attachment; filename='.$filename.'');
	header("Pragma: no-cache");
	header("Expires: 0");
}
else {
	exit;
}


$conex = new Conexion();

$conex->sql="SELECT usuarios.nombre,registro_llamadas.login,registro_llamadas.curso , registro_llamadas.fecha_p, registro_llamadas.fecha_inicio, 
registro_llamadas.fecha_fin , prescripciones.codigo_plan,prescripciones.codigo_empresa,planes.nombre as nombre_p
FROM registro_llamadas 
INNER JOIN prescripciones ON prescripciones.fecha_p = registro_llamadas.fecha_p and prescripciones.telefono = registro_llamadas.telefono and prescripciones.curso = registro_llamadas.curso 
INNER JOIN alumnos on alumnos.telefono=registro_llamadas.telefono 
INNER JOIN usuarios on registro_llamadas.login=usuarios.login
INNER JOIN planes on registro_llamadas.codigo_plan=planes.codigo_plan and registro_llamadas.codigo_empresa=planes.codigo_empresa
WHERE registro_llamadas.login = '".$login."' order by registro_llamadas.fecha_inicio";


 $r = $conex->conectarse_iso(SERVIDOR,USUARIO,PASS,BASE_DATOS);
 

 ?>

</head>
<body>
<div>
 <table border="1">
    <thead>
        <tr>
         <?php
	  echo '<th><b>Login</b></th><th><b>Nombre</b></th><th><b>Fecha Inicio</b></th><th><b>Fecha Fin</b></th><th><b>Curso</b></th><th><b>Fecha Prescripción</b></th><th><b>Sector</b></th><th><b>Sector</b></th><th><b>Empresa</b></th>';
         ?>		 
       </tr>
    </thead>
    <tbody>
	<?php
	  if($r){
        while($fila = mysqli_fetch_assoc($r)){
        echo '<tr><td>'.$fila['login'].'</td><td>'.$fila['nombre'].'</td><td>'.$fila['fecha_inicio'].'</td><td>'.$fila['fecha_fin'].'</td><td>'.$fila['curso'].'</td><td>'.$fila['fecha_p'].'</td><td>'.
		$fila['codigo_plan'].'</td><td>'.$fila['nombre_p'].'</td><td>'.$fila['codigo_empresa'].'</td></tr>';

	 }	 
  }
        ?>
  
    </tbody>
</table>
</div>
</body>
</html>	



