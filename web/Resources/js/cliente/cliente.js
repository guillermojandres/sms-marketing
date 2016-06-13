 $(document).ready(function(){
     
  var permisoCorreo =false;
     
  $(document).on("input",".correo",function() {

       var email = $(this).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
        if (email==""){
         
                 $(".msg").hide();
                   $(".error").hide();      
                   
     }else if (re.test(email)) {
            $('.msg').hide();
            $('.success').show();
            permisoCorreo=true;
        } else {
            $('.msg').hide();
            $('.error').show();
            permisoCorreo=false;
        }
       
     
  });        
           
          
           
           
         $('.telefono').mask('0000-0000', {placeholder: "0000-0000"});
         $('#nitCP').mask('0000-000000-000-0', {placeholder: "0000-000000-000-0"});
         $('#nrcCP').mask('000000-0', {placeholder: "000000-0"});
     
         
     
         $(document).on("click","#nuevoCp",function() {
             
             
             
             
             var nombre, direccion,telefono,telefonoM,nrc,nit,correoElectronico,paginaWeb,descripcion,referidoPor,contactoId,categoria,credito;
             
             nombre=$("#nombreCp").val();
               categoria= $("#tipoCliente").val();
               
               credito =  $("input[name='credito']:checked").val();
               direccion=$("#direccionCp").val();
               telefono=$("#telefonoCp").val();
               telefonoM=$("#telefonoMCp").val();
               nrc=$("#nrcCP").val();
               nit=$("#nitCP").val();
               correoElectronico=$("#correoCp").val();
               paginaWeb=$("#paginaWebCp").val();
               descripcion=$("#descripcionCp").val();
               referidoPor=$("#referidoPor").val();
               contactoId=$("#contactoDirecto").val();
               

                   var num=0;
                  
                  
                 $('.requerido').each( function (){
                       
                       var x=$(this).val();
            
                       if(x==""){
                           num=num+1;
                       }

                       });
           
               
      if (num==0 ){
                           
                      if (correoElectronico=="" || permisoCorreo==true)
                      {
                      $.ajax({
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {credito:credito,categoria:categoria,nombre:nombre,direccion:direccion,telefono:telefono,telefonoM:telefonoM,nrc:nrc,
                                     nit:nit,correoElectronico:correoElectronico,paginaWeb:paginaWeb,descripcion:descripcion,referidoPor:referidoPor,contactoId:contactoId},
                                    url: Routing.generate('insertarcliente'),
                                    success: function (data)
                                    {
                                         if (data.estado==true){
                                          
                                         swal("Exito!", "Cliente registrado con exito", "success");
                                         var url=Routing.generate('admin_cliente_index');
                                            window.open(url,"_self"); 
                                        
                                             
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
             swal("Error!", "Direccion de correo electonico no valido", "error");
        }
   }else{
             
              swal("Error!", "No debes dejar campos ruqueridos vacios", "error");
         }

 });
 
 
 
     
 $(document).on("click","#editarCliente",function() {
      var idCliente,nombre, direccion,telefono,telefonoM,nrc,nit,correoElectronico,paginaWeb,descripcion,referidoPor,contactoId,categoria,credito;
              
               idCliente=$("#idCliente").val();
               categoria= $("#tipoCliente").val();
               credito =  $("input[name='credito']:checked").val();
               nombre=$("#nombreCp").val();
               direccion=$("#direccionCp").val();
               telefono=$("#telefonoCp").val();
               telefonoM=$("#telefonoMCp").val();
               nrc=$("#nrcCP").val();
               nit=$("#nitCP").val();
               correoElectronico=$("#correoCp").val();
               paginaWeb=$("#paginaWebCp").val();
               descripcion=$("#descripcionCp").val();
               referidoPor=$("#referidoPor").val();
               contactoId=$("#contactoDirecto").val();
         
     
     var num=0;       
               
     $('.requeridoE').each( function (){
                       
                       var x=$(this).val();
            
                       if(x==""){
                           num=num+1;
                       }

                       });
           
               
                       if (num==0){
               
                 if (correoElectronico=="" || permisoCorreo==true)
                      {
        
          $.ajax({
              
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {credito:credito,categoria:categoria,idCliente:idCliente,nombre:nombre,direccion:direccion,telefono:telefono,telefonoM:telefonoM,nrc:nrc,
                                     nit:nit,correoElectronico:correoElectronico,paginaWeb:paginaWeb,descripcion:descripcion,referidoPor:referidoPor,contactoId:contactoId},
                                    url: Routing.generate('editarcliente'),
                                    success: function (data)
                                    {
                                         if (data.estado==true){
                                             
                                         var url=Routing.generate('admin_cliente_index');
                                            window.open(url,"_self"); 
                                        
                                                         
                                            
                                             
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
            swal("Error!", "Direccion de correo electonico no valido", "error");
            
        }

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
  
  
  
  
   $('#contactoDirecto').select2({
                ajax: {
                    url: Routing.generate('buscarContacto'),
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
                return "Seleccione contacto";
            }   
        }


