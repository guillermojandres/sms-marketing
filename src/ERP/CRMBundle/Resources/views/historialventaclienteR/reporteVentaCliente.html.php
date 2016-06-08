<!DOCTYPE HTML>
<html lang="Es">
<head>
    <title>Reporte de venta</title>
	<style type="text/css">
		body{font-size:0.80em;}
		.Cabecera{}
                
                .thClass{
                    height: 20px;
                    width: 130px;
                }
                .tdProductoE{
                     height: 10px;
                    width: 100px;
                     text-align: right; 
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
    
          <div style="height: 120px; margin-bottom: -20px;">
             

              
              <table>
                
                    <tr>
                        <td colspan="5" style="font-size: 20px; font-weight: 600;text-transform: uppercase;"> Reporte de venta</td>
                    </tr>
                    <tr>
                      <td class="tdProductoE"><b>Fecha de registro:</b></td><td class="tdProducto"> <?php echo "".$encabezado[0]["fechaRegistro"]; ?> </td>
                      
                      
                      <td class="tdProductoE"><b> Estado de venta:</b></td>
                      <td class="tdProducto">  <?php if($encabezado[0]["estado"]==1){
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
                                    ?>
                      </td>
                        <td class="tdProductoE"><b>N° orden:</b></td><td class="tdProducto"> <?php echo "".$encabezado[0]["numeroOrden"]; ?> </td>
                 </tr>
                  <tr>
                       <td class="tdProductoE">  <b>Tipo de pago:</b></td><td class="tdProducto"><?php echo "".$encabezado[0]["tipoPago"]; ?></td>          
                        <td class="tdProductoE">  <b>Nombre cliente:</b></td><td class="tdProducto"> <?php echo "".$encabezado[0]["nombre"]; ?></td>                     
                 </tr>
                 <tr>
                     
                              
                 </tr>
                         
              </table>
                    
                <img src="http://marvinvigil.info/imagenesbeard/barba1.png" style="width: 100px; height: auto; float: right;margin-top: -80px;"/>
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
                <th class="thClass">Comisión</th>
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
                            echo "% ". $detalleOrden['descuento'][$i];
                             ?>
                        </td>
                         <td class="tdC">
                         <?php
                            echo "$ ".  number_format(($detalleOrden['cantidad'][$i]*$detalleOrden['precio'][$i])-(($detalleOrden['cantidad'][$i]*$detalleOrden['precio'][$i])*($detalleOrden['descuento'][$i]/100)),2);
                             ?>
                        </td>
                  </tr>
                             <?php
                             }
                    ?>  
                   
                  
    </table>
    </div>
          <div style="margin-top: 20px; margin-left: 500px;">
              <table>
                   <tr>
                      <td class="tdProductoE"><b>Total comision:</b></td><td class="tdC"><?php echo "$  ".$encabezado[0]["montoComision"]; ?>     </td>
                  </tr>
                  <tr>
                      <td class="tdProductoE"><b>Monto total:</b></td><td class="tdC"><?php echo "$  " . number_format($encabezado[0]["monto"], 2); ?></td>
                  </tr>
                 
              </table>
          </div>
</div>
</body>
</html> 





