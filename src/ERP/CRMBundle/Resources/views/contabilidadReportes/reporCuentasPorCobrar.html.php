<!DOCTYPE HTML>
<html lang="Es">
<head>
    <title>Reporte de cuentas por cobrar</title>
	<style type="text/css">
		body{font-size:0.80em;}
		.Cabecera{}
                
                .thClass{
                    height: 20px;
                    width: 100px;
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
                .tdProductoCenter{
                    text-align: center; 
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
                        <td colspan="5" style="font-size: 20px; font-weight: 600;text-transform: uppercase;"> Reporte de cuentas por cobrar</td>
                    </tr>
                                          
              </table>
                    
                <img src="http://marvinvigil.info/imagenesbeard/barba1.png" style="width: 100px; height: auto; float: right;margin-top: -80px;"/>
        </div>
			
			
          <div style="border-top: 2px solid #888888;"></div>   
	
    <div style="margin-top: 20px;  margin-left: 20px;">
        <div>
            <p style="font-size: 17px; font-weight: 600;  text-transform: uppercase;">Detalle de cuentas por cobrar a  clientes</p>
        </div>  
        
       <table style="border: 2px solid #3C2D2D;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th class="thClass">Nombre cliente</th>
                <th class="thClass">Nombre de contacto</th>
               <th class="thClass">Telefono</th>
               <th class="thClass">Movil</th>
                  <th class="thClass">Monto Deuda ($)</th>  
            </tr>
        </thead>
              <?php
              
              $dimension = count($datos);
              $totaldeuda =0;
              
              for ($i=0;$i<$dimension;$i++){
                   $totaldeuda=$totaldeuda+ $datos[$i]['totalDeuda'];
                    
                    ?>  
                            <tr>
                                <td class="tdProducto">
                                    <?php
                                    echo $datos[$i]['nombre'];
                                    ?>
                                </td>
                                <td class="tdProducto">
                                    <?php
                                    if ($datos[$i]['contacto'] != null) {

                                        echo "" . $datos[$i]['contacto'];
                                    } else {
                                        echo "No asignado";
                                    }
                                    ?>
                                </td>
                                <td class="tdProductoCenter">
                                    <?php
                                    echo "".$datos[$i]['telefono'];
                                    ?>
                                </td>
                                <td class="tdProductoCenter">
                                    <?php
                                    echo "".$datos[$i]['movil'];
                                    ?>
                                </td>
                                <td class="tdC">
                                    <?php
                                    echo "$ ".$datos[$i]['totalDeuda'];
                                    ?>
                                </td>

                            </tr>
                             <?php
                             }
                    ?>  
    </table>
    </div>
       <div style="margin-top: 20px; margin-left: 460px;">
              <table>
                   <tr>
                      <td class="tdProductoE"><b>Total deuda:</b></td><td class="tdC"><?php echo "$  ".$totaldeuda; ?>     </td>
                  </tr>
                 </table>
          </div>    
          
          
</div>
</body>
</html> 





