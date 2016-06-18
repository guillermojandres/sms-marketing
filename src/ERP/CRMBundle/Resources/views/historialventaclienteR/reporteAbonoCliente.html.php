<!DOCTYPE HTML>
<html lang="Es">
<head>
    <title>Reporte de Abono</title>
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
                   .tdProductoE{
                     height: 10px;
                    width: 100px;
                     text-align:justify; 
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
              <p style="font-size: 20px; font-weight: 600; float: left; text-transform: uppercase;">Reporte de Abono <br/> 
                  <span style="font-size: 13px; color: #c3c3c3; font-weight: 400px; text-transform: none !important;">
                      <b style="text-align: right;">Registro de abono dentro del sistema:</b>&nbsp;&nbsp;<?php echo "".$abono[0]['fechaRegistroSistema']; ?><br>
                      <b style="text-align: right;">Total de deuda del cliente:</b>&nbsp;&nbsp;<?php echo "".$deuda; ?>
                </span>                 
                  
                  
              </p>
                    <img src="http://marvinvigil.info/imagenesbeard/barba1.png" style="width: 100px; height: auto; float: right;"/>
        </div>
			
          <div style="border-top: 2px solid #888888;"></div>   
	
    <div style="margin-top: 20px;">
       
        
         <table>
                
                    <tr>
                        <td colspan="5" style="font-size: 20px; font-weight: 600;text-transform: uppercase;">Detalles del Abono</td>
                    </tr>
                    <tr>
                         <td class="tdProductoE"><b>Fecha de registro:</b></td><td class="tdProducto"> <?php echo "".$abono[0]['fechaRegistroCliente']; ?></td>

                    </tr>
                    <tr>
                        <td class="tdProductoE">  <b>Nombre cliente:</b></td><td class="tdProducto"><?php echo "" . $abono[0]['nombre']; ?></td> 
                         <td class="">  <b>Codigo:</b></td><td class="tdProducto"><?php echo "" . $abono[0]['codigo']; ?></td>

                    </tr>
                    <tr>
                           
                        
                        <td class="tdProductoE">  <b>Monto del Abono:</b></td><td class="tdProducto"><?php echo "$ " . number_format($abono[0]['monto'], 2); ?>  </td>                       
                    </tr>
                    <tr>
                        <td class="tdProductoE">  <b>Tipo de pago:</b></td><td class="tdProducto"><?php echo "".$abono[0]['tipoPago']; ?> </td>          
                    </tr>
                     <tr>
                         <td class="tdProductoE">  <b>Descripcion:</b></td><td class="tdProducto" colspan="3"><?php echo "".$abono[0]['descripcion']; ?> </td>          
                    </tr>
                                      
              </table>
        
        
   
    </div>
</div>
</body>
</html> 





