    function deshabilitabotones(){
        document.getElementById('editar-formaatt').style.display = 'none';
        document.getElementById('guardar-formaatt').style.display = 'none';
        document.getElementById('actualizar-formaatt').style.display = 'none';
    }
       function limpiaform(){
        $("#formaatt").val("");
        $("#formaattestado").val("");
        $("#formaattid").val("");
    }        
    function habilitaform(){
        $("#formaattid").prop( "disabled", false );
        $("#formaattestado").prop( "disabled", false );
        $("#formaatt").prop( "disabled", false );
    }
    function deshabilitaform(){
        $("#formaattid").prop( "disabled", true );
        $("#formaatt").prop( "disabled", true );
        $("#formaattestado").prop( "disabled", true );
    }
    //funcion para validar campos del formulario
    function validarFormulario() {
        var txtformaatt = document.getElementById('formaatt').value;
        var txtformaattestado = document.getElementById('formaattestado').value;
        //Test campo obligatorio
        if (txtformaatt == null || txtformaatt.length == 0) {
            alert('ERROR: El campo Forma de Atención no debe ir vacío o con espacios en blanco');
            document.getElementById('formaatt').focus();
            return false;
        }
        if (txtformaattestado == null || txtformaattestado.length == 0) {
            alert('ERROR: El campo Estado Forma de Atención no debe ir vacío o con espacios en blanco');
            document.getElementById('txtformaattestado').focus();
            return false;
        }
        return true;
    }
        $(document).ready(function(){
            //funcion para listar los Códigos de Atención
            var getlista = function (){
                var datax = {
                    "Accion":"listar"
                }
                $.ajax({
                    data: datax, 
                    type: "GET",
                    dataType: "json", 
                    url: "../controllers/controllerformaatencion.php", 
                })
                .done(function( data, textStatus, jqXHR ) {
                    $("#listaformaatt").html("");
                    if ( console && console.log ) {
                        console.log( " data success : "+ data.success 
                            + " \n data msg : "+ data.message 
                            + " \n textStatus : " + textStatus
                            + " \n jqXHR.status : " + jqXHR.status );
                    }
                    for(var i=0; i<data.datos.length;i++){
                                    $.each(data.datos[i], function(k, v) { console.log(k + ' : ' + v); });
                                    console.log('id: '+data.datos[i].formaatencion_id + ' Forma Atencion: '+data.datos[i].formaatencion_texto+ ' Estado: '+data.datos[i].formaatencion_estado);

                                    fila = '<tr><td>'+ data.datos[i].formaatencion_texto +'</td>';
                                    fila += '<td>'+ data.datos[i].formaatencion_estado +'</td>';
                                    fila += '<td><button id="ver-formaatt" type="button" '
                                    fila += 'class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"'
                                    fila += ' onclick="verformaatt(\'ver\',\'' + data.datos[i].formaatencion_id + '\')">';
                                    fila += 'Ver / Editar</button>';
                                    fila += ' <button id="delete-language-modal" name="delete-language-modal" type="button" ';
                                    fila += 'class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModalDelete" ';
                                    fila += 'onclick="deleteFormaatt(\''+ data.datos[i].formaatencion_id +'\',\''
                                    + data.datos[i].formaatencion_texto +'\')">';
                                    fila += 'Eliminar</button></td>';
                                    fila += '</tr>';
                                    $("#listaformaatt").append(fila);
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
            //Levanta modal nuevo Código de Atención
            $("#crea-formaatt").click(function(e){
                e.preventDefault();
                limpiaform();
                habilitaform();
                $("#Accion").val("registrar");
                $('#myModal').on('shown.bs.modal', function () {
                    var modal = $(this);
                    modal.find('.modal-title-form').text('Creación Forma de Atención');  
                    deshabilitabotones();
                    $('#guardar-formaatt').show();
                    $('#formaatt').focus();
                });
            });
            // implementacion boton para guardar la forma de Atención
            $("#guardar-formaatt").click(function(e){
                e.preventDefault();
                if(validarFormulario()==true){
                    var datax = $("#formformaatt").serializeArray();
                    /*$.each(datax, function(i, field){
                        console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                    });*/
                    $.ajax({
                        data: datax, 
                        type: "POST",
                        dataType: "json", 
                        url: "../controllers/controllerformaatencion.php", 
                    })
                    .done(function( data, textStatus, jqXHR ) {
                        if ( console && console.log ) {
                            console.log( " data success : "+ data.success 
                                + " \n data msg : "+ data.message 
                                + " \n textStatus : " + textStatus
                                + " \n jqXHR.status : " + jqXHR.status );
                        }
                        $('#myModal').modal('hide');
                        $('#myModalLittle').modal('show');
                        $('#myModalLittle').on('shown.bs.modal', function () {
                            var modal2 = $(this);
                            modal2.find('.modal-title').text('Mensaje');
                            modal2.find('.msg').text(data.message);  
                            $('#cerrarModalLittle').focus();
                        });
                        getlista();
                        deshabilitabotones();
                    })
                    .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                            console.log( " La solicitud ha fallado,  textStatus : " +  textStatus 
                                + " \n errorThrown : "+ errorThrown
                                + " \n textStatus : " + textStatus
                                + " \n jqXHR.status : " + jqXHR.status );
                        }
                    });
                }
            });
            //Cambia boton y habilita form para actualizar
            $("#editar-formaatt").click(function(e){
                e.preventDefault();
                $('.modal-title-form').text('Editar Forma de Atención');
                habilitaform();
                deshabilitabotones();
                $('#actualizar-formaatt').show();
                $("#Accion").val("actualizar");               
            });
            //  envia los nuevos datos para actualizar
            $("#actualizar-formaatt").click(function(e){
                e.preventDefault();
                    if(validarFormulario()==true){
                        var datax = $("#formformaatt").serializeArray();
                        $.each(datax, function(i, field){
                         console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                           $.ajax({
                                   data: datax,    // En data se puede utilizar un objeto JSON, un array o un query string
                                   type: "POST",   //Cambiar a type: POST si necesario
                                   dataType: "json",  // Formato de datos que se espera en la respuesta
                                   url: "../controllers/controllerformaatencion.php",  // URL a la que se enviará la solicitud Ajax
                            })
                            .done(function( data, textStatus, jqXHR ) {
                                if ( console && console.log ) {
                                    console.log( " data success : "+ data.success 
                                    + " \n data msg : "+ data.message 
                                    + " \n textStatus : " + textStatus
                                    + " \n jqXHR.status : " + jqXHR.status );
                                }
                                   $('#myModal').modal('hide');
                                   $('#myModalLittle').modal('show');
                                   $('#myModalLittle').on('shown.bs.modal', function () {
                                        var modal2 = $(this);
                                        modal2.find('.modal-title').text('Mensaje');
                                        modal2.find('.msg').text(data.message);
                                        $('#cerrarModalLittle').focus();                                
                                    });
                                    getlista();
                                    deshabilitabotones();
                                })
                                .fail(function( jqXHR, textStatus, errorThrown ) {
                                    if ( console && console.log ) {
                                        console.log( " La solicitud ha fallado,  textStatus : " +  textStatus 
                                            + " \n errorThrown : "+ errorThrown
                                            + " \n textStatus : " + textStatus
                                            + " \n jqXHR.status : " + jqXHR.status );
                                    }
                                });                        
                            }
                        });
            // Envia los datos para eliminar
            $("#eliminar-formaatt").click(function(e){
                e.preventDefault();
                console.log("paso");
                var datax = $("#formDeleteFormaatt").serializeArray();

                console.log("paso2");

                        $.each(datax, function(i, field){
                            console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                    console.log("paso3");
                        $.ajax({
                            data: datax, 
                            type: "POST",
                            dataType: "json", 
                            url: "../controllers/controllerformaatencion.php",
                        })
                        .done(function(data,textStatus,jqXHR ) {
                            if ( console && console.log ) {
                                console.log( " data success : "+ data.success 
                                    + " \n data msg : "+ data.message 
                                    + " \n textStatus : " + textStatus
                                    + " \n jqXHR.status : " + jqXHR.status );
                            }
                            $('#myModalDelete').modal('hide');
                            $('#myModalLittle').modal('show');
                            $('#myModalLittle').on('shown.bs.modal', function () {
                                var modal2 = $(this);
                                modal2.find('.modal-title').text('Mensaje');
                                modal2.find('.msg').text(data.message);
                                $('#cerrarModalLittle').focus();                                
                            });
                            getlista(); 
                        })
                        .fail(function( jqXHR, textStatus, errorThrown ) {
                            if ( console && console.log ) {
                                console.log( " La solicitud ha fallado,  textStatus : " +  textStatus 
                                    + " \n errorThrown : "+ errorThrown
                                    + " \n textStatus : " + textStatus
                                    + " \n jqXHR.status : " + jqXHR.status );
                            }
                        });
                    });
            deshabilitabotones();
            getlista();
        });
        //funcion levanta modal y muestra  los datos del centro de costo cuando presion boton Ver/Editar, aca se puede mdificar si quiere
        function verformaatt(action, formaattid){
            deshabilitabotones();
            var datay = {"formaattid": formaattid, //Faltaba nombre asignado al id de codigo atencion en el controller
                         "Accion":"obtener"
                        };
            $.ajax({
                data: datay, 
                type: "POST",
                dataType: "json", 
                url: "../controllers/controllerformaatencion.php",
            })
            .done(function(data,textStatus,jqXHR ) {
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                // cambio en nombre de campo codigo y nombre de input  de  obs
                $("#formaattid").val(data.datos.formaatencion_id);
                $("#formaatt").val(data.datos.formaatencion_texto);
                $("#formaattestado").val(data.datos.formaatencion_estado);

                deshabilitaform();
                $("#Accion").val(action);

                $('#myModal').on('shown.bs.modal', function () {
                    var modal = $(this);
                    if (action === 'actualizar'){
                        modal.find('.modal-title-form').text('Actualizar Forma de Atención');
                        $('#guardar-formaatt').hide();                    
                        $('#actualizar-formaatt').show();   
                    }else if (action === 'ver'){
                        modal.find('.modal-title-form').text('Datos Forma de Atención');
                        deshabilitabotones();
                        $('#editar-formaatt').show();   
                    }

                });
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                    console.log( " La solicitud ha fallado,  textStatus : " +  textStatus 
                        + " \n errorThrown : "+ errorThrown
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
            });
        }
        // Funcion que levanta modal para eliminar centro de costo 
        function deleteFormaatt(formaattid, formaatt){     
            document.formDeleteFormaatt.formaattid.value = formaattid;
            document.formDeleteFormaatt.formaatt.value = formaatt;
            document.formDeleteFormaatt.Accion.value = "eliminar";  
            $('#myModalDelete').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });
    } 