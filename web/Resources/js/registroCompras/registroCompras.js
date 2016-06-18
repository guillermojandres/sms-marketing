 $(document).ready(function(){
   var correlativoEdicion=0;
   var numeroEliminacion=0;   
   var correlativo=0;  
   
    var x=0;
     
      
      $("#comprasVistaDetalle").hide();     
   $("#botonesInsercion").hide();
   $("#botonesInsercionE").hide();
   $(".totalRCEL").hide();
    $(".totalRCE").hide();  
     
     
$('#fechaRC').Zebra_DatePicker({
     format: 'Y m, d',
     direction: false,
});


$('#fechaRCE').Zebra_DatePicker({
     format: 'Y m, d',
     direction: false
});

     
//     $("#contenidoVerMasDetalles").hide();
     $("#tipoEstado").select2();
     $("#tipoPago").select2();
     
     
     //Edicion
     
     $("#tipoEstadoE").select2();
     $("#tipoPagoE").select2();
     
    $("#contenidoFormularioRegistroCompra").hide();
    $(".verMasDetalles").hide();
        $(".cancelarVerMas").hide();
   
    
      $(document).on("click",".nuevoRegistroCompra",function() {
            clickAlNuevoRegistroCompra();
            
            var id =$("#idDistribuidor").val();

             
         
                                            $.ajax({
                                                type: 'POST',
                                                async: false,
                                                dataType: 'json',
                                                data: {id:id},
                                                url: Routing.generate('seleccionarCliente'),
                                                success: function (data)
                                                {
                                                     
                                                
                                                    if (data.estado == true) {
                                
                                                    $("#nombreCliente").val(data.nombre);
                                                       

                                                    }

                                                },
                                                error: function (xhr, status)
                                                {
                                                    
                                                }
                                            });    
             

         }); 
       
    

    
    
    
     $(document).on("click",".eliminarDiv",function() {
         var idDetalleOrden = $(this).attr("id");
         
           swal({
                                                    title: "Advertencia",
                                                    text: "¿Estas seguro de remover?",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    cancelButtonText: "No",
                                                    confirmButtonText: "Si",
                                                    confirmButtonColor: "#00A59D",
                                                    closeOnConfirm: true,
                                                    closeOnCancel: true
                                                },
                                                        function (isConfirm) {
                                                            if (isConfirm) {
                                                                   
                                                                     
                                                        $("#"+idDetalleOrden).parent().remove();
                                                          llenarTotalPagarE();
                                                           numeroEliminacion=numeroEliminacion-1;
                                                            if (numeroEliminacion==0){
                                                                
                                                                $(".totalRCE").hide();
                                                                $(".totalComisionClienteEdi").hide();
                                                                $("#botonesInsercionE").hide();
                                                                
                                                            }
                                                          

                                                            } else {
                                                                
                                                                
                                                                
                                                            }
                                                            
                                                            
                                                        });
         
         
     });
    
      
     
     //Esta es la parte de la edicion de los datos
   //Eventos click dentro de las  id de los div contenedores
     
     
   //Eventos click dentro de las  id de los div contenedores
    $(document).on("click","#comprasProcesados",function() {
        if (x!=0){
             $("#comprasVistaDetalle").click();
             swal("Error!", "Tienes que cancelar o guardar las modificaciones", "error")
            
        }else{
              
                var table1 = $('#registroCompras').DataTable();
                                                                table1.ajax.reload( function ( ) {

                                                                } );
                                                       
        }

    });
    
    
    $(document).on("click","#comprasEntregadas",function() {            
        if (x!=0){
             $("#comprasVistaDetalle").click();
             swal("Error!", "Tienes que cancelar o guardar las modificaciones", "error")
            
        }else{
          
                                                                
                                                                var table2 = $('#registroComprasEntregados').DataTable();
                                                                table2.ajax.reload( function ( ) {

                                                                } );
                                                                
                                                               
        }

    });
    
    $(document).on("click","#idcompletado",function() {            
        if (x!=0){
             $("#comprasVistaDetalle").click();
             swal("Error!", "Tienes que cancelar o guardar las modificaciones", "error")
            
        }else{
                  var table4 = $('#registroComprasCompletado').DataTable();
                                                                table4.ajax.reload( function ( ) {

                                                                } );  
             
        }

    });
    $(document).on("click","#comprasEviadas",function() {
        if (x!=0){
             $("#comprasVistaDetalle").click();
             swal("Error!", "Tienes que cancelar o guardar las modificaciones", "error")
            
        }else{
           var table3 = $('#registroComprasEnviados').DataTable();
                                                                table3.ajax.reload( function ( ) {

                                                                } );
                                                                
                                                                 
        }

    });
    
    $(document).on("click","#comprasPendientesCanceladas",function() {
        if (x!=0){
             $("#comprasVistaDetalle").click();
             swal("Error!", "Tienes que cancelar o guardar las modificaciones", "error")
            
        }else{

          var table4 = $('#registroComprasPendientesCanceladas').DataTable();
                                                                    table4.ajax.reload( function ( ) {

                                                                     } );

        }

    });
  
     //Boton ver mas detalles
     
       $(document).on("click",".verMasDetalles",function() {
           x=1;
           
                                  $("#comprasVistaDetalle").click();
                                    $("#comprasVistaDetalle").show();     
           clickVermasDetalles();
          
                    var idEncabezado = $("#idDetalleRegistroCompra").val();
                    
                                 $.ajax({
                                                  type: 'POST',
                                                  async: false,
                                                  dataType: 'json',
                                                  data: {idEncabezado:idEncabezado},
                                                  url: Routing.generate('buscarDestalleRegistroCompra'),
                                                  success: function (data)
                                                  {
                                                      

                                                      if (data.estado == true) {
                                                                               
                                                          
                                                        $.each(data.encabezado, function( key, value ) {

                                                 
                                                            var monto =parseFloat(value.monto);
                                                            var montoComision =parseFloat(value.montoComision);
                                                          $("#totalRCE").val(monto);
                                                          $("#fechaRCE").val(value.fechaRegistro);
                                                          $("#nombreClienteE").val(value.nombre); 
                                                          
                                                          $('#tipoPagoE').val(value.tipoPago).change();
                                                          $("#tipoEstadoE").val(value.estado).change();
                                                        
                                                            $("#totalComisionEdi").val(montoComision);
                                                          $("#clientesIdEdicion").val(value.id);
                                                          
                                                            
                                                        });

                                                        

                                    var formulario="";
                                   $.each(data.nombre, function( key, value ) {
                                       numeroEliminacion=numeroEliminacion+1;
                                       var precio=data.precio[key];
                                       var cantidad =data.cantidad[key];
                                       var subtotal =precio*cantidad;
                                       var comisionValor=(subtotal*(data.descuento[key]/100));
                                       subtotal=subtotal-comisionValor;
                                       subtotal=subtotal.toFixed(2);
                                               
                                                               correlativoEdicion=correlativoEdicion+1;
                                                              // alert(data.nombre[key]);
                                                    formulario = '<div class="clearfix"><div></div><div class="nuevaOrden"><div class="form-column col-md-3">\n\
                                                                            <div class="form-group" style="margin-right: 2%;">\n\
                                                                                    <label for="producto" class="control-label">Producto</label>\n\
                                                                                        <select disabled name="productoE" class="form-control productoE productoEditacion" style="width: 100%" id="producto-'+correlativoEdicion+'" >\n\
                                                                                                <option value="'+data.idNombre[key]+'" selected>'+data.nombre[key]+'</option>\n\
                                                                                          </select>\n\
                                                                                </div>\n\
                                                                            </div>\n\
                                                                            <div class="form-column col-md-2">\n\
                                                                                <div class="form-group" >\n\
                                                                                    <label for="precio" class="control-label">Precio ($)</label>\n\
                                                                                        <input type="text" class="form-control precioE precioEditacion" id="precio-'+correlativoEdicion+'" placeholder="$ precio del producto" name="precio"   value="'+data.precio[key]+'"  >\n\
                                                                                </div>\n\
                                                                             </div>\n\
                                                                            <div class="form-column col-md-2">\n\
                                                                                <div class="form-group" >\n\
                                                                                    <label for="cantidad" class="control-label">Cantidad</label>\n\
                                                                                        <div class="form-group"><div class="input-group"><div class="input-group-addon">#</div><input type="text" min="1" class="form-control cantidadE cantidadEditacion" id="cantidad-'+correlativoEdicion+'" placeholder="# cantidad producto" name="cantidad" value="'+data.cantidad[key]+'"></div></div>\n\
                                                                                </div>\n\
                                                                             </div>\n\
                                                                            <div class="form-column col-md-2">\n\
                                                                                   <div class="form-group" >\n\
                                                                                       <label for="decuento" class="control-label">Comision</label>\n\
                                                                                           <div class="form-group"><div class="input-group"><div class="input-group-addon">%</div><input type="text" class="form-control descuentoE descuentoEditacion" id="descuento-'+correlativoEdicion+'" placeholder="% Descuento" name="descuento" value="'+data.descuento[key]+'" ><div class="input-group-addon"></div></div>\n\
                                                                                   </div>\n\
                                                                             </div>\n\
                                                                           </div>\n\
                                                                            <div class="form-column col-md-2">\n\
                                                                                <div class="form-group" >\n\
                                                                                    <label for="subtotal" class="control-label">Sub Total</label>\n\
                                                                                        <input type="text" class="form-control subtotalE subtotalEditacion" id="subtotal-'+correlativoEdicion+'"  name="subtotal" value="'+subtotal+'" disabled>\n\
                                                                                </div>\n\
                                                                             </div>\n\
                                                                             <div class="form-column" style="display:none;">\n\
                                                                                <div class="form-group" >\n\
                                                                                    <label for="subtotal" class="control-label">PorcentajeComision</label>\n\
                                                                                       <input type="text" class="form-control comision" id="comision-'+correlativoEdicion+'"  name="comision" value="'+comisionValor+'" readonly>\n\
                                                                                </div>\n\
                                                                             </div>\n\
                                                                           <div style="display:none;"><input class="idOrdenCompra" type="hidden" value="'+data.idOrden[key]+'"></div><div class="fa fa-close col-md-1 eliminarDivE" id="'+data.idOrden[key]+'" style="margin-top: 3%;margin-left:-20px;" title="Eliminar"></div>\n\
                                                                        </div>\n\
                                                                        <div class="clearfix"></div></div>';
                                                                    
                                                                    
                                                                    
                                                                  $("#contenidoVerMasDetalles").append(formulario);  
//                                                                         
//                                                                             $('#producto-'+correlativoEdicion).select2({
//                                                                                   ajax: {
//                                                                                       url: Routing.generate('buscarProducto'),
//                                                                                       dataType: 'json',
//                                                                                       delay: 250,
//                                                                                       data: function (params) {
//                                                                                           return {
//                                                                                               q: params.term,
//                                                                                               page: params.page
//                                                                                           };
//                                                                                       },
//                                                                                       processResults: function (data, params) {
//                                                                                           var select2Data = $.map(data.data, function (obj) {
//                                                                                               obj.id = obj.abogadoid;
//                                                                                               obj.text = obj.nombre;
//
//                                                                                               return obj;
//                                                                                           });
//
//                                                                                           return {
//                                                                                               results: select2Data
//                                                                                           };
//                                                                                       },
//                                                                                       cache: true
//                                                                                   },
//                                                                                   escapeMarkup: function (markup) { return markup; },
//                                                                                   minimumInputLength: 1,
//                                                                                   templateResult: formatRepo,
//                                                                                   templateSelection: formatRepoSelection,
//                                                                                   formatInputTooShort: function () {
//                                                                                       return "Ingrese un caracter para la busqueda";
//                                                                                   }
//                                                                               });
//                                                                             

                                                                    
                                                      
                                                                       
                                                                       
                                                                    //Finalizae el $.each                              
                                                                });
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                

                                                      }

                                                  },
                                                  error: function (xhr, status)
                                                  {

                                                  }
                                              });    

       });
       
       
       
       
       //Add detalles
       
             $(document).on("click",".addCompraProductoE",function() {
               numeroEliminacion=numeroEliminacion+1;
           $(".totalRCE").show();
           
           
           correlativoEdicion=correlativoEdicion+1;
           var formulario="";
      
            formulario = '<div class="clearfix"></div><div class="nuevaOrden"><div class="form-column col-md-3">\n\
                                <div class="form-group" style="margin-right: 2%;">\n\
                                        <label for="producto" class="control-label">Producto</label>\n\
                                            <select  name="producto" class="form-control productoE productoEditacionNuevo" style="width: 100%" id="producto-'+correlativoEdicion+'" >\n\
                                                    <option value="" disabled selected>Producto...</option>\n\
                                              </select>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-column col-md-2">\n\
                                    <div class="form-group" >\n\
                                        <label for="precio" class="control-label">Precio ($)</label>\n\
                                            <input type="text"  class="form-control precioE precioEditacionNuevo" id="precio-'+correlativoEdicion+'" placeholder="$ precio del producto" name="precio"  value="0">\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="form-column col-md-2">\n\
                                    <div class="form-group" >\n\
                                        <label for="cantidad" class="control-label">Cantidad</label>\n\
                                            <div class="form-group"><div class="input-group"><div class="input-group-addon">#</div><input type="text" class="form-control cantidadE cantidadEditacionNuevo" id="cantidad-'+correlativoEdicion+'" placeholder="# cantidad producto" name="cantidad" value="1"></div></div>\n\
                                    </div>\n\
                                 </div>\n\
                                   <div class="form-column col-md-2">\n\
                                       <div class="form-group" >\n\
                                           <label for="decuento" class="control-label">Comision</label>\n\
                                               <div class="form-group"><div class="input-group"><div class="input-group-addon">%</div><input type="text" class="form-control descuentoE descuentoEditacionNuevo" id="descuento-'+correlativoEdicion+'" placeholder="% Descuento" name="descuento" value=0 ><div class="input-group-addon"></div></div>\n\
                                       </div>\n\
                                    </div>\n\
                                </div>\n\
                                  <div >\n\
                                    <div class="form-column col-md-2"" >\n\
                                        <label for="subtotal" class="control-label">Sub Total</label>\n\
                                            <input type="text" class="form-control subtotalE subtotalEditacionNuevo" id="subtotal-'+correlativoEdicion+'"  name="subtotal" value="0" readonly>\n\
                                    </div>\n\
                                 </div>\n\
                                    <div class="form-column" style="display:none;">\n\
                                        <div class="form-group" >\n\
                                            <label for="subtotal" class="control-label">PorcentajeComision</label>\n\
                                                <input type="text" class="form-control comision" id="comision-'+correlativoEdicion+'" disabled name="comision" value="0" readonly>\n\
                                        </div>\n\
                                 </div>\n\
                                    <div class="fa fa-close col-md-1 eliminarDiv" id="eliminacion-'+correlativoEdicion+'" style="margin-top: 3%;margin-left:-20px;" title="Eliminar"></div>\n\
                            </div>\n\
                            <div class="clearfix"></div></div>';
      
      
                         $("#contenidoVerMasDetalles").append(formulario);
                         
                         
                         
            $('#producto-'+correlativoEdicion).select2({
                ajax: {
                    url: Routing.generate('buscarProducto'),
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        var select2Data = $.map(data.data, function (obj) {
                            obj.id = obj.abogadoid;
                            obj.text = obj.nombre;

                            return obj;
                        });

                        return {
                            results: select2Data
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; },
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection,
                formatInputTooShort: function () {
                    return "Ingrese un caracter para la busqueda";
                }
            });
 
          $("#botonesInsercionE").show();  
          

           
       });
    

       

      $(document).on("change",".cantidadE",function() {

                var idNombre = $(this).attr("id");
                var cantidad = $(this).val();
                var numeroIdentificacion = idNombre.replace("cantidad-", "");
                var porcentDescuento = $('#descuento-' + numeroIdentificacion).val();
                var precio = $('#precio-' + numeroIdentificacion).val();
                var subTotal = (precio * cantidad)-((precio*cantidad)*(porcentDescuento/100));
                subTotal=subTotal.toFixed(2);
                $("#subtotal-"+numeroIdentificacion).val(subTotal);
                var comision= ((precio*cantidad)*(porcentDescuento/100));
                $("#comision-"+numeroIdentificacion).val(comision);
               
                llenarTotalPagarE();
               
      });
      
      
      
    
        function llenarTotalPagarE(){
            var x=0;
            var y=0;
            
             $('.subtotalE').each(
                       function (){
                       var idNombre = $(this).attr("id");
                       var numeroIdentificacion = idNombre.replace("subtotal-", "");
                       var subTotal =  $("#subtotal-"+numeroIdentificacion).val();
                       
                        x=x+parseFloat(subTotal);

                       });
            x=x.toFixed(2);
            $("#totalRCE").val(x);
            
            $('.comision').each(
                       function (){
                       var idNombres = $(this).attr("id");
                       var numeroIdentificaciones = idNombres.replace("comision-", "");
                       var subTotales =  $("#comision-"+numeroIdentificaciones).val();
                       
                        y=y+parseFloat(subTotales);
                       
                       });
            y=y.toFixed(2);
            $("#totalComisionEdi").val(y);
            
            
        }
        
        
       //Precio
       
        $(document).on("change",".precioE",function() {

                var idNombre = $(this).attr("id");
                var  precio= $(this).val();
                var numeroIdentificacion = idNombre.replace("precio-", "");
                var  cantidad= $('#cantidad-' + numeroIdentificacion).val();

                var porcentDescuento = $('#descuento-' + numeroIdentificacion).val();
                var subTotal = (precio * cantidad)-((precio*cantidad)*(porcentDescuento/100));
                subTotal=subTotal.toFixed(2);
                $("#subtotal-"+numeroIdentificacion).val(subTotal);
                
                
                var comision= ((precio*cantidad)*(porcentDescuento/100));
                $("#comision-"+numeroIdentificacion).val(comision);
                
                llenarTotalPagarE();
               
      });
       
       //Descuento
       
       
           $(document).on("change",".descuentoE",function() {

                var idNombre = $(this).attr("id");
               
                var numeroIdentificacion = idNombre.replace("descuento-", "");
                
                 var cantidad = $('#cantidad-' + numeroIdentificacion).val();
                 var precio = $('#precio-' + numeroIdentificacion).val();
                var porcentDescuento = $('#descuento-' + numeroIdentificacion).val();
                 var subTotal = (precio * cantidad)-((precio*cantidad)*(porcentDescuento/100));
                 subTotal=subTotal.toFixed(2);
                $("#subtotal-"+numeroIdentificacion).val(subTotal);
                
                  var comision= ((precio*cantidad)*(porcentDescuento/100));
                $("#comision-"+numeroIdentificacion).val(comision);
                
                llenarTotalPagarE();
               
      });
       
       
       
           
    $(document).on("change",".productoE",function() {
         var idNombre=  $(this).attr("id");
         var idProducto= $(this).val();
         var numero = idNombre.replace("producto-","");
          var idCliente = $("#clientesIdEdicion").val();
         
         
         
         
//            alert(idProducto);
        
                     $.ajax({
                                                  type: 'POST',
                                                  async: false,
                                                  dataType: 'json',
                                                  data: {idProducto:idProducto,idCliente:idCliente},
                                                  url: Routing.generate('buscarPrecioProducto'),
                                                  success: function (data)
                                                  {
                                                      

                                                      if (data.estado == true) {
                                                              
                                                                  $('#precio-'+numero).val(data.precio);
                                                                  $('#descuento-'+numero).val(data.descuento);
                                                      }

                                                  },
                                                  error: function (xhr, status)
                                                  {

                                                  }
                                              });
                                              
              
                var cantidad =  $('#cantidad-' + numero).val();
                var precio = $('#precio-' + numero).val();
                var subTotal = precio * cantidad;
                $("#subtotal-"+numero).val(subTotal);                                 
                llenarTotalPagarE();    
                                              
                        
     });
     
       
       
  //Eliminar registros de una venta, en vista y a la base de datos
  
     $(document).on("click",".eliminarDivE",function() {
         
                                                                 var idEncabezado = $("#idDetalleRegistroCompra").val();
                                                                var idDetalleOrden = $(this).attr("id");
                                swal({
                                                    title: "Advertencia",
                                                    text: "¿Estas seguro de remover este producto del pedido? Si aceptas removerlo, no habra forma de recuperar los datos posteriormente",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    cancelButtonText: "No",
                                                    confirmButtonText: "Si",
                                                    confirmButtonColor: "#00A59D",
                                                    closeOnConfirm: true,
                                                    closeOnCancel: true
                                                },
                                                        function (isConfirm) {
                                                            if (isConfirm) {
                                                                   
                                                             

                                                                $.ajax({
                                                                    type: 'POST',
                                                                    async: false,
                                                                    dataType: 'json',
                                                                    data: {idDetalleOrden: idDetalleOrden, idEncabezado: idEncabezado},
                                                                    url: Routing.generate('eliminarDetalleOrden'),
                                                                    success: function (data)
                                                                    {


                                                                        if (data.estado == true) {

                                                                            $("#"+idDetalleOrden).parent().parent().remove();
                                                                             llenarTotalPagarE();
                                                                                  numeroEliminacion=numeroEliminacion-1;
                                                                                  
                                                                                    if (numeroEliminacion==0){

                                                                                        $("#totalRCE").hide();
                                                                                        $("#totalComisionClienteEdi").hide();
                                                                                        $("#botonesInsercionE").hide();

                                                                                    }else{
                                                                                        
                                                                                        alert(numeroEliminacion);
                                                                                    }
                                                                                    
                                                                        }

                                                                    },
                                                                    error: function (xhr, status)
                                                                    {

                                                                    }
                                                                });
                                                                
                                                                


                                                            } else {
                                                                
                                                                
                                                                
                                                            }
                                                            
                                                            
                                                        });
      
         
     });
       
       
       $(document).on("click",".cancelarVerMas",function() {
           x=0;
            
                    clickCancelarDetalles();
           
       });
     
     
       $(document).on("click","#guardarInsercionRCE",function() {
//Array que llevan los valores que se editaron

        x=0;
        var idEncabezado = $("#idDetalleRegistroCompra").val();
        
        
        var productosE = new Array();
        var preciosE = new Array();
        var cantidadesE = new Array();
        var descuentosE = new Array();
        var ordendeCompraE = new Array();
        
        var fechaRCE = $("#fechaRCE").val();
        var tipoPagoE = $("#tipoPagoE").val();
        var totalRCE= $("#totalRCE").val();
        var estadoE = $("#tipoEstadoE").val();
        var totalComision = $('#totalComisionEdi').val();
        
  
             $(".idOrdenCompra").each(function(k, va) {
                     ordendeCompraE.push($(this).val());
             });
        
        
        
         $(".productoEditacion").each(function(k, va) {
                     productosE.push($(this).val());
             });
             
              $(".precioEditacion").each(function(k, va) {
                     preciosE.push($(this).val());
             });
             
            $(".cantidadEditacion").each(function(k, va) {
                     cantidadesE.push($(this).val());
             });
             
               $(".descuentoEditacion").each(function(k, va) {
                     descuentosE.push($(this).val());
             });
             
        
        
        
   //Array que llevan los valores que se agregaron en la edicion   
        var productosENuevo = new Array();
        var preciosENuevo = new Array();
        var cantidadesENuevo = new Array();
        var descuentosENuevo = new Array();

        
                
         $(".productoEditacionNuevo").each(function(k, va) {
                     productosENuevo.push($(this).val());
             });
             
              $(".precioEditacionNuevo").each(function(k, va) {
                     preciosENuevo.push($(this).val());
             });
             
            $(".cantidadEditacionNuevo").each(function(k, va) {
                     cantidadesENuevo.push($(this).val());
             });
             
               $(".descuentoEditacionNuevo").each(function(k, va) {
                     descuentosENuevo.push($(this).val());
             });
             
        
                  var num=0;
                  
                  
                 $('.productoEditacionNuevo').each( function (){
                       
                       var x=$(this).val();
                       if(x==null){
                           num=num+1;
                       }

                       });
           
             
             if(num==0){
                 
                                        $.ajax({
                                                  type: 'POST',
                                                  async: false,
                                                  dataType: 'json',
                                                  data: {totalComision:totalComision,fechaRCE:fechaRCE,tipoPagoE:tipoPagoE,productosE:productosE,preciosE:preciosE,cantidadesE:cantidadesE,
                                                  descuentosE:descuentosE,totalRCE:totalRCE,estadoE:estadoE,productosENuevo:productosENuevo,preciosENuevo:preciosENuevo
                                                  ,cantidadesENuevo:cantidadesENuevo,descuentosENuevo:descuentosENuevo,ordendeCompraE:ordendeCompraE,idEncabezado:idEncabezado},
                                                  url: Routing.generate('EditarDatosRegistroCompra'),
                                                  success: function (data)
                                                  {


                                                      if (data.estado == true) {
                                                           $("#comprasVistaDetalle").hide();     
                                                                     
                                                swal({
                                                    title: "Datos  modificados con exito con exito",
                                                    text: "¿Quieres seguir ingresando registros de compra?",
                                                    type: "success",
                                                    showCancelButton: true,
                                                    cancelButtonText: "Despues",
                                                    confirmButtonText: "Seguir",
                                                    confirmButtonColor: "#00A59D",
                                                    closeOnConfirm: true,
                                                    closeOnCancel: false
                                                },
                                                        function (isConfirm) {
                                                            if (isConfirm) {
                                                                
                                                                 var url = Routing.generate('cliente_registroCompras_index');
                                                                window.open(url, "_self");


                                                            } else {
                                                                var url = Routing.generate('ordenesdecompra');
                                                                window.open(url, "_self");
                                                            }
                                                        });

                                                      }

                                                  },
                                                  error: function (xhr, status)
                                                  {

                                                  }
                                              }); 
                      
             }else{
                 
             swal("Productos faltante!", "No debes dejar campos de seleccion de productos vacios", "error");
                 
                 
             }
             
                                              
                                              

               
       });
       
     
      $(document).on("click","#cancelarInsercionRCE",function() {
        
            clickCancelarRegistroCompra();
        
          
      });
       
       
      
 });
 
 
 function formatRepo (data) {
            if(data.nombre){
                var markup = "<div class='select2-result-repository clearfix'>" +
                             "<div class='select2-result-repository__meta'>" +
                             "<div class='select2-result-repository__title'>" + data.nombre+ "</div>" +
                             "</div></div>";
            } else {
                var markup = "Seleccione un tipo de producto";
            }

            return markup;
        }

        function formatRepoSelection (data) {
            if(data.nombre){
                return  data.nombre;
            } else {
                return "Seleccione un tipo de producto";
            }   
        }
         function llamarDetalle(){
             
             $("#comprasVistaDetalle").click();
             
         };
  function clickAlNuevoRegistroCompra(){
        

            var url = Routing.generate('cliente_distribuidores_index');
            window.open(url, "_self");
            
//            $("#datadistribuidores").hide();
//           $("#contenidoFormularioRegistroCompra").show();
//            $(".cancelarRC").show();
//            $(".nuevoRegistroCompra").hide();
//              
      
  }
  
  function clickCancelarRegistroCompra(){
        

   
    $("#botonesInsercionE").hide();
    $(".totalRC").hide();
    $(".cancelarRC").hide();
//    $("#contenidoVerMasDetalles").hide();
    $("#datadistribuidores").show();
    $(".nuevoRegistroCompra").show();
    $(".totalRCEL").hide();
    $(".totalRCE").hide();  
      $("#comprasVistaDetalle").hide();     
               
      location.reload();
      
  }   
  
  function clickVermasDetalles(){   
    $(".delete").hide();
    $("#datadistribuidores").hide();

    $(".cancelarRC").hide();
    $(".nuevoRegistroCompra").hide();
    $("#botonesInsercion").hide();
    $(".totalRC").hide();
    $(".verMasDetalles").hide();
    $(".cancelarVerMas").show();
//    $("#contenidoVerMasDetalles").show();
       $("#botonesInsercionE").show();
       
     $(".totalRCEL").show();
    $(".totalRCE").show();  
     
  }
  
  
  function clickCancelarDetalles(){
      
      clickCancelarRegistroCompra();
      

  }