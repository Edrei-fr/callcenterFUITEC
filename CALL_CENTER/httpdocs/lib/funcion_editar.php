<?php

require_once('config.php');
require_once('conexion.php');


class Editar {
	
	
	public $nombre;
	public $apellido1;
	public $apellido2;
	public $telefono;
	public $email;
	public $s_laboral;
	public $c_autonoma;
	
	public function seleccion_telefono(){
		$slec= new Conexion();
		$slec->sql="SELECT telefono FROM alumnos";
		$resultado=$slec->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
		return $resultado;
	}	
	
public function existe_alumno($nombre , $apellido1 , $apellido2){
			
		$r= new Conexion();
		$r->sql="SELECT nombre  , apellido1 , apellido2 FROM alumnos
		WHERE nombre , apellido1 , apellido2 like '".$nombre."','".$apellido1."','".$apellido2."' " ;
		$resultado=$r->conectarse(SERVIDOR, USUARIO, PASS, BASE_DATOS);
		if ($resultado) {
				
			return true;
		}
		else {
			return false;
		}	
		
}

public function existe_editar($telefono){
			
		$r= new Conexion();
		$r->sql="SELECT * FROM alumnos WHERE telefono like '".$telefono."' ";
		$resultado=$r->conectarse(SERVIDOR, USUARIO, PASS, BASE_DATOS);
		if ($resultado->num_rows>0) {
			$f=mysqli_fetch_assoc($resultado);
			$this->nombre = $f['nombre'];
			$this->apellido1 = $f['apellido1'];
			$this->apellido2 = $f['apellido2'];
			$this->telefono= $f['telefono'];
			$this->email=$f['email'];
			$this->s_laboral=$f['situacion_laboral'];
			$this->c_autonoma=$f['ccaa'];
			
			return true;
		}
		else {
			return false;
		}	
	
}
		
	
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
	
	public function editar_alumnos(){
		if(isset($_POST['enviar'])){
		 $nombre=isset($_POST['nombre']) ? trim(strip_tags( $_POST['nombre'])) : '' ; 
		 $apellido1=isset($_POST['apellido1']) ? trim(strip_tags( $_POST['apellido1'])) : '' ; 
		 $apellido2=isset($_POST['apellido2']) ? trim(strip_tags( $_POST['apellido2'])) : '' ; 
		 $telefono = isset($_POST['telefono']) ? trim(strip_tags( $_POST['telefono'])) : '' ; 
		 $email = isset($_POST['email']) ? trim(strip_tags( $_POST['email'])) : '' ; 
		 $s_laboral = isset($_POST['s_laboral'] )? trim(strip_tags( $_POST['s_laboral'])) : '' ;
		 $c_autonoma = isset($_POST['c_autonoma'] )? trim(strip_tags( $_POST['c_autonoma'])) : '' ;
		 
		if(!empty($nombre)){ 
								
				$editar= new Conexion();
				
				$editar->sql ="UPDATE  alumnos SET  nombre='".$nombre. "', apellido1='".$apellido1. "',apellido2='".$apellido2. "', telefono='".$telefono. "' ,  email='".$email."' , situacion_laboral='".$s_laboral. "', ccaa='".$c_autonoma."'  
				WHERE telefono ='".$telefono."'" ;
				$r=$editar->conectarse(SERVIDOR, USUARIO, PASS, BASE_DATOS);
				if ($r) {
					echo  '<p class="correcto"> ATUALIZADO</p>';
				}
			
				
		}else{
				echo '<p class="error"> solo se pueden modificar los alumnos ya registrados </p>';
				
			}
		}else{
			echo  '<p class="error"> VACIO</p>';
		
	} 

	
	}
	

}	
	

?>


				
	