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
                  <span style="font-size: 13px; color: #c3c3c3; font-weight: 400px; text-transform: none !important;">Reporte de abono<br>
                  <b style="text-align: right;">Fecha de registro dentro del sistema:</b>&nbsp;&nbsp;<?php echo "".$abono[0]['fechaRegistroSistema']; ?>
                </span>                 
                  
                  
              </p>
                    <img src="http://marvinvigil.info/imagenesbeard/barba1.png" style="width: 100px; height: auto; float: right;"/>
        </div>
			
          <div style="border-top: 2px solid #888888;"></div>   
	
    <div style="margin-top: 20px;">
        <div>
            <p style="font-size: 17px; font-weight: 600;  text-transform: uppercase;">Detalles del Abono<br><br>
                <span style="font-size: 13px; color: #262626; font-weight: 400px; text-transform: none !important;">
                    <b style="text-align: right;">Fecha de registro:</b>&nbsp;&nbsp;<?php echo "".$abono[0]['fechaRegistroCliente']; ?><br> <br>
                    <b style="text-align: right;">Nombre cliente:</b>&nbsp;&nbsp;<?php echo "".$abono[0]['nombre'];  ?> <br> <br>
                    <b style="text-align: right;">Monto del abono: </b>&nbsp;&nbsp;<?php echo "$ ".number_format($abono[0]['monto'],2);  ?> 
                </span>
            </p>
        </div>  
   
    </div>
</div>
</body>
</html> 





