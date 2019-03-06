<?php
require_once('conexion.php');
require_once('config.php');
require_once('alumnos.php');
 
 


class Existente{
	
	 public $sql;
	
		public function existe(){
			
		$r= new Conexion();
		$r->sql="SELECT telefono FROM alumnos";
		$r->conectarse(SERVIDOR, USUARIO, PASS, BASE_DATOS);
		return ($r->sql);
		
}
}
?>