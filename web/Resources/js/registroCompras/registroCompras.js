 $(document).ready(function(){
   var correlativoEdicion=0;
   var correlativo=0;  
     
     
   $("#botonesInsercion").hide();
   $("#botonesInsercionE").hide();
   $(".totalRCEL").hide();
    $(".totalRCE").hide();  
     
     
$('#fechaRC').Zebra_DatePicker({
     format: 'M d, Y'
});


$('#fechaRCE').Zebra_DatePicker({
     format: 'Y m, d'
});

     
     $("#contenidoVerMasDetalles").hide();
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
         $(this).parent().parent().remove();
         
          llenarTotalPagar();
         
     });
    
      
      
      
      
      
          //Eventos de los CheckBoxs para poder controlar los seleccionados
         $(document).on('click',".idEncabezado", function(e) {
             
             $(".guardar").hide();
             $(".cancelar").hide();
             $("#formularioInsercion").hide();
              $(".insertar").show();

             var num =0;

                    $('.idEncabezado').each(
                       function (){
                        if($(this).prop("checked")){
                           num++;
                        }
                     

                       });

                    if(num == 0){
                            $(".modificar").hide(); 
                            $(".delete").hide();
                            $("#formularioEdicion").hide();
                            $("#cancelarModificacion").hide();
                            $("#guardarModificacion").hide();
                            $(".verMasDetalles").hide();
                              
                    } else if(num==1){
                             
                            $(".modificar").show();
                            $(".delete").show();
                    
                            
                            var idDetalle = $(this).attr("id");
                           $("#idDetalleRegistroCompra").val(idDetalle);
                           $(".verMasDetalles").show();
                      
                           
                            
                            
                            
                          //Para editar 
                           numero_edicion = $(this).attr("id");//El valor del id del chechboxs
                            
                          $("#formularioEdicion").load(numero_edicion+"/edit");
                            
                            
                         }else{
                             $(".modificar").hide();
                             $(".delete").show();
                             $("#formularioEdicion").hide();
                             $("#guardarModificacion").hide();
                                   $(".verMasDetalles").hide();
                             $("#cancelarModificacion").hide();
                         } 
            
             
            
            });  
    //Evento donde se almacenan los valores de los arrays
     
      $(document).on("click","#guardarInsercionRC",function() {
          
          
          
        var productos = new Array();
        var precios = new Array();
        var cantidades = new Array();
        var descuentos = new Array();
        var fechaRC = $("#fechaRC").val();
        var tipoPago = $("#tipoPago").val();
        var totalRC= $("#totalRC").val();
        var estado = $("#tipoEstado").val();
        
        alert(estado);
          
          
          var idCliente = $("#idDistribuidor").val();
           
            $(".producto").each(function(k, va) {
                     productos.push($(this).val());
             });
             
              $(".precio").each(function(k, va) {
                     precios.push($(this).val());
             });
             
            $(".cantidad").each(function(k, va) {
                     cantidades.push($(this).val());
             });
             
               $(".descuentos").each(function(k, va) {
                     descuentos.push($(this).val());
             });
             
             
             
          
          
                                        $.ajax({
                                                  type: 'POST',
                                                  async: false,
                                                  dataType: 'json',
                                                  data: {idCliente:idCliente,fechaRC:fechaRC,tipoPago:tipoPago,productos:productos,precios:precios,cantidades:cantidades,
                                                  descuentos:descuentos,totalRC:totalRC,estado:estado},
                                                  url: Routing.generate('insertarDatosRegistroCompra'),
                                                  success: function (data)
                                                  {


                                                      if (data.estado == true) {
                                                                     
                                                swal({
                                                    title: "Datos  ingresados con exito",
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
                                                                
                                                                 var url = Routing.generate('cliente_distribuidores_index');
                                                                window.open(url, "_self");


                                                            } else {
                                                                var url = Routing.generate('crm_dashbord');
                                                                window.open(url, "_self");
                                                            }
                                                        });

                                                      }

                                                  },
                                                  error: function (xhr, status)
                                                  {

                                                  }
                                              });    
          
          
          
      });
     
     //Esta es la parte de la edicion de los datos
     

     
     
     
     //Boton ver mas detalles
     
       $(document).on("click",".verMasDetalles",function() {
                 
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
                                                                               
                                                          console.log(data.encabezado);
                                                        $.each(data.encabezado, function( key, value ) {
                                                            var monto =parseFloat(value.monto);
                                                          $("#totalRCE").val(monto);
                                                          $("#fechaRCE").val(value.fechaRegistro);
                                                          $("#nombreClienteE").val(value.nombreCompleto); 
                                                          $("#tipoPagoE").val(value.tipoPago);
                                                          $("#tipoEstadoE").val(value.estado);
                                                            

                                                            
                                                        });

                                    var formulario="";
                                   $.each(data.nombre, function( key, value ) {
                                       var precio=data.precio[key];
                                       var cantidad =data.cantidad[key];
                                       var subtotal =precio*cantidad;        
                                               
                                                               correlativoEdicion=correlativoEdicion+1;
                                                              // alert(data.nombre[key]);
                                                    formulario = '<div class="clearfix"><div></div><div class "nuevaOrden"><div class="form-column col-md-3">\n\
                                                                            <div class="form-group" style="margin-right: 2%;">\n\
                                                                                    <label for="producto" class="control-label">Producto</label>\n\
                                                                                        <select  name="productoE" class="form-control productoE productoEditacion" style="width: 100%" id="producto-'+correlativoEdicion+'" >\n\
                                                                                                <option value="'+data.idNombre[key]+'" selected>'+data.nombre[key]+'</option>\n\
                                                                                          </select>\n\
                                                                                </div>\n\
                                                                            </div>\n\
                                                                            <div class="form-column col-md-3">\n\
                                                                                <div class="form-group" >\n\
                                                                                    <label for="precio" class="control-label">Precio</label>\n\
                                                                                        <input type="text" class="form-control precioE precioEditacion" id="precio-'+correlativoEdicion+'" placeholder="$ precio del producto" name="precio" readonly  value="'+data.precio[key]+'" >\n\
                                                                                </div>\n\
                                                                             </div>\n\
                                                                            <div class="form-column col-md-3">\n\
                                                                                <div class="form-group" >\n\
                                                                                    <label for="cantidad" class="control-label">Cantidad</label>\n\
                                                                                        <input type="number" min="1" class="form-control cantidadE cantidadEditacion" id="cantidad-'+correlativoEdicion+'" placeholder="# cantidad producto" name="cantidad" value="'+data.cantidad[key]+'">\n\
                                                                                </div>\n\
                                                                             </div>\n\
                                                                            <div style="display: none;">\n\
                                                                                <div class="form-group" >\n\
                                                                                    <label for="subtotal" class="control-label">SubTotal</label>\n\
                                                                                        <input type="text" class="form-control subtotalE subtotalEditacion" id="subtotal-'+correlativoEdicion+'"  name="subtotal" value="'+subtotal+'">\n\
                                                                                </div>\n\
                                                                             </div>\n\
                                                                            <div class="form-column col-md-2">\n\
                                                                                   <div class="form-group" >\n\
                                                                                       <label for="decuento" class="control-label">% Descuento</label>\n\
                                                                                           <input type="text" class="form-control descuentoE descuentoEditacion" id="descuento-'+correlativoEdicion+'" placeholder="% Descuento" name="descuento" value="'+data.descuento[key]+'" >\n\
                                                                                   </div>\n\
                                                                                </div>\n\
                                                                                <div style="display:none;"><input class="idOrdenCompra" type="hidden" value="'+data.idOrden[key]+'"></div><div class="fa fa-close col-md-1 eliminarDivE" id="'+data.idOrden[key]+'" style="margin-top: 3%;margin-left:-20px;"></div>\n\
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
           $(".totalRCE").show();
           
           
           correlativoEdicion=correlativoEdicion+1;
           var formulario="";
      
            formulario = '<div class="clearfix"><div></div><div class "nuevaOrden"><div class="form-column col-md-3">\n\
                                <div class="form-group" style="margin-right: 2%;">\n\
                                        <label for="producto" class="control-label">Producto</label>\n\
                                            <select  name="producto" class="form-control productoE productoEditacionNuevo" style="width: 100%" id="producto-'+correlativoEdicion+'" >\n\
                                                    <option value="" disabled selected>Producto...</option>\n\
                                              </select>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-column col-md-3">\n\
                                    <div class="form-group" >\n\
                                        <label for="precio" class="control-label">Precio</label>\n\
                                            <input type="text" class="form-control precioE precioEditacionNuevo" id="precio-'+correlativoEdicion+'" placeholder="$ precio del producto" name="precio" readonly value="0">\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="form-column col-md-3">\n\
                                    <div class="form-group" >\n\
                                        <label for="cantidad" class="control-label">Cantidad</label>\n\
                                            <input type="number" min="1" class="form-control cantidadE cantidadEditacionNuevo" id="cantidad-'+correlativoEdicion+'" placeholder="# cantidad producto" name="cantidad" value="1">\n\
                                    </div>\n\
                                 </div>\n\
                                <div style="display: none;">\n\
                                    <div class="form-group" >\n\
                                        <label for="subtotal" class="control-label">SubTotal</label>\n\
                                            <input type="text" class="form-control subtotalE subtotalEditacionNuevo" id="subtotal-'+correlativoEdicion+'"  name="subtotal" value="0">\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="form-column col-md-2">\n\
                                       <div class="form-group" >\n\
                                           <label for="decuento" class="control-label">% Descuento</label>\n\
                                               <input type="text" class="form-control descuentoE descuentoEditacionNuevo" id="descuento-'+correlativoEdicion+'" placeholder="% Descuento" name="descuento" >\n\
                                       </div>\n\
                                    </div>\n\
                                    <div class="fa fa-close col-md-1 eliminarDiv" style="margin-top: 3%;margin-left:-20px;"></div>\n\
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
                var precio = $('#precio-' + numeroIdentificacion).val();
                var subTotal = precio * cantidad;
                $("#subtotal-"+numeroIdentificacion).val(subTotal);
                
                llenarTotalPagarE();
               
      });
      
      
      
    
        function llenarTotalPagarE(){
            var x=0;
             $('.subtotalE').each(
                       function (){
                       var idNombre = $(this).attr("id");
                       var numeroIdentificacion = idNombre.replace("subtotal-", "");
                       var subTotal =  $("#subtotal-"+numeroIdentificacion).val();
                       
                        x=x+parseFloat(subTotal);

                       });
            
            $("#totalRCE").val(x);
            
            
        }
       
           
    $(document).on("change",".productoE",function() {
         var idNombre=  $(this).attr("id");
         var idProducto= $(this).val();
         var numero = idNombre.replace("producto-","");
         
         
         
         
         
//            alert(idProducto);
        
                     $.ajax({
                                                  type: 'POST',
                                                  async: false,
                                                  dataType: 'json',
                                                  data: {idProducto:idProducto},
                                                  url: Routing.generate('buscarPrecioProducto'),
                                                  success: function (data)
                                                  {
                                                      

                                                      if (data.estado == true) {
                                                              
                                                                  $('#precio-'+numero).val(data.precio);

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
     
       
       
  
     $(document).on("click",".eliminarDivE",function() {
        var idEncabezado = $("#idDetalleRegistroCompra").val();
         var idDetalleOrden=  $(this).attr("id");
         
                             $.ajax({
                                                  type: 'POST',
                                                  async: false,
                                                  dataType: 'json',
                                                  data: {idDetalleOrden:idDetalleOrden,idEncabezado:idEncabezado},
                                                  url: Routing.generate('eliminarDetalleOrden'),
                                                  success: function (data)
                                                  {
                                                      

                                                      if (data.estado == true) {
                                                              
                                                                
                                                                    

                                                      }

                                                  },
                                                  error: function (xhr, status)
                                                  {

                                                  }
                                              });
             $(this).parent().parent().remove();
        llenarTotalPagarE();
         
     });
       
       
       $(document).on("click",".cancelarVerMas",function() {
            
                    clickCancelarDetalles();
           
       });
     
     
       $(document).on("click","#guardarInsercionRCE",function() {
//Array que llevan los valores que se editaron


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
                                                  data: {fechaRCE:fechaRCE,tipoPagoE:tipoPagoE,productosE:productosE,preciosE:preciosE,cantidadesE:cantidadesE,
                                                  descuentosE:descuentosE,totalRCE:totalRCE,estadoE:estadoE,productosENuevo:productosENuevo,preciosENuevo:preciosENuevo
                                                  ,cantidadesENuevo:cantidadesENuevo,descuentosENuevo:descuentosENuevo,ordendeCompraE:ordendeCompraE,idEncabezado:idEncabezado},
                                                  url: Routing.generate('EditarDatosRegistroCompra'),
                                                  success: function (data)
                                                  {


                                                      if (data.estado == true) {
                                                                     
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
                                                                var url = Routing.generate('crm_dashbord');
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
    $("#contenidoVerMasDetalles").hide();
    $("#datadistribuidores").show();
    $(".nuevoRegistroCompra").show();
    $(".totalRCEL").hide();
    $(".totalRCE").hide();  
     
               
      location.reload();
      
  }   
  
  function clickVermasDetalles(){
    $(".delete").hide();
    $("#datadistribuidores").hide();
    $("#contenidoFormularioRegistroCompra").hide();
    $(".cancelarRC").hide();
    $(".nuevoRegistroCompra").hide();
    $("#botonesInsercion").hide();
    $(".totalRC").hide();
    $(".verMasDetalles").hide();
    $(".cancelarVerMas").show();
    $("#contenidoVerMasDetalles").show();
       $("#botonesInsercionE").show();
       
     $(".totalRCEL").show();
    $(".totalRCE").show();  
     
  }
  
  
  function clickCancelarDetalles(){
      
      clickCancelarRegistroCompra();
      

  }