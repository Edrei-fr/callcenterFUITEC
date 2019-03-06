<?php

class Conexion{
	
	public $sql;
	public $con;
	
	public function conectarse($servidor, $usuario, $pass, $base_datos){
		$this->con = mysqli_connect($servidor, $usuario, $pass, $base_datos);
		$this->con->set_charset("utf8");
		if(!$this->con){
			return false;
		}
		$r = mysqli_query($this->con, $this->sql);
		return $r;
	}

	public function conectarse_iso($servidor, $usuario, $pass, $base_datos){
		$this->con = mysqli_connect($servidor, $usuario, $pass, $base_datos);
		$this->con->set_charset("iso-8859-1");
		if(!$this->con){
			return false;
		}
		$r = mysqli_query($this->con, $this->sql);
		return $r;
	}
	
	public function desconectar() {
		
			mysqli_close($this->con);
		
	}
	
	
}



?>