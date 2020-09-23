<?php 

define('HOST', "localhost");
define('USER', "marvinvi");
define('PASS', "5?PU6WOKDh#X");
define('BD', "marvinvi_msn");


function conectar(){ 
$con = new mysqli(HOST,USER,PASS,BD);
	if($con->connect_errno){
		print "Ocurrio este error: ". $con->connect_error;
	}
	return $con;
}






 ?>