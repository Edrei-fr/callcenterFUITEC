<?php

require_once('config.php');
require_once('conexion.php');
require_once('existente.php');


class Alumnos{
	

	private $nombre;
	private $apellido1;
	private $apellido2;
	private $telefono;
	private $email;
	private $s_laboral;
	private $c_autonoma;
	
	
	
	public function existe($telefono){
			
		$r= new Conexion();
		$r->sql="SELECT telefono FROM alumnos WHERE telefono like '".$telefono."' ";
		$resultado=$r->conectarse(SERVIDOR, USUARIO, PASS, BASE_DATOS);
		if ($resultado->num_rows>0) {
			return true;
		}
		else {
			return false;
		}	
		
}	
	
	public function registrar_alumnos(){
		if(isset($_POST['enviar'])){
		 $nombre = isset($_POST['nombre']) ? trim(strip_tags( $_POST['nombre'])) : '' ;
		 $apellido1 = isset($_POST['apellido1']) ? trim(strip_tags( $_POST['apellido1'])) : '' ;
		 $apellido2 = isset($_POST['apellido2'] )? trim(strip_tags( $_POST['apellido2'])) : '' ;
		 $telefono = isset($_POST['telefono']) ? trim(strip_tags( $_POST['telefono'])) : '' ; 
		 $email = isset($_POST['email']) ? trim(strip_tags( $_POST['email'])) : '' ; 
		 $s_laboral = isset($_POST['s_laboral'] )? trim(strip_tags( $_POST['s_laboral'])) : '' ;
		 $c_autonoma = isset($_POST['c_autonoma'] )? trim(strip_tags( $_POST['c_autonoma'])) : '' ;
		 
		if(!empty($nombre) && !empty($apellido1) && !empty($apellido2) &&  !empty($telefono)	&& !empty($email)) {
							
			if (!$this->existe($telefono)) {	
				$lib = new Conexion();
				$lib->sql = "INSERT INTO alumnos(telefono ,nombre,apellido1 , apellido2 ,email, situacion_laboral ,ccaa) VALUES('".$telefono."','".$nombre."','".$apellido1."'
				,'".$apellido2."','".$email."','".$s_laboral."','".$c_autonoma."')";
			    $lib->conectarse(SERVIDOR, USUARIO, PASS, BASE_DATOS);
				echo ' <p style="color:#65d4ed"> INSERTADO </p>';
			}
else {
		echo ' <p class="error"> ESE ALUMNO YA EXISTE</p>';
}	
				
		}else{
				echo ' <p class="advertencia">FALTAN DATOS POR RELLENAR </p>';
				
			}
		}
	}
}
	

		
	

?>