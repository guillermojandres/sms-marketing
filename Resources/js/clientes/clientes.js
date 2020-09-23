 $(document).ready(function(){

var fecha =new   Date();
var dia = fecha.getDate();
var mes = fecha.getMonth();
var anho = fecha.getFullYear();

    if (mes<10){
        mes=mes+1;
    }


 var fechaFinal = anho+"-"+"0"+mes+"-"+dia;

  

$('#txtFechaInicio').Zebra_DatePicker({
     format: 'Y-m-d',
    direction: -1,
    pair: $('#txtFechaFin')
});


     
  $('#txtFechaFin').Zebra_DatePicker({
     format: 'Y-m-d',
     direction: [true, fechaFinal]
});   
     

//Ajax que extrae la cantidad de usuarios registrados
$.ajax({
                                    type: 'POST',
                                    async: false,
                                    dataType: 'json',
                                    data: {id:1,idRestaurante:0},
                                    url: Routing.generate('extraer_usuarios'),
                                    success: function (data)
                                    {

                                         if (data.estado==true){ 
                                            $("#cantidadUsuActivos").append("<p style='color: blue; font-size:16px;text-align:right;margin-left: 20px'>"+data.activos[0].numero+"</p>");
                                            $("#cantidadUsuIncactivos").append("<p style='color: blue; font-size:16px;text-align:right;margin-left: 8px'>"+data.inactivos[0].numero+"</p>");
                                        
                                             
                                         }
                                         else{
                                             
                                                swal("Error!", "Error al extraer los datos", "error");
                                                location.reload();
                                            
                                             
                                         }

                                    },
                                    error: function (xhr, status)
                                    {
                      
                    }
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


 //Subida de archivos
     var formData = new FormData();
     $('input[type="file"]').change(function(e){
         var fileName = e.target.files[0].name;
         var file = e.target.files[0];
         formData.append('archivos',file);
         alert('The file "' + fileName +  '" has been selected.');
     });


$(document).on("click","#subirArchivoCliente", function () {
    var idNegocio = $("#idRestaurante").val();
    formData.append('idNegocio',idNegocio);
    $.ajax({
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        dataType: "html",
        data: formData,
        url: Routing.generate('insertarListaCliente'),
        success: function (data)
        {

            var obj= jQuery.parseJSON(data);
            if (obj.estado == true) {
                swal({
                        title: "Exito",
                        text: "Registros de clientes importados exitosamente",
                        type: "success",
                        showCancelButton: true,
                        cancelButtonText: "No",
                        confirmButtonText: "Si",
                        confirmButtonColor: "#11a51e",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            location.reload();


                        } else {

                            var url=Routing.generate('ofertas_index');
                            window.open(url,"_self");

                        }


                    });

            }else{

                Lobibox.notify("success", {
                    size: 'mini',
                    msg: obj.descripcion
                });
            }

        },
        error: function (xhr, status)
        {

        }
    });


});






 //Fin document ready
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

