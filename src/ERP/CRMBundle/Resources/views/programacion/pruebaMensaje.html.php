<?php
require_once "conexion.html.php";
header('Content-Type: text/html; charset=utf-8');
   $numeroCliente= $_POST['From'];
   $numeroRestaurante= $_POST['To'];
   $cuerpo = $_POST['Body'];
	

	// $numeroCliente="+19018810920";
	// $numeroRestaurante ="+12512373783";
	// $cuerpo="1106";


	$cuerpo=str_replace(" ", "", $cuerpo);
	$conn= conectar();

	
					if($cuerpo=="s" || $cuerpo=="S"){

						/*Si el numero ya existe o ya esta suscrito el numero del cliente*/
						$sqlExistenciaCliente = "SELECT count(*) as nummero  FROM  cliente c
												 inner join detalle_restaurante_cliente det on c.id=det.cliente_id 
												 inner join restaurante res on res.id=det.restaurante_id 
												WHERE c.telefono='$numeroCliente' AND res.numero_twillio='$numeroRestaurante' AND det.estado=1";
						  $resultExistenciaCliente = $conn->query($sqlExistenciaCliente);
					      $resultExistenciaC =$resultExistenciaCliente->fetch_assoc();
					      $numero = $resultExistenciaC["nummero"];

					      if ($numero!=0) {

							      	$sql = "SELECT  id as idCliente  FROM  cliente c WHERE c.telefono = '$numeroCliente' AND c.estado=1 ";
									$resul = $conn->query($sql);
									$res =$resul->fetch_assoc();
									$idCliente = $res["idCliente"];

									$sqlRestaurante = "SELECT  id as idRestaurante  FROM  restaurante r WHERE r.numero_twillio = '$numeroRestaurante' AND r.estado=1 ";
									$resulRestaurante = $conn->query($sqlRestaurante);
									$resRestaurante =$resulRestaurante->fetch_assoc();
									$idRestaurante = $resRestaurante["idRestaurante"];

									$sqlC = "UPDATE detalle_restaurante_cliente SET estado=0, fecha_de_baja=now() WHERE cliente_id=$idCliente AND restaurante_id=$idRestaurante";
									$resultC = $conn->query($sqlC);
										if ($resultC) {

											  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
											  echo "<Response><Message>Ya no estas inscrito a nuestro sistema de mensajes. Gracias</Message></Response>";
											
											
										}else{
											  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
											  echo "<Response><Message>Estamos presentando problemas en el servidor, por favor intentelo mas tarde.</Message></Response>";
																			
										}
					      	
					      }else{
					      			  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
									  echo "<Response><Message>Tu numero no esta inscrito.No puedes enviar 'S'.</Message></Response>";

					      }

							
								$conn->close();

					}else{
											/*Evaluamos si el contenido del cuerpo del mensaje existe dentro de uno de los identificadores del sistema*/
											$sqlExistenciaCuerpo = "SELECT count(*) as num  FROM  restaurante_identificadores WHERE serie='$cuerpo' ";
											$resultExistenciaCuerpo = $conn->query($sqlExistenciaCuerpo);
											$resultadoExistencia =$resultExistenciaCuerpo->fetch_assoc();
											$num = $resultadoExistencia["num"];

								if($num!=0){
											/*Si el numero ya existe o ya esta suscrito el numero del cliente*/
										$sqlExistenciaCliente = "SELECT count(*) as nummero  FROM  cliente c
																inner join detalle_restaurante_cliente det on c.id=det.cliente_id 
																inner join restaurante res on 
																res.id=det.restaurante_id 
																WHERE c.telefono='$numeroCliente' AND res.numero_twillio='$numeroRestaurante' AND det.estado=1";
											$resultExistenciaCliente = $conn->query($sqlExistenciaCliente);
											$resultExistenciaC =$resultExistenciaCliente->fetch_assoc();
											$numero = $resultExistenciaC["nummero"];

										if ($numero==0) {

											$sqlC = "INSERT INTO cliente values (0,'$numeroCliente',1,now(),now(),now())";
											$resultC = $conn->query($sqlC);
												if ($resultC) {
														/*Codigo para seleccioanar el id del restaurante*/
														$sqlR = "SELECT  id  FROM  restaurante  WHERE numero_twillio='$numeroRestaurante'";
														$result = $conn->query($sqlR);
														$resultado =$result->fetch_assoc();
														$idRestaurante = $resultado["id"];

														/*Codigo para seleccionar el id del cliente que acabamos de ingresar*/
														$sql = "SELECT  max(id) as ultimoCliente  FROM  cliente c WHERE c.estado=1";
														$resul = $conn->query($sql);
														$res =$resul->fetch_assoc();
														$idCliente = $res["ultimoCliente"];
														
														/*Insercion dentro del detalle de resaturante y cliente*/
														$sqlInsercion = "INSERT INTO detalle_restaurante_cliente values (0,$idRestaurante,$idCliente,1,now(),now(),now())";
														$resultInsercion = $conn->query($sqlInsercion);

															if ($resultInsercion) {
																/*Se envia el mensaje al cliente con su respectivo incentivo*/
																$sqlIncentivo = "SELECT incentivo as incentivo  FROM  restaurante_identificadores WHERE serie='$cuerpo' ";
																$resultIncentivo = $conn->query($sqlIncentivo);
																$resultadoI =$resultIncentivo->fetch_assoc();
																$incentivo = $resultadoI["incentivo"];

																echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
																echo "<Response><Message>".$incentivo."</Message></Response>";
														
															}else{
																echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
																echo "<Response><Message>Estamos presentando problemas en el servidor, por favor espere un momento.</Message></Response>";
																
															}
											}else{
												echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
												echo "<Response><Message>Estamos presentando problemas en el servidor, por favor espere un momento.</Message></Response>";
											
											}
											

									}else{

											echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
											echo "<Response><Message>Lo sentimos, su numero ya esta inscrito.</Message></Response>";

									}






									}else{
										echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
										echo "<Response><Message>Lo sentimos mucho, la serie  enviada no es correcta, intente nuevamente.</Message></Response>";		
									}

								$conn->close();			
									

				}
				/*Este es el fin del primer if donde se validan si existe la serie*/


				

?>

