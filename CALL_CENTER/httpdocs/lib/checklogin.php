<?php
session_start();
?>
<?php
require_once('config.php');
require_once('conexion.php');

if(isset($_POST['enviar'])){
	$login = isset($_POST['login'])?trim(htmlentities($_POST['login'],ENT_QUOTES)):null;
	$pass = isset($_POST['pass'])?trim(htmlentities($_POST['pass'],ENT_QUOTES)):null;
 
	$con=new Conexion();
	$con->sql="SELECT * FROM usuarios WHERE login = '".$login."'";	
	$r=$con->conectarse(SERVIDOR,USUARIO,PASS,BASE_DATOS);

	if($r){
		$f=mysqli_fetch_assoc($r);
		if($login!=null&&$login==$f['login']&&$pass!=null&&$pass==$f['pass']){
			$_SESSION['loggedin'] = true;
			$_SESSION['nombre'] = $f['nombre'];
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
			$_SESSION['operador'] = $f['login'];
			
			
			
			header('Location: ../panel_empresa.php');
			
		}else{
			header('Location: ../login.php?acceso=error');
		}
		
	}
	$con->desconectar();
}	


 ?>
 
 