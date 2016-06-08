 $(document).ready(function(){
      
   var correlativo=0;  

   $("#botonesInsercion").hide();
   $(".totalRC").hide();
     
$('#fechaRC').Zebra_DatePicker({
     format: 'M d, Y'
});

     
     
     $("#tipoEstado").select2();
     $("#tipoPago").select2();
     

  $(".nuevoRegistroCompra").hide();
  $(".totalComisionCliente").hide();
    
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
       
       $(document).on("click",".cancelarRC",function() {
           
           clickCancelarRegistroCompra();
       });
       
       
    
       
       $(document).on("click",".addCompraProducto",function() {
        var validacionCliente = $("#clientes").val();
        if (validacionCliente != null) {

            $(".totalRC").show();
            $(".totalComisionCliente").show();
            correlativo = correlativo + 1;


            var formulario = "";

            formulario = '<div class="clearfix"><div></div><div class "nuevaOrden"><div class="form-column col-md-3">\n\
                                <div class="form-group" style="margin-right: 2%;">\n\
                                        <label for="producto" class="control-label">Producto</label>\n\
                                            <select  name="producto" class="form-control producto" style="width: 100%" id="producto-' + correlativo + '" >\n\
                                                    <option value="" disabled selected>Producto...</option>\n\
                                              </select>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-column col-md-2">\n\
                                    <div class="form-group" >\n\
                                        <label for="precio" class="control-label">Precio</label>\n\
                                            <input type="text" class="form-control precio" id="precio-' + correlativo + '" placeholder="$ precio del producto" name="precio"  value="0">\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="form-column col-md-2">\n\
                                    <div class="form-group" >\n\
                                        <label for="cantidad" class="control-label">Cantidad</label>\n\
                                                 <div class="form-group"><div class="input-group"><div class="input-group-addon">#</div><input type="text" min="1" class="form-control cantidad" id="cantidad-' + correlativo + '" placeholder="# cantidad producto" name="cantidad" value="0"></div></div>\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="form-column col-md-2">\n\
                                       <div class="form-group" >\n\
                                           <label for="decuento" class="control-label">Comision</label>\n\
                                                 <div class="form-group"><div class="input-group"><div class="input-group-addon">%</div><input type="text"  class="form-control descuento" id="descuento-' + correlativo + '" placeholder="Descuento" name="descuento" value="0" ><div class="input-group-addon"></div></div>\n\
                                       </div>\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="form-column col-md-2">\n\
                                    <div class="form-group" >\n\
                                        <label for="subtotal" class="control-label">SubTotal</label>\n\
                                            <input type="text" class="form-control subtotal" id="subtotal-' + correlativo + '"  name="subtotal" value="0" readonly>\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="form-column" style="display:none;">\n\
                                    <div class="form-group" >\n\
                                        <label for="subtotal" class="control-label">PorcentajeComision</label>\n\
                                            <input type="text" class="form-control comision" id="comision-' + correlativo + '"  name="comision" value="0" readonly>\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="fa fa-close col-md-1 eliminarDiv" id="eliminacion-' + correlativo + '" style="margin-top: 3%;margin-left:-20px;">\n\
                            </div>';


            $("#contenidoFormularioRegistroCompra").append(formulario);




            $('#producto-' + correlativo).select2({
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
                escapeMarkup: function (markup) {
                    return markup;
                },
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection,
                formatInputTooShort: function () {
                    return "Ingrese un caracter para la busqueda";
                }
            });

            $("#botonesInsercion").show();

        } else {

            swal("Cliente no seleccionado!", "Debes seleccionar un cliente", "error");


        }

       });
    
         
     $(document).on("change",".cantidad",function() {

                var idNombre = $(this).attr("id");
                var cantidad = $(this).val();
                var numeroIdentificacion = idNombre.replace("cantidad-", "");
                var precio = $('#precio-' + numeroIdentificacion).val();
                var porcentDescuento = $('#descuento-' + numeroIdentificacion).val();
                var subTotal = (precio * cantidad)-((precio*cantidad)*(porcentDescuento/100));
                subTotal=subTotal.toFixed(2);
                $("#subtotal-"+numeroIdentificacion).val(subTotal);
                var comision= ((precio*cantidad)*(porcentDescuento/100));
                $("#comision-"+numeroIdentificacion).val(comision);
                
                llenarTotalPagar();
               
      });
         
         
     
      
      
        $(document).on("change",".descuento",function() {

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
                
                llenarTotalPagar();
               
      });
      
      
       $(document).on("change",".precio",function() {

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
                
                llenarTotalPagar();
               
      });
      
      
      
    
        function llenarTotalPagar(){
            var x=0;
            var y=0;
             $('.subtotal').each(
                       function (){
                       var idNombre = $(this).attr("id");
                       var numeroIdentificacion = idNombre.replace("subtotal-", "");
                       var subTotal =  $("#subtotal-"+numeroIdentificacion).val();
                       
                        x=x+parseFloat(subTotal);
                      
                       });
            x=x.toFixed(2);
            $("#totalRC").val(x);
            
              
             $('.comision').each(
                       function (){
                       var idNombres = $(this).attr("id");
                       var numeroIdentificaciones = idNombres.replace("comision-", "");
                       var subTotales =  $("#comision-"+numeroIdentificaciones).val();
                       
                        y=y+parseFloat(subTotales);
                       
                       });
                y=y.toFixed(2);
            $("#totalComision").val(y);
            
            
        }
       
           
    $(document).on("change",".producto",function() {
         var idNombre=  $(this).attr("id");
         var idProducto= $(this).val();
         var numero = idNombre.replace("producto-","");
           var idCliente = $("#clientes").val();
         
         
         
         
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
                llenarTotalPagar();    
                                              
                        
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
                                                                   
                                                                     
                                                        $("#"+idDetalleOrden).parent().parent().remove();
                                                            llenarTotalPagar();

                                                            } else {
                                                                
                                                                
                                                                
                                                            }
                                                            
                                                            
                                                        });
         
         
         
         
         
         
         
         
         
         
         
         
         
         
     });
     
      $(document).on("click","#cancelarInsercionRC",function() {
          $("#cancelarRC").click();
          
      });
     
  
      $(document).on("click","#cancelarInsercionRegistroCompra",function() {
                $("#contenidoIndexDistribuidores").show();
                $("#contenidoFormularioRegistroCompra").hide();
          
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
        var totalComision = $("#totalComision").val();
        
      
          
          
          var idCliente = $("#clientes").val();
    

            $(".producto").each(function(k, va) {
                     productos.push($(this).val());
             });
             
              $(".precio").each(function(k, va) {
                     precios.push($(this).val());
             });
             
            $(".cantidad").each(function(k, va) {
                     cantidades.push($(this).val());
             });
             
               $(".descuento").each(function(k, va) {
                     descuentos.push($(this).val());
             });
             
             
             
                  var num=0;
                  
                  
                 $('.producto').each( function (){
                       
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
                                                  data: {totalComision:totalComision,idCliente:idCliente,fechaRC:fechaRC,tipoPago:tipoPago,productos:productos,precios:precios,cantidades:cantidades,
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

 $('#clientes').select2({
                ajax: {
                    url: Routing.generate('busqueda_abogado_select'),
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
                            obj.text = obj.codigo + ' - ' + obj.nombres;

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
                templateResult: formatRepo2,
                templateSelection: formatRepoSelection2,
                formatInputTooShort: function () {
                    return "Enter 1 Character";
                }
            });     
     
     $(document).on("change","#clientes",function() {
     var idCliente = $(this).val();
         $.ajax({
                                                type: 'POST',
                                                async: false,
                                                dataType: 'json',
                                                data: {id:idCliente},
                                                url: Routing.generate('seleccionarCliente'),
                                                success: function (data)
                                                {
                                                     
                                                
                                                    if (data.estado == true) {
                                                        
                                                        
                                                        
                                                       $("#nombreCliente").text(data.nombre);
                                                       $("#telefonoCliente").text(data.telefono);
                                                       $("#direccionCliente").text(data.direccion);
                                                       
                                                       $("#contenedorDatosGeneralesCliente").show();

                                                    }

                                                },
                                                error: function (xhr, status)
                                                {
                                                    
                                                }
                                            });
    
    
    
});

     
     
     
     
     
     
     
     
     
     
     
     
     



      
 });
 
 
 function formatRepo (data) {
            if(data.nombre){
                var markup = "<div class='select2-result-repository clearfix'>" +
                             "<div class='select2-result-repository__meta'>" +
                             "<div class='select2-result-repository__title'>" + data.nombre+ "</div>" +
                             "</div></div>";
            } else {
                var markup = "Seleccione un tipo de equipo";
            }

            return markup;
        }

        function formatRepoSelection (data) {
            if(data.nombre){
                return  data.nombre;
            } else {
                return "Seleccione un tipo de equipo";
            }   
        }
        
  function clickAlNuevoRegistroCompra(){
        
         $(".delete").hide();
         $(".modificar").hide();
         
         $(".guardar").hide();
         $(".cancelar").hide();
         
          $("#guardarModificacion").hide();
         $("#cancelarModificacion").hide();
          $(".insertar").hide();  
            
            
            $("#datadistribuidores").hide();
//           $("#contenidoFormularioRegistroCompra").show();
            $(".cancelarRC").show();
            $(".nuevoRegistroCompra").hide();
              
      
  }
  
  function clickCancelarRegistroCompra(){
        
         $(".delete").hide();
         $(".modificar").hide();
         
         $(".guardar").hide();
         $(".cancelar").hide();
         
          $("#guardarModificacion").hide();
         $("#cancelarModificacion").hide();
          $(".insertar").show();  
            $("#totalRC").val(0);
            
            $("#datadistribuidores").show();
       
            $(".cancelarRC").hide();
            $(".nuevoRegistroCompra").hide();
               $("#botonesInsercion").hide();  
               $(".totalRC").hide();
               location.reload();
      
  }   
  
  
  function formatRepo2 (data) {
            console.log(data);
            if(data.nombres){
                var markup = "<div class='select2-result-repository clearfix'>" +
                             "<div class='select2-result-repository__meta'>" +
                             "<div class='select2-result-repository__title'>" + data.codigo + " - " + data.nombres + "</div>" +
                             "</div></div>";
            } else {
                var markup = "Busque un cliente";
            }

            return markup;
        }

        function formatRepoSelection2 (data) {
            if(data.nombres){
                return data.codigo + " - " + data.nombres + " " + data.apellido;
            } else {
                return "Seleccione un cliente";
            }   
        }
