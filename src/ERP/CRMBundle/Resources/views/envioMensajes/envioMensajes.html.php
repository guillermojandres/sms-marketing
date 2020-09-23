<?php 
require "Twilio/Services/Twilio.php";
include_once "src/ERP/CRMBundle/Resources/views/programacion/conexion.html.php";

    
     $conn= conectar();


      $sqlFechaActual = "SELECT DATE(CURDATE()) as fechaActual";
      $resultFechaActual = $conn->query($sqlFechaActual);
      $resultadoFechaActual =$resultFechaActual->fetch_assoc();
      $fechaActual = $resultadoFechaActual["fechaActual"];

      $sqlHoraActual = "SELECT CURTIME() as horaActual";
      $resultHoraActual = $conn->query($sqlHoraActual);
      $resultadoHoraActual =$resultHoraActual->fetch_assoc();
      $horaActual = $resultadoHoraActual["horaActual"];
      $horaActual = explode(":", $horaActual);
      $horaActualNueva=$horaActual[0].":".$horaActual[1].":00";


     $sqlData1 = "SELECT m.id as idMensaje, m.restaurante_id as idRestaurante,m.titulo as titulo ,m.texto as texto,r.numero_twillio as numero_twillio 
                  FROM mensaje m inner join restaurante r on m.restaurante_id = r.id
                  WHERE m.estado_envio=0 AND fecha_envio='$fechaActual' AND hora_envio='$horaActualNueva'";

                  

      $resultData1 = $conn->query($sqlData1);

      if ($resultData1->num_rows > 0) {
//Inicializacion de las credenciales de twillio
            $AccountSid = "AC1b40750f4bacbfdc560b8a7a5bb77bba";
            $AuthToken = "11fa8a5053808a79d1c4a1433037fa8c";

            $client = new Services_Twilio($AccountSid, $AuthToken);
            
                while($row = $resultData1->fetch_assoc()) {
                  $idRestaurante = $row["idRestaurante"];

                  //Se saca la lista de telefonos que estan asignados a ese restaurante
                  $sqlData2="SELECT c.telefono as telefonoCliente   FROM detalle_restaurante_cliente det 
                             inner join cliente c on  det.cliente_id = c.id WHERE det.restaurante_id=$idRestaurante";
                             $resultData2 = $conn->query($sqlData2);

                            if ($resultData2->num_rows > 0) {

                                while($raw = $resultData2->fetch_assoc()) {
                                  //Se envia el mensaje
                                    $message = $client->account->messages->sendMessage(
                                      $row['numero_twillio'], // From a valid Twilio number
                                      $raw["telefonoCliente"], // Text this number
                                      $row['texto']
                                    );

                                }

                            }

                //Se actualiza el estado del mensaje
                $idMensaje =$row['idMensaje'];
                $sqlM = "UPDATE mensaje  SET estado_envio=1  WHERE mensaje.id=$idMensaje ";
                $resultM = $conn->query($sqlM);
                    
                }

          }



 ?>