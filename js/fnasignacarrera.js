function obtenerasignados( persona_dae_id){
            var datax = {
                "Accion":"listar_asignados",
                "persona_dae_id": persona_dae_id
            }
            $.ajax({
                data: datax, 
                type: "GET",
                dataType: "json", 
                url: "../controllers/controllerasignacarrera.php", 
            })
            .done(function( data, textStatus, jqXHR ) {
                $("#destinationFields").html("");
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                for(var i=0; i<data.datos.length;i++){
                                console.log('id: '+data.datos[i].carr_id + ' nombre: '+data.datos[i].carr_nom);

                                //fila = '<li id="'+data.datos[i].carr_id+'">'+data.datos[i].carr_cod+'</li>';
                                fila = '<div class="fc-field" id="'+data.datos[i].carr_id+'">'+data.datos[i].carr_cod+'</div>';
                                $("#destinationFields").append(fila);
                            }
                        })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                    console.log( " La solicitud getlista ha fallado,  textStatus : " +  textStatus 
                        + " \n errorThrown : "+ errorThrown
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
            });
}

var getlistacarreras = function (){
            var datax = {
                "Accion":"listar_car_disp"
            }
            $.ajax({
                data: datax, 
                type: "GET",
                dataType: "json", 
                url: "../controllers/controllerscarreras.php", 
            })
            .done(function( data, textStatus, jqXHR ) {
                $("#sourceFields").html("");
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                for(var i=0; i<data.datos.length;i++){
                                console.log('id: '+data.datos[i].carr_id + ' nombre: '+data.datos[i].carr_nom);

                                //fila = '<li id="'+data.datos[i].carr_id+'">'+data.datos[i].carr_cod+'</li>';
                                fila = '<div class="fc-field" id="'+data.datos[i].carr_id+'">'+data.datos[i].carr_cod+'</div>';
                                $("#sourceFields").append(fila);
                            }
                        })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                    console.log( " La solicitud getlista ha fallado,  textStatus : " +  textStatus 
                        + " \n errorThrown : "+ errorThrown
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
            });
        }

var getlistaasistentes = function (){
            var datax = {
                "Accion":"listar_asistentes"
            }
            $.ajax({
                data: datax, 
                type: "GET",
                dataType: "json", 
                url: "../controllers/controllerusuarios.php",
            })
            .done(function( data, textStatus, jqXHR ) {
                $("#asistentes").html("");
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                for(var i=0; i<data.datos.length;i++){
                                console.log('id: '+data.datos[i].usu_dae_id + ' nombre: '+data.datos[i].usu_username);

                                //fila = '<li id="'+data.datos[i].carr_id+'">'+data.datos[i].carr_cod+'</li>';
                                fila = '<option value="'+data.datos[i].usu_dae_id+'">'+data.datos[i].usu_username+'</option>';
                                $("#asistentes").append(fila);
                            }
                        })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                    console.log( " La solicitud getlista ha fallado,  textStatus : " +  textStatus 
                        + " \n errorThrown : "+ errorThrown
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
            });
        }

$(document).ready(function() {
    getlistacarreras();
    getlistaasistentes();
    obtenerasignados(4);

    $('#asistentes').change(function(){
        var idusu = $('#asistentes').val();
        obtenerasignados(idusu);
    });


   $("#guardar-asignacion").click(function(e){
                    var carrerasDisponibles = $("#sourceFields");
                    //var carrerasAsignadas = $("#destinationFields");
                    var chooser = $("#fieldChooser").fieldChooser(carrerasDisponibles, carerrasAsignadas);
                    e.preventDefault();
                        var datax = $("#destinationFields").serializeArray();
                        $.each(datax, function(i, field){

                            //console.log("contenido de los div = "+ field.name + ":" + field.value + " ");
                            console.log(chooser);
                        });

                        /*$.ajax({
                            data: datax, 
                            type: "POST",
                            dataType: "json", 
                            url: "../controllers/controllerasignacarrera.php", 
                        })
                        .done(function( data, textStatus, jqXHR ) {
                            if ( console && console.log ) {
                                console.log( " data success : "+ data.success 
                                    + " \n data msg : "+ data.message 
                                    + " \n textStatus : " + textStatus
                                    + " \n jqXHR.status : " + jqXHR.status );
                            }
                            getlistacarreras();
                            getlistaasistentes();
                            //obtenerasignados(4);
                        })
                        .fail(function( jqXHR, textStatus, errorThrown ) {
                            if ( console && console.log ) {
                                console.log( " La solicitud ha fallado,  textStatus : " +  textStatus 
                                    + " \n errorThrown : "+ errorThrown
                                    + " \n textStatus : " + textStatus
                                    + " \n jqXHR.status : " + jqXHR.status );
                            }
                        });*/
                   
                });

});
