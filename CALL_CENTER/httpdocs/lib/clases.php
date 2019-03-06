<?php
require_once('conexion.php') ;
require_once('config.php') ;
include_once('alumnos.php');

class Clases{
	

	private $fecha;
	private $curso;
	private $plan;
	private $empresa;
	private $estado;
    private $telefono;
	
	

	

	public function seleccion_plan(){
		$slec= new Conexion();
		$slec->sql="SELECT codigo_plan FROM planes
                          		INNER JOIN empresas ON empresas.codigo_empresa=planes.codigo_empresa";
		$resultado=$slec->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
		return $resultado;
	} 
	public function seleccion_empresa(){
		$slec= new Conexion();
		$slec->sql="SELECT codigo_empresa FROM empresas";
		$resultado=$slec->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);
		return $resultado;
	}
	
	
	public function prescripciones(){
		
	 $alumno1 = new Alumnos();
		
		if(isset($_POST['enviar'])){
		 $fecha = isset($_POST['fecha'] )?  $_POST['fecha'] : '' ;
		 $curso = isset($_POST['curso'] )? trim(strip_tags( $_POST['curso'])) : '' ;
		 $plan = isset($_POST['plan']) ?  $_POST['plan']: '' ;
		 $telefono = isset($_POST['telefono']) ? trim(strip_tags( $_POST['telefono']) ): '' ;
		 $empresa = isset($_POST['empresa']) ? $_POST['empresa']: '' ;
		 $estado = isset($_POST['estado']) ?  $_POST['estado']: '' ;
		 
		 
		if(!empty($fecha) && !empty($curso)&& !empty($telefono)){
		
	         if ($alumno1->existe($telefono)) {
				$lib = new Conexion();
				$lib->sql = "INSERT INTO prescripciones(fecha_p ,curso,	codigo_plan	,codigo_empresa	,estado ,telefono) VALUES('".$fecha."','".$curso."','".$plan."', '".$empresa."','".$estado."','".$telefono."')";
				$res=$lib->conectarse(SERVIDOR, USUARIO, PASS, BASE_DATOS);
				if($res){
				echo  ' <p class="correcto"> DATOS ENVIADOS</p>';
				}
			 }
			else {
				echo ' <p class="error" > EL  ALUMNO NO ESTA REGISTRADO </p>' ;
			}
				
			
			}else{
				echo ' <p class="error"> NO REGISTRADO</p>';
			}
	
			
		}
	}
}

?>