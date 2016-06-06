 $(document).ready(function(){
    inicioPantalla();

     
     $('#busqueda-cliente').select2({
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
                templateResult: formatRepo,
                templateSelection: formatRepoSelection,
                formatInputTooShort: function () {
                    return "Enter 1 Character";
                }
            });
            
             $('#busqueda-clienteE').select2({
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
                templateResult: formatRepo,
                templateSelection: formatRepoSelection,
                formatInputTooShort: function () {
                    return "Enter 1 Character";
                }
            });
     
 $(document).on("click","#guardarAbono", function(){


     
     
                        var num=0;
                $('.requeridoInsercion').each( function (){
            
                       var x=$(this).val();
            
                       if(x==""){
                           num=num+1;
                       }

                       });
           
               
                if (num==0){ 
                   var fechaRegistroCliente= $('#txtFechaInicio').val();
                    var idCliente = $('#busqueda-cliente').val();
                     var montoAbono= $('#montoAbono').val();
                     
                   
                   
                    
                    
                          $.ajax({
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {fechaRegistroCliente:fechaRegistroCliente,idCliente:idCliente,
                                    montoAbono:montoAbono},
                                    url: Routing.generate('insertarAbono'),
                                    success: function (data)
                                    {
                                         if (data.estado==true){
                                          
                                          swal({
                                                    title: "Datos  ingresados con exito",
                                                    text: "¿Quieres seguir ingresando mas registros de abonos?",
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
                                                                    $("#txtFechaInicio").val("");
                                                                    $("#montoAbono").val("");

                                                                    location.reload();
                            
                                      
                                                            } else {
                                                                    var url=Routing.generate('admin_contabilidad_index');
                                                                window.open(url,"_self"); 

                                                            }
                                                        });
                                            
                                             
                                         }
                                         else 
                                             if(data.estado==false){
                                             swal("Error!", "No puedes ingresar un abono mayor al total de la deuda", "error");
                                         }
                                         else{
                                             
                                                swal("Error!", "Error al ingresar los datos", "error");
                                            location.reload();
                                            
                                             
                                         }
                                        
                                             
                    
                                         
                                          
                                    },
                                    error: function (xhr, status)
                                    {
                      
                    }
            });
                   
                   
                
                }else{
                    
                    
                    swal("Error!", "No debe dejar datos vacios a la hora de guardar", "error");
                }
            
       
            
            
  });
  
  
  
  
   $(document).on("click","#guardarEdicion", function(){
         var num=0;
                $('.requeridoEdicion').each( function (){
            
                       var x=$(this).val();
            
                       if(x=="" || x==null){
                           num=num+1;
                       }

                       });
           
               
                if (num==0){ 
                     var fechaRegistroCliente= $('#txtFechaInicioE').val();
                    var idCliente = $('#busqueda-clienteE').val();
                     var montoAbono= $('#montoAbonoE').val();
                       var idDetalle=$('#idDetalleRe').val();
                 $.ajax({
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {fechaRegistroCliente:fechaRegistroCliente,idCliente:idCliente,
                                    montoAbono:montoAbono,idDetalle:idDetalle},
                                    url: Routing.generate('editarAbono'),
                                    success: function (data)
                                    {
                                         if (data.estado==true){
                                          
                                          swal({
                                                    title: "Datos  modificados con exito",
                                                    text: "¿Quieres seguir modificando registros de abonos?",
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
                                                                    
                                                                    location.reload();
                            
                                      
                                                            } else {
                                                                    var url=Routing.generate('admin_contabilidad_index');
                                                                window.open(url,"_self"); 

                                                            }
                                                        });
                                            
                                             
                                         }
                                         else 
                                             if(data.estado==false){
                                             swal("Error!", "No puedes ingresar un abono mayor al total de la deuda", "error");
                                         }
                                         else{
                                             
                                                swal("Error!", "Error al ingresar los datos", "error");
                                            location.reload();
                                            
                                             
                                         }
                                        
                                             
                    
                                         
                                          
                                    },
                                    error: function (xhr, status)
                                    {
                      
                    }
            });
                   
                   
                
                }else{
                    
                    
                    swal("Error!", "No debe dejar datos vacios a la hora de guardar la edicion", "error");
                }
            
     
       
       
       
   });
     
 
 $('#txtFechaInicioE').Zebra_DatePicker({
     format: 'Y-m-d'
});    
     

$('#txtFechaInicio').Zebra_DatePicker({
     format: 'Y-m-d',
    direction: false,
    pair: $('#txtFechaFin')
});


     
  $('#txtFechaFin').Zebra_DatePicker({
     format: 'Y-m-d',
     direction: false
});   
     
       $(document).on("click",".verPDFAbono",function() {
           var idDetalle =$(this).attr("id");
      
           
          var url=Routing.generate('verPDFRegistroAbono',{idDetalle: idDetalle});

                                        window.open(url,"_blank"); 

       });

     
 });

function formatRepo (data) {
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

        function formatRepoSelection (data) {
            if(data.nombres){
                return data.codigo + " - " + data.nombres + " " + data.apellido;
            } else {
                return "Seleccione un cliente";
            }   
        }
function inicioPantalla(){
 $('#nuevoAbono').hide();
  $('#contenidoMonto').hide();
   $('#deudaContenido').hide();
   $('#fechaRegistro').hide();
    $('#cancelarAbono').hide();
      $('#guardarAbono').hide();
       $('#contenidoEdicionAbono').hide();
        $('#guardarEdicion').hide();                       
               
                                         

}

