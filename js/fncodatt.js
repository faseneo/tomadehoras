    function deshabilitabotones(){
        document.getElementById('editar-codatt').style.display = 'none';
        document.getElementById('guardar-codatt').style.display = 'none';
        document.getElementById('actualizar-codatt').style.display = 'none';
    }
       function limpiaform(){
        $("#codatt").val("");
        $("#descodatt").val("");
        $("#codattid").val("");
    }        
    function habilitaform(){
        $("#codattid").prop( "disabled", false );
        $("#descodatt").prop( "disabled", false );
        $("#codatt").prop( "disabled", false );
    }
    function deshabilitaform(){
        $("#codattid").prop( "disabled", true );
        $("#codatt").prop( "disabled", true );
        $("#descodatt").prop( "disabled", true );
    }
    //funcion para validar campos del formulario
    function validarFormulario() {
        var txtCodAtt = document.getElementById('codatt').value;
        var txtDescCodAtt = document.getElementById('desccodatt').value;
        //Test campo obligatorio
        if (txtCodAtt == null || txtCodAtt.length == 0) {
            alert('ERROR: El campo Código de Atención no debe ir vacío o con espacios en blanco');
            document.getElementById('codatt').focus();
            return false;
        }
        if (txtDescCodAtt == null || txtDescCodAtt.length == 0) {
            alert('ERROR: El campo Descripción Código de Atención no debe ir vacío o con espacios en blanco');
            document.getElementById('desccodatt').focus();
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
                    url: "../controllers/controllercodatencion.php", 
                })
                .done(function( data, textStatus, jqXHR ) {
                    $("#listacodatt").html("");
                    if ( console && console.log ) {
                        console.log( " data success : "+ data.success 
                            + " \n data msg : "+ data.message 
                            + " \n textStatus : " + textStatus
                            + " \n jqXHR.status : " + jqXHR.status );
                    }
                    for(var i=0; i<data.datos.length;i++){
                                    $.each(data.datos[i], function(k, v) { console.log(k + ' : ' + v); });
                                    console.log('id: '+data.datos[i].codatencion_id + ' codigo: '+data.datos[i].codatencion_codigo+ ' observacion: '+data.datos[i].codatencion_obs);

                                    fila = '<tr><td>'+ data.datos[i].codatencion_codigo +'</td>';
                                    fila += '<td>'+ data.datos[i].codatencion_obs +'</td>';
                                    fila += '<td><button id="ver-codatt" type="button" '
                                    fila += 'class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"'
                                    fila += ' onclick="verCodatt(\'ver\',\'' + data.datos[i].codatencion_id + '\')">';
                                    fila += 'Ver / Editar</button>';
                                    fila += ' <button id="delete-language-modal" name="delete-language-modal" type="button" ';
                                    fila += 'class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModalDelete" ';
                                    fila += 'onclick="deleteCodatt(\''+ data.datos[i].codatencion_id +'\',\''
                                    + data.datos[i].codatencion_codigo +'\')">';
                                    fila += 'Eliminar</button></td>';
                                    fila += '</tr>';
                                    $("#listacodatt").append(fila);
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
            $("#crea-codatt").click(function(e){
                e.preventDefault();
                limpiaform();
                habilitaform();
                $("#Accion").val("registrar");
                $('#myModal').on('shown.bs.modal', function () {
                    var modal = $(this);
                    modal.find('.modal-title-form').text('Creación Código de Atención');  
                    deshabilitabotones();
                    $('#guardar-codatt').show();
                    $('#codatt').focus();
                });
            });
            // implementacion boton para guardar el Código de Atención
            $("#guardar-codatt").click(function(e){
                e.preventDefault();
                if(validarFormulario()==true){
                    var datax = $("#formcodatt").serializeArray();
                    /*$.each(datax, function(i, field){
                        console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                    });*/
                    $.ajax({
                        data: datax, 
                        type: "POST",
                        dataType: "json", 
                        url: "../controllers/controllercodatencion.php", 
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
            $("#editar-codatt").click(function(e){
                e.preventDefault();
                $('.modal-title-form').text('Editar Código de Atención');
                habilitaform();
                deshabilitabotones();
                $('#actualizar-codatt').show();
                $("#Accion").val("actualizar");               
            });
            //  envia los nuevos datos para actualizar
            $("#actualizar-codatt").click(function(e){
                e.preventDefault();
                    if(validarFormulario()==true){
                        var datax = $("#formcodatt").serializeArray();
                        $.each(datax, function(i, field){
                         console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                           $.ajax({
                                   data: datax,    // En data se puede utilizar un objeto JSON, un array o un query string
                                   type: "POST",   //Cambiar a type: POST si necesario
                                   dataType: "json",  // Formato de datos que se espera en la respuesta
                                   url: "../controllers/controllercodatencion.php",  // URL a la que se enviará la solicitud Ajax
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
            $("#eliminar-codatt").click(function(e){
                e.preventDefault();
                console.log("paso");
                var datax = $("#formDeleteCodatt").serializeArray();

                console.log("paso2");

                        $.each(datax, function(i, field){
                            console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                    console.log("paso3");
                        $.ajax({
                            data: datax, 
                            type: "POST",
                            dataType: "json", 
                            url: "../controllers/controllercodatencion.php",
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
        function verCodatt(action, codattid){
            deshabilitabotones();
            var datay = {"id": codattid,
                         "Accion":"obtener"
                        };
            $.ajax({
                data: datay, 
                type: "POST",
                dataType: "json", 
                url: "../controllers/controllercodatencion.php",
            })
            .done(function(data,textStatus,jqXHR ) {
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                $("#codattid").val(data.datos.codatencion_id);
                $("#codatt").val(data.datos.codatencion_nombre);
                $("#descodatt").val(data.datos.codatencion_obs);

                deshabilitaform();
                $("#Accion").val(action);

                $('#myModal').on('shown.bs.modal', function () {
                    var modal = $(this);
                    if (action === 'actualizar'){
                        modal.find('.modal-title-form').text('Actualizar Código de Atención');
                        $('#guardar-codatt').hide();                    
                        $('#actualizar-codatt').show();   
                    }else if (action === 'ver'){
                        modal.find('.modal-title-form').text('Datos Código de Atención');
                        deshabilitabotones();
                        $('#editar-codatt').show();   
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
        function deleteCodatt(codattid, codatt){     
            document.formDeleteCodatt.codattid.value = codattid;
            document.formDeleteCodatt.codatt.value = codatt;
            document.formDeleteCodatt.Accion.value = "eliminar";  
            $('#myModalDelete').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });
    }   
//funcion para registrar un nuevo alumno
/*$(document).ready(function() {
    // implementacion boton para guardar el código de atención
    $("#guardar-codatt").click(function(e) {
        e.preventDefault();
        $("#Accion").val("registrar");
        console.log("paso");
        if (validarFormulario() == true) {
            var datax = $("#formcodatt").serializeArray();
            /*$.each(datax, function(i, field){
                console.log("contenido del form = "+ field.name + ":" + field.value + " ");
            });
            $.ajax({
                    data: datax,
                    type: "POST",
                    dataType: "json",
                    url: "../controllers/controllercodatencion.php",
                })
                .done(function(data, textStatus, jqXHR) {
                    if ( console && console.log ) {
                        console.log( " data success : "+ data.success 
                            + " \n data msg : "+ data.message 
                            + " \n textStatus : " + textStatus
                            + " \n jqXHR.status : " + jqXHR.status );
                        }
                    $('#myModalLittle').modal('show');
                    $('#myModalLittle').on('shown.bs.modal', function() {
                        var modal2 = $(this);
                        modal2.find('.modal-title').text('Mensaje');
                        modal2.find('.msg').html('<b>' + data.message + '</b>');
                        $('#cerrarModalLittle').focus();
                    });
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {
                        console.log(" La solicitud ha fallado,  textStatus : " + textStatus +
                            " \n errorThrown : " + errorThrown +
                            " \n textStatus : " + textStatus +
                            " \n jqXHR.status : " + jqXHR.status);
                    }
                });
        }
    });
});*/