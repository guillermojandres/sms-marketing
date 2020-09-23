 $(document).ready(function(){

       
     
         
     
         $(document).on("click","#nuevoI",function() {
             
             
             
             
             var idRestaurante,serie,incentivo;
             
             idRestaurante=$("#idRestaurante").val();
  
               serie=$("#serie").val();
               incentivo=$("#incentivo").val();
                            

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
                                    data: {idRestaurante:idRestaurante,incentivo:incentivo,serie:serie},
                                    url: Routing.generate('insertar_identificador'),
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
                                            var url=Routing.generate('listaIdentificadores');
                                            window.open(url,"_self"); 
                                         }  , 1000 );
                                        
                                        
                                             
                                         }else if(data.estado==0){
                                          swal("Error!", "¡¡¡No puede ingresar una serie ya existente!!", "error");

                                         }else{
                                             
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

 });
 
 
 
     
 $(document).on("click","#editarI",function() {
      var idRestaurante,serie,incentivo,idIdentificador;
             idIdentificador= $("#idIdentificador").val();
             idRestaurante=$("#idRestaurante").val();
               serie=$("#serieE").val();
               incentivo=$("#incentivoE").val();
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
                                    data: {idRestaurante:idRestaurante,incentivo:incentivo,serie:serie,idIdentificador:idIdentificador},
                                    url: Routing.generate('editar_identificadores_action'),
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
                                            var url=Routing.generate('listaIdentificadores');
                                            window.open(url,"_self"); 
                                         }  , 1000 );
                                            
    
                                         }else if(data.estado==0){
                                          swal("Error!", "¡¡¡No puede ingresar una serie ya existente!!", "error");

                                         }else{
                                             
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

