 $(document).ready(function(){
 var tipoEnvio;
 var tipoEnvioE;

    tipoEnvio= $("#idTipoEnvio").val();
    tipoEnvioE= $("#idTipoEnvioE").val();
    $(document).on("change","#idTipoEnvio",function() {
      var x;

      x=  $(this).val(); 
      tipoEnvio=x;
      if (x==1) {
         $("#hora").show();
       $("#fecha").show();
      }else{
         $("#hora").hide();
       $("#fecha").hide();
      }    

      

    });

//En la edicion
    $(document).on("change","#idTipoEnvioE",function() {
      var x;

      x=  $(this).val(); 
      tipoEnvioE=x;
      if (x==1) {
         $("#horaE").show();
       $("#fechaE").show();
      }else{
         $("#horaE").hide();
       $("#fechaE").hide();
      }    

      

    });

            $('#horaEnvio').datetimepicker({
                            use24hours: true,
                            pickDate: false,
                          format: 'hh:mm'
                             
                          });
             

    $('#txtFechaEnvio').Zebra_DatePicker({
                format: 'Y-m-d',
               direction:true,
           });
 //Evento donde se envia a guardar los datos del formulario de los mensajes
    $(document).on("click","#nuevoM",function() {

      if (tipoEnvio==1) {
             var idRestaurante,titulo,texto,horaEnvio,fechaEnvio;
             
               idRestaurante=$("#idRestaurante").val();
               titulo=$("#titulo").val();
               texto=$("#texto").val();
               horaEnvio= $("#horaEnvio").data("date");
               fechaEnvio = $('#txtFechaEnvio').val();
                            

                   var num=0;
                  
                  
                 $('.requerido').each( function (){
                         
                         var x=$(this).val();
              
                         if(x==""){
                          // var y = $(this).attr("id");
                          //   $("#"+y).focus();
                             num=num+1;
                         }

                       });
           
               
      if (num==0 ){
                           
                      $.ajax({
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {idRestaurante:idRestaurante,titulo:titulo,texto:texto,
                                      horaEnvio:horaEnvio,fechaEnvio:fechaEnvio},
                                    url: Routing.generate('insertar_mensaje'),
                                    success: function (data)
                                    {
                                         if (data.estado==true){
                                          
                                        swal({
                                            title: "Exito!",
                                            text: "Datos guardados exitosamente",
                                            timer: 1500,
                                            type: 'success',
                                            showConfirmButton: false
                                          });
                                          
                                            setTimeout( function(){ 
                                            var url=Routing.generate('listaMensajes');
                                            window.open(url,"_self"); 
                                         }  , 1000 );
                                        
                                        
                                             
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
             
              swal("Error!", "No debes dejar campos ruqueridos vacios", "error");
         }

 }else{ //En el caso que sea dos, entonces es un no programado, osea que quiere enviarse en el instante


               var idRestaurante,titulo,texto;
             
               idRestaurante=$("#idRestaurante").val();
               titulo=$("#titulo").val();
               texto=$("#texto").val();

                   var num=0;
                  
                  
                 $('.requerido').each( function (){
                         
                         var x=$(this).val();
              
                         if(x==""){
                          // var y = $(this).attr("id");
                          //   $("#"+y).focus();
                             num=num+1;
                         }

                       });
           
               
      if (num==0 ){
                           
                      $.ajax({
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {idRestaurante:idRestaurante,titulo:titulo,texto:texto},
                                    url: Routing.generate('insertar_and_enviar_mensaje'),
                                    success: function (data)
                                    {
                                         if (data.estado==true){
                                          
                                        swal({
                                            title: "Exito!",
                                            text: "Datos almacenados y enviados exitosamente",
                                            timer: 1500,
                                            type: 'success',
                                            showConfirmButton: false
                                          });
                                          
                                            setTimeout( function(){ 
                                            var url=Routing.generate('listaMensajes');
                                            window.open(url,"_self"); 
                                         }  , 1000 );
                                        
                                        
                                             
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
             
              swal("Error!", "No debes dejar campos ruqueridos vacios", "error");
         }


 }




});
 
 
 
     
 $(document).on("click","#guardarMoMen",function() {


  if (tipoEnvioE==1) {
      var idRestaurante,titulo,texto,horaEnvio,fechaEnvio,idMensajes;
              idMensajes=$("#idMensajes").val();

               idRestaurante=$("#idRestaurante").val();
               titulo=$("#titulo").val();
               texto=$("#texto").val();
               horaEnvio= $("#horaEnvio").data("date");
               fechaEnvio = $('#txtFechaEnvio').val();
            var num=0;
                     
               
     $('.requeridoE').each( function (){
                       
                       var x=$(this).val();
            
                       if(x==""){
                           num=num+1;
                       }

                       });
           
               
                       if (num==0){

                     $.ajax({
              
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {idMensajes:idMensajes,idRestaurante:idRestaurante,titulo:titulo,texto:texto,
                                      horaEnvio:horaEnvio,fechaEnvio:fechaEnvio},
                                    url: Routing.generate('editar_mensaje_action'),
                                    success: function (data)
                                    {
                                         if (data.estado==true){
                                             
                                             swal({
                                            title: "Exito!",
                                            text: "Datos modificados exitosamente",
                                            timer: 1500,
                                            type: 'success',
                                            showConfirmButton: false
                                          });
                                          
                                            setTimeout( function(){ 
                                            var url=Routing.generate('listaMensajes');
                                            window.open(url,"_self"); 
                                         }  , 1000 );
                                            
    
                                         }
                                         else{
                                             
                                                Lobibox.notify("error", {
                                          size: 'mini',
                                          msg: 'Error al insertar los datos, espere un momento'
                                      });
                                            location.reload();
                                            
                                             
                                         }
                                        
                                             
                    
                                         
                                          
                                    },
                                    error: function (xhr, status)
                                    {
                      
                    }
            });

 }else{
     
       swal("Error!", "Los datos requeridos no puede ir vacios", "error");
 }
        
         
  
  }else{//En el caso de que el tipo de envio sea en el momento al editar


    var idRestaurante,titulo,textoidMensajes;
              idMensajes=$("#idMensajes").val();

               idRestaurante=$("#idRestaurante").val();
               titulo=$("#titulo").val();
               texto=$("#texto").val();
              
            var num=0;
                     
               
     $('.requeridoE').each( function (){
                       
                       var x=$(this).val();
            
                       if(x==""){
                           num=num+1;
                       }

                       });
           
               
                       if (num==0){

                     $.ajax({
              
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {idMensajes:idMensajes,idRestaurante:idRestaurante,titulo:titulo,texto:texto},
                                    url: Routing.generate('editar_mensaje_and_send_action'),
                                    success: function (data)
                                    {
                                         if (data.estado==true){
                                             
                                             swal({
                                            title: "Exito!",
                                            text: "Datos modificados y enviados exitosamente",
                                            timer: 1500,
                                            type: 'success',
                                            showConfirmButton: false
                                          });
                                          
                                            setTimeout( function(){ 
                                            var url=Routing.generate('listaMensajes');
                                            window.open(url,"_self"); 
                                         }  , 1000 );
                                            
    
                                         }
                                         else{
                                             
                                                Lobibox.notify("error", {
                                          size: 'mini',
                                          msg: 'Error al insertar los datos, espere un momento'
                                      });
                                            location.reload();
                                            
                                             
                                         }
                                        
                                             
                    
                                         
                                          
                                    },
                                    error: function (xhr, status)
                                    {
                      
                    }
            });

 }else{
     
       swal("Error!", "Los datos requeridos no puede ir vacios", "error");
 }
        



  }


});
  $(document).on("click","#cancelarEdicionCliente",function() {
      
       var url=Routing.generate('admin_cliente_index');
                                            window.open(url,"_self"); 
      
  });    
     
   $(document).on("click","#cancelarNuevoCliente",function() {
      
       var url=Routing.generate('admin_cliente_index');
                                            window.open(url,"_self"); 
      
  });  
  
  



$('#idRestaurante').select2({
                ajax: {
                    url: Routing.generate('buscarRestaurante'),
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
                            obj.id = obj.idRestaurante;
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
//                templateSelection: formatRepoSelection,
                formatInputTooShort: function () {
                    return "Ingrese un caracter para la busqueda";
                }
            });



 });
 
 
 function formatRepo (data) {
            if(data.nombre){
                var markup = "<div class='select2-result-repository clearfix'>" +
                             "<div class='select2-result-repository__meta'>" +
                             "<div class='select2-result-repository__title'>" + data.nombre+ "</div>" +
                             "</div></div>";
            } 
            return markup;
        }

        function formatRepoSelection (data) {
            if(data.nombre){
                return  data.nombre;
            } else {
                return "Seleccione un restaurante";
            }   
        }

