 $(document).ready(function(){

  var permisoCorreo;
  var valor = $("#correoR").val();

    if (valor!=" "){
        permisoCorreo=true;
        
    }else{
        permisoCorreo=false;
    }
   
  
     
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
           
          
          
     
         
     
         $(document).on("click","#nuevoR",function() {
             
             
             
             
             var numeroTwillio, nombre, direccion,telefono,telefonoM,nrc,nit,correoElectronico,paginaWeb,descripcion,referidoPor,contactoId,categoria,credito;
             
             nombre=$("#nombreR").val();
  
               direccion=$("#direccionR").val();
               telefono=$("#telefonoR").val();
               correoElectronico=$("#correoR").val();
               contactoR=$("#contactoR").val();
               numeroTwillio=$("#numeroTwillioR").val();
               

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
                           
                      if (correoElectronico=="" || permisoCorreo==true)
                      {
                      $.ajax({
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {numeroTwillio:numeroTwillio,nombre:nombre,direccion:direccion,telefono:telefono,
                                     correoElectronico:correoElectronico,contactoR:contactoR},
                                    url: Routing.generate('insertar_restaurante'),
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
                                            var url=Routing.generate('listaRestaurantes');
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
             swal("Error!", "Direccion de correo electonico no valido", "error");
        }
   }else{
             
              swal("Error!", "No debes dejar campos ruqueridos vacios", "error");
         }

 });
 
 
 
     
 $(document).on("click","#editarRestaurante",function() {
      var idRestaurante,nombre, direccion,telefono,correoElectronico,contactoR;
               idRestaurante=$("#idRestaurante").val();
               nombre=$("#nombreR").val();
               direccion=$("#direccionR").val();
               telefono=$("#telefonoR").val();
               correoElectronico=$("#correoR").val();
               contactoR=$("#contactoR").val();
                numeroTwillio=$("#numeroTwillioRR").val();
         
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
                                    data: {numeroTwillio:numeroTwillio,idRestaurante:idRestaurante,nombre:nombre,direccion:direccion,telefono:telefono,
                                     correoElectronico:correoElectronico,contactoR:contactoR},
                                    url: Routing.generate('editar_restaurante_action'),
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
                                            var url=Routing.generate('listaRestaurantes');
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
  
  




 });

