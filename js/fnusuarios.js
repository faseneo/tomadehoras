function deshabilitabotones(){
        document.getElementById('editar-usuarios').style.display = 'none';
        document.getElementById('guardar-usuarios').style.display = 'none';
        document.getElementById('actualizar-usuarios').style.display = 'none';
    }
       function limpiaform(){
        $("#username").val("");
        $("#password").val("");
        $("#rol").val("");
        $("#estado").val("");
    }       
       function habilitaform(){
        $("#username").prop( "disabled", false );
        $("#password").prop( "disabled", false );
        $("#rol").prop( "disabled", false );
        $("#estado").prop( "disabled", false );
    }
    function deshabilitaform(){
        $("#username").prop( "disabled", true );
        $("#password").prop( "disabled", true );
        $("#rol").prop( "disabled", true );
        $("#estado").prop( "disabled", true );
    }
    //funcion para validar campos del formulario
    function validarFormulario() {
        var txtmotivoatt = document.getElementById('motivoatt').value;
        var txtmotivoatttestado = document.getElementById('motivoattestado').value;
        //Test campo obligatorio
        if (txtmotivoatt == null || txtmotivoatt.length == 0) {
            alert('ERROR: El campo Motivo de Atención no debe ir vacío o con espacios en blanco');
            document.getElementById('motivoatt').focus();
            return false;
        }
        if (txtmotivoatttestado == null || txtmotivoatttestado.length == 0) {
            alert('ERROR: El campo Estado Motivo de Atención no debe ir vacío o con espacios en blanco');
            document.getElementById('txtmotivoatttestado').focus();
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
                    url: "../controllers/controllerusuarios.php", 
                })
                .done(function( data, textStatus, jqXHR ) {
                    $("#listausuarios").html("");
                    if ( console && console.log ) {
                        console.log( " data success : "+ data.success 
                            + " \n data msg : "+ data.message 
                            + " \n textStatus : " + textStatus
                            + " \n jqXHR.status : " + jqXHR.status );
                    }
                    for(var i=0; i<data.datos.length;i++){
                                    $.each(data.datos[i], function(k, v) { console.log(k + ' : ' + v); });
                                    console.log('Username: '+data.datos[i].usu_username + ' Password: '+data.datos[i].usu_password+ ' Estado: '+data.datos[i].usu_estado+ ' Rol: '+data.datos[i].usu_rol_nombre);

                                    var state = "";
                                    state = data.datos[i].usu_estado == 0 ? "Inactivo":"Activo"; //Operador ternario reemplaza if else

                                    fila = '<tr><td>'+ data.datos[i].usu_username +'</td>';
                                    fila += '<td>'+ data.datos[i].usu_rol_nombre +'</td>';
                                    fila += '<td>'+ state +'</td>';
                                    fila += '<td><button id="ver-usuarios" type="button" '
                                    fila += 'class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"'
                                    fila += ' onclick="verusuarios(\'ver\',\'' + data.datos[i].usu_username + '\')">';
                                    fila += 'Ver / Editar</button>';
                                    fila += ' <button id="delete-language-modal" name="delete-language-modal" type="button" ';
                                    fila += 'class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModalDelete" ';
                                    fila += 'onclick="deleteUsuarios(\''+ data.datos[i].usu_username +'\',\''
                                    + data.datos[i].usu_username +'\')">';
                                    fila += 'Eliminar</button></td>';
                                    fila += '</tr>';
                                    $("#listausuarios").append(fila);
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
            $("#crea-motivoatt").click(function(e){
                e.preventDefault();
                limpiaform();
                habilitaform();
                $("#Accion").val("registrar");
                $('#myModal').on('shown.bs.modal', function () {
                    var modal = $(this);
                    modal.find('.modal-title-form').text('Creación Motivo de Atención');  
                    deshabilitabotones();
                    $('#guardar-motivoatt').show();
                    $('#motivoatt').focus();
                });
            });
            // implementacion boton para guardar la forma de Atención
            $("#guardar-motivoatt").click(function(e){
                e.preventDefault();
                if(validarFormulario()==true){
                    var datax = $("#formmotivoatt").serializeArray();
                    /*$.each(datax, function(i, field){
                        console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                    });*/
                    $.ajax({
                        data: datax, 
                        type: "POST",
                        dataType: "json", 
                        url: "../controllers/controllermotivoatencion.php", 
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
            $("#editar-motivoatt").click(function(e){
                e.preventDefault();
                $('.modal-title-form').text('Editar Motivo de Atención');
                habilitaform();
                deshabilitabotones();
                $('#actualizar-motivoatt').show();
                $("#Accion").val("actualizar");               
            });
            //  envia los nuevos datos para actualizar
            $("#actualizar-motivoatt").click(function(e){
                e.preventDefault();
                    if(validarFormulario()==true){
                        var datax = $("#formmotivoatt").serializeArray();
                        $.each(datax, function(i, field){
                         console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                           $.ajax({
                                   data: datax,    // En data se puede utilizar un objeto JSON, un array o un query string
                                   type: "POST",   //Cambiar a type: POST si necesario
                                   dataType: "json",  // Formato de datos que se espera en la respuesta
                                   url: "../controllers/controllermotivoatencion.php",  // URL a la que se enviará la solicitud Ajax
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
            $("#eliminar-motivoatt").click(function(e){
                e.preventDefault();
                console.log("paso");
                var datax = $("#formDeleteMotivoatt").serializeArray();

                console.log("paso2");

                        $.each(datax, function(i, field){
                            console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                    console.log("paso3");
                        $.ajax({
                            data: datax, 
                            type: "POST",
                            dataType: "json", 
                            url: "../controllers/controllermotivoatencion.php",
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
        function vermotivoatt(action, motivoattid){
            deshabilitabotones();
            var datay = {"motivoattid": motivoattid, //Faltaba nombre asignado al id de codigo atencion en el controller
                         "Accion":"obtener"
                        };
            $.ajax({
                data: datay, 
                type: "POST",
                dataType: "json", 
                url: "../controllers/controllermotivoatencion.php",
            })
            .done(function(data,textStatus,jqXHR ) {
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                // cambio en nombre de campo codigo y nombre de input  de  obs
                $("#motivoattid").val(data.datos.motivoatencion_id);
                $("#motivoatt").val(data.datos.motivoatencion_texto);
                $("#motivoattestado").val(data.datos.motivoatencion_estado);

                deshabilitaform();
                $("#Accion").val(action);

                $('#myModal').on('shown.bs.modal', function () {
                    var modal = $(this);
                    if (action === 'actualizar'){
                        modal.find('.modal-title-form').text('Actualizar Motivo de Atención');
                        $('#guardar-motivoatt').hide();                    
                        $('#actualizar-motivoatt').show();   
                    }else if (action === 'ver'){
                        modal.find('.modal-title-form').text('Datos Motivo de Atención');
                        deshabilitabotones();
                        $('#editar-motivoatt').show();   
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
        function deleteMotivoatt(motivoattid, motivoatt){     
            document.formDeleteMotivoatt.motivoattid.value = motivoattid;
            document.formDeleteMotivoatt.motivoatt.value = motivoatt;
            document.formDeleteMotivoatt.Accion.value = "eliminar";  
            $('#myModalDelete').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });
    } 