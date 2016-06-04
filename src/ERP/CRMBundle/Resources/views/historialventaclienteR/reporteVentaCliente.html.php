<!DOCTYPE HTML>
<html lang="Es">
<head>
    <title>Reporte de venta</title>
	<style type="text/css">
		body{font-size:0.80em;}
		.Cabecera{}
                
                .thClass{
                    height: 20px;
                    width: 150px;
                }
                
                .tdC{
                    text-align: right;
                    
                }
                .tdProducto{
                    text-align: left; 
                }
                
                .encabezado{
                   
                    font-size: 15px;
                    
                }
                body {
                    font-family: 'Open Sans', sans-serif;
                }
	</style>


</head>
<body>
    
	
      <div >
    
          <div style="height: 120px;">
              <p style="font-size: 20px; font-weight: 600; float: left; text-transform: uppercase;">Reporte de venta <br/> 
                  <!--<span style="font-size: 13px; color: #c3c3c3; font-weight: 400px; text-transform: none !important;"> Este es un reporte de venta lorem  ..... </span><br>-->

                              <span style="font-size: 13px; color: #262626; font-weight: 400px; text-transform: none !important;">
                                  <b style="text-align: left;">Fecha de registro:</b> <?php echo "  ".$encabezado[0]["fechaRegistro"]; ?> &nbsp;&nbsp;
                                   <b style="text-align: left;">Nombre cliente:</b> <?php echo "  ".$encabezado[0]["nombre"]; ?>
                                
                              </span><br/>
                              
                               <span style="font-size: 13px; color: #262626; font-weight: 400px; text-transform: none !important;">
                                   <b>Estado de venta:</b> <?php if($encabezado[0]["estado"]==1){
                                         echo "Pago Recibido";
                                    }elseif($encabezado[0]["estado"]==2){
                                        echo "En proceso";
                                        
                                    }elseif($encabezado[0]["estado"]==3){
                                        echo "Procesado";
                                        
                                    } elseif($encabezado[0]["estado"]==4){
                                        echo "En camino";
                                        
                                    }elseif($encabezado[0]["estado"]==5){
                                        echo "Completado";
                                        
                                    }   
                                    ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <b>Tipo de pago:</b> <?php echo "  ".$encabezado[0]["tipoPago"]; ?>
                              </span><br/> 
                              <span style="font-size: 13px; color: #262626; font-weight: 400px; text-transform: none !important;">
                                  <b>Monto Total: </b> <?php echo "  $".number_format($encabezado[0]["monto"],2); ?>
                              </span><br/> 
                             
                  
                  
              </p>
                    <img src="http://marvinvigil.info/imagenesbeard/barba1.png" style="width: 100px; height: auto; float: right;"/>
        </div>
			
          <div style="border-top: 2px solid #888888;"></div>   
	
    <div style="margin-top: 20px;">
        <div>
            <p style="font-size: 17px; font-weight: 600;  text-transform: uppercase;">Detalle de venta</p>
        </div>  
    <table style="border: 2px solid #3C2D2D; ">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th class="thClass">Producto</th>
               <th class="thClass">Precio</th>
               <th class="thClass">Cantidad</th>
                <th class="thClass">Sub Total</th>
            </tr>
        </thead>
              <?php
              $dimension = count($detalleOrden['nombre']);
              
              for ($i=0;$i<$dimension;$i++){
                    ?>  
                  <tr>
                 
                      <td class="tdProducto">
                            <?php
                            echo $detalleOrden['nombre'][$i];
                             ?>
                        </td>
                         <td class="tdC">
                         <?php
                            echo "$ ". number_format($detalleOrden['precio'][$i],2);
                             ?>
                        </td>
                        <td class="tdC">
                         <?php
                            echo $detalleOrden['cantidad'][$i];
                             ?>
                        </td>
                         <td class="tdC">
                         <?php
                            echo "$ ". number_format($detalleOrden['cantidad'][$i]*$detalleOrden['precio'][$i],2);
                             ?>
                        </td>
                  </tr>
                             <?php
                             }
                    ?>  
                   
                  
    </table>
    </div>
</div>
</body>
</html> 





