 $(document).ready(function(){


     
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


     
       $(document).on("click",".verPDF",function() {
           var idDetalle =$(this).attr("id");
          
           
               var url=Routing.generate('verFactura',{idDetalle: idDetalle});

                                        window.open(url,"_blank"); 

       });
     
     
      $(document).on("click",".verExcel",function() {
           var idDetalle =$(this).attr("id");

           
               var url=Routing.generate('verExcel',{idDetalle: idDetalle});

                                        window.open(url,"_self"); 
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
                return data.codigo + " - " + data.nombres;
            } else {
                return "Seleccione un cliente";
            }   
        }
