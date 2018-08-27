    function deshabilitabotones(){
        document.getElementById('editar-usuarios').style.display = 'none';
        document.getElementById('guardar-usuarios').style.display = 'none';
        document.getElementById('actualizar-usuarios').style.display = 'none';
    }
    function limpiaform(){
        $("#username").val("");
        $("#pass").val("");
        //$("#rol").val("");
        //$("#estado").val("");
    }       
    function habilitaform(){
        $("#username").prop( "disabled", false );
        $("#pass").prop( "disabled", false );
        $("#rol").prop( "disabled", false );
        $("#estado").prop( "disabled", false );
    }
    function deshabilitaform(){
        $("#username").prop( "disabled", true );
        $("#pass").prop( "disabled", true );
        $("#rol").prop( "disabled", true );
        $("#estado").prop( "disabled", true );
    }
    //funcion para validar campos del formulario
    function validarFormulario() {
        var txtusername = document.getElementById('username').value;
        var txtpass = document.getElementById('pass').value;
        var selrol = document.getElementById('rol').selectedIndex;
        console.log(selrol);
        var selestado = document.getElementById('estado').selectedIndex;
        console.log(selestado);
        /*Test campo obligatorio*/
        if (txtusername == null || txtusername.length == 0) {
            alert('ERROR: El campo "Nombre de Usuario" no debe ir vacío o con espacios en blanco');
            document.getElementById('username').focus();
            return false;
        }
        if (txtpass == null || txtpass.length == 0) {
            alert('ERROR: El campo "Contraseña" no debe ir vacío o con espacios en blanco');
            document.getElementById('pass').focus();
            return false;
        }
        if (selrol == null || selrol == -1 || isNaN(selrol)) {
            alert('ERROR: Seleccione un Rol');
            document.getElementById('rol').focus();
            return false;
        }
        if (selestado == null || isNaN(selestado) || (selestado < 0 && selestado > 1)) {
            alert('ERROR: Seleccione un Estado');
            document.getElementById('estado').focus();
            return false;
        }
        return true;
    }
    //Datos de Validación para un segundo formulario
    function deshabilitabotones2(){
        console.log("pase por aca");
        document.getElementById('editar-persdae').style.display = 'none';
        document.getElementById('guardar-persdae').style.display = 'none';
        document.getElementById('actualizar-persdae').style.display = 'none';
    }
    function limpiaform2(){
        $("#iddae").val("");
        //$("#usu_id").val("");
        $("#nombres").val("");
        $("#apellidos").val("");
        $("#correo").val("");
        $("#anexo").val("");
    }       
    function habilitaform2(){
        $("#nombres").prop( "disabled", false );
        $("#apellidos").prop( "disabled", false );
        $("#correo").prop( "disabled", false );
        $("#anexo").prop( "disabled", false );
    }
    function deshabilitaform2(){
        $("#nombres").prop( "disabled", true );
        $("#apellidos").prop( "disabled", true );
        $("#correo").prop( "disabled", true );
        $("#anexo").prop( "disabled", true );
    }
    //funcion para validar campos del formulario
    function validarFormulario2() {
        var txtnombres = document.getElementById('nombres').value;
        var txtapellidos = document.getElementById('apellidos').value;
        var txtcorreo = document.getElementById('correo').value;
        var txtanexo = document.getElementById('anexo').value;
        /*Test campo obligatorio*/
        if (txtnombres == null || txtnombres.length == 0) {
            alert('ERROR: El campo "Nombres" no debe ir vacío o con espacios en blanco');
            document.getElementById('nombres').focus();
            return false;
        }
        if (txtapellidos == null || txtapellidos.length == 0) {
            alert('ERROR: El campo "Apellidos" no debe ir vacío o con espacios en blanco');
            document.getElementById('apellidos').focus();
            return false;
        }
        if (txtcorreo == null || txtcorreo.length == 0) {
            alert('ERROR: El campo "Correo" no debe ir vacío o con espacios en blanco');
            document.getElementById('correo').focus();
            return false;
        }
        if (txtanexo == null || txtanexo.length == 0) {
            alert('ERROR: El campo "Anexo" no debe ir vacío o con espacios en blanco');
            document.getElementById('anexo').focus();
            return false;
        }
        return true;
    }
        //permite listar los roles de usuario en el combo box
    function getlistarolusu(){
            var datax = {
                "Accion":"listar"
            }
            $.ajax({
                data: datax, 
                type: "GET",
                dataType: "json", 
                url: "../controllers/controllersrolusuario.php", 
            })
            .done(function( data, textStatus, jqXHR ) {
                $("#rol").html("");
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                //$("#rol").append('<option value="0">- Selecciona un Rol -</option>');
                for(var i=0; i<data.datos.length;i++){
                                console.log('id: '+data.datos[i].rol_usu_id + ' nombre: '+data.datos[i].rol_usu_nom);
                                opcion = '<option value = ';
                                opcion += data.datos[i].rol_usu_id;
                                opcion += data.datos[i].rol_usu_id == 2 ? ' selected':'';
                                opcion += '>'+data.datos[i].rol_usu_nom+'</option>';
                                $("#rol").append(opcion);
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
    getlistarolusu();
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
                                    /*$.each(data.datos[i], function(k, v) { console.log(k + ' : ' + v); });
                                    console.log('Username: '+data.datos[i].usu_username + ' Password: '+data.datos[i].usu_password+ ' Estado: '+data.datos[i].usu_estado+ ' Rol: '+data.datos[i].usu_rol_nombre);*/

                                    var state = "";
                                    state = data.datos[i].usu_estado == 0 ? "Inactivo":"Activo"; //Operador ternario reemplaza if else

                                    fila = '<tr><td>'+ data.datos[i].usu_username +'</td>';
                                    fila += '<td>'+ data.datos[i].usu_rol_nombre +'</td>';
                                    fila += '<td>'+ state +'</td>';
                                    fila += '<td><button id="crea-persdae" type="button" '
                                    fila += 'class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal2"'
                                    fila += ' onclick="verdatos(\'verdatos\',\'' + data.datos[i].usu_id + '\')">';
                                    fila += 'Datos Personales</button>';
                                    fila += ' <button id="ver-usuarios" type="button" '
                                    fila += 'class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"'
                                    fila += ' onclick="verusuarios(\'ver\',\'' + data.datos[i].usu_id + '\')">';
                                    fila += 'Ver / Editar</button>';
                                    fila += ' <button id="delete-language-modal" name="delete-language-modal" type="button" ';
                                    fila += 'class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModalDelete" ';
                                    fila += 'onclick="deleteUsuarios(\''+ data.datos[i].usu_id +'\',\''+ data.datos[i].usu_username +'\')">';
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
        
            //Levanta modal nuevo Usuario
            $("#crea-usuarios").click(function(e){
                e.preventDefault();
                limpiaform();
                habilitaform();
                getlistarolusu();
                $("#Accion").val("registrar");
                $('#myModal').on('shown.bs.modal', function () {
                    var modal = $(this);
                    modal.find('.modal-title-form').text('Creación de Usuario');  
                    deshabilitabotones();
                    $('#guardar-usuarios').show();
                    $('#username').focus();
                });
            });
              // implementacion boton para guardar nuevo usuario
            $("#guardar-usuarios").click(function(e){
                e.preventDefault();
                if(validarFormulario()==true){
                    var datax = $("#formusuarios").serializeArray();
                    /*$.each(datax, function(i, field){
                        console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                    });*/
                    $.ajax({
                        data: datax, 
                        type: "POST",
                        dataType: "json", 
                        url: "../controllers/controllerusuarios.php", 
                    })
                    .done(function( data, textStatus, jqXHR ) {
                        if ( console && console.log ) {
                            console.log( " data success : "+ data.success 
                                + " \n data msg : "+ data.message 
                                + " \n textStatus : " + textStatus
                                + " \n jqXHR.status : " + jqXHR.status );
                        }
                        /*if(data.valida){

                        }*/
                        $('#myModal').modal('hide');
                        $('#myModalLittle').modal('show');
                        $('#myModalLittle').on('shown.bs.modal', function () {
                             modal2.find('.msg').text(""); 
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
            $("#editar-usuarios").click(function(e){
                e.preventDefault();
                $('.modal-title-form').text('Editar Usuarios');
                habilitaform();
                deshabilitabotones();
                $('#actualizar-usuarios').show();
                $("#Accion").val("actualizar");              
            });
            //  envia los nuevos datos para actualizar
            $("#actualizar-usuarios").click(function(e){
                e.preventDefault();
                var datax = $("#formusuarios").serializeArray();
                        $.each(datax, function(i, field){
                         console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                    if(validarFormulario()==true){
                        /*var datax = $("#formusuarios").serializeArray();
                        $.each(datax, function(i, field){
                         console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });*/
                           $.ajax({
                                   data: datax,    // En data se puede utilizar un objeto JSON, un array o un query string
                                   type: "POST",   //Cambiar a type: POST si necesario
                                   dataType: "json",  // Formato de datos que se espera en la respuesta
                                   url: "../controllers/controllerusuarios.php",  // URL a la que se enviará la solicitud Ajax
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
            $("#eliminar-usuarios").click(function(e){
                e.preventDefault();
                console.log("paso");
                var datax = $("#formDeleteUsuarios").serializeArray();

                console.log("paso2");

                        $.each(datax, function(i, field){
                            console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                    console.log("paso3");
                        $.ajax({
                            data: datax, 
                            type: "POST",
                            dataType: "json", 
                            url: "../controllers/controllerusuarios.php",
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
            
             // implementacion boton para guardar la forma de Atención
            $("#guardar-persdae").click(function(e){
                e.preventDefault();
                if(validarFormulario2()==true){
                    var datax = $("#formpersdae").serializeArray();
                    $.each(datax, function(i, field){
                        console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                    });
                    $.ajax({
                        data: datax, 
                        type: "POST",
                        dataType: "json", 
                        url: "../controllers/controllerpersonasdae.php", 
                    })
                    .done(function( data, textStatus, jqXHR ) {
                        if ( console && console.log ) {
                            console.log( " data success : "+ data.success 
                                + " \n data msg : "+ data.message 
                                + " \n textStatus : " + textStatus
                                + " \n jqXHR.status : " + jqXHR.status );
                        }
                        $('#myModal2').modal('hide');
                        $('#myModalLittle').modal('show');
                        $('#myModalLittle').on('shown.bs.modal', function () {
                            var modal2 = $(this);
                            modal2.find('.modal-title').text('Mensaje');
                            modal2.find('.msg').text(data.message);  
                            $('#cerrarModalLittle').focus();
                        });
                        getlista();
                        deshabilitabotones2();
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

            $("#editar-persdae").click(function(e){
                e.preventDefault();
                $('.modal-title-form').text('Editar Usuarios');
                habilitaform2();
                deshabilitabotones2();
                $('#actualizar-persdae').show();
                $("#Acciondae").val("actualizar");              
            });
            $("#actualizar-persdae").click(function(e){
                e.preventDefault();
                var datax = $("#formpersdae").serializeArray();
                        $.each(datax, function(i, field){
                         console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });
                    if(validarFormulario2()==true){
                        /*var datax = $("#formusuarios").serializeArray();
                        $.each(datax, function(i, field){
                         console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });*/
                           $.ajax({
                                   data: datax,    // En data se puede utilizar un objeto JSON, un array o un query string
                                   type: "POST",   //Cambiar a type: POST si necesario
                                   dataType: "json",  // Formato de datos que se espera en la respuesta
                                   url: "../controllers/controllerpersonasdae.php",  // URL a la que se enviará la solicitud Ajax
                            })
                            .done(function( data, textStatus, jqXHR ) {
                                if ( console && console.log ) {
                                    console.log( " data success : "+ data.success 
                                    + " \n data msg : "+ data.message 
                                    + " \n textStatus : " + textStatus
                                    + " \n jqXHR.status : " + jqXHR.status );
                                }
                                   $('#myModal2').modal('hide');
                                   $('#myModalLittle').modal('show');
                                   $('#myModalLittle').on('shown.bs.modal', function () {
                                        var modal2 = $(this);
                                        modal2.find('.modal-title').text('Mensaje');
                                        modal2.find('.msg').text(data.message);
                                        $('#cerrarModalLittle').focus();                                
                                    });
                                    //getlista();
                                    //deshabilitabotones();
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
            deshabilitabotones();
            getlista();
        });
        function verdatos(action, id){
            var datay = {"usu_id": id, //Faltaba nombre asignado al id de codigo atencion en el controller
                         "Acciondae":"obtener"
                        };
            $.ajax({
                data: datay, 
                type: "POST",
                dataType: "json", 
                url: "../controllers/controllerpersonasdae.php",
            })
            .done(function(data,textStatus,jqXHR ) {
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                //console.log('datos : ' + data.datos);
                //console.log('largo : ' + data.datos.length);
                if(data.datos.length != 0){
                    console.log("Hay elemtos");
                    deshabilitabotones2();
                    $('#editar-persdae').show();
                    limpiaform2();
                    deshabilitaform2();

                    $("#usu_id").val(id);
                    $("#iddae").val(data.datos.persdae_id);
                    $("#nombres").val(data.datos.persdae_nombres);
                    $("#apellidos").val(data.datos.persdae_apellidos);
                    $("#correo").val(data.datos.persdae_correo);
                    $("#anexo").val(data.datos.persdae_anexo);

                }else{
                    console.log("No Hay elementos");
                    limpiaform2();
                    habilitaform2();
                    deshabilitabotones2();
                    $('#guardar-persdae').show();
                    $("#usu_id").val(id);
                }

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
        //funcion levanta modal y muestra  los datos del centro de costo cuando presion boton Ver/Editar, aca se puede mdificar si quiere
        function verusuarios(action, id){ 
            limpiaform();//limpio el formulario para que llene los datos con los valores correspondientes
            getlistarolusu();

            //deshabilitabotones();
            var datay = {"id": id, //Faltaba nombre asignado al id de codigo atencion en el controller
                         "Accion":"obtener"
                        };
            $.ajax({
                data: datay, 
                type: "POST",
                dataType: "json", 
                url: "../controllers/controllerusuarios.php",
            })
            .done(function(data,textStatus,jqXHR ) {
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                // cambio en nombre de campo codigo y nombre de input  de  obs
                $("#id").val(data.datos.usu_id);
		        $("#username").val(data.datos.usu_username);
                $("#pass").val(data.datos.usu_password);
                console.log('rol del usuario : ' + data.datos.usu_rol_id);
                $("#rol").val(data.datos.usu_rol_id).prop('selected',true);
		        $("#estado").val(data.datos.usu_estado).prop('selected',true);

                deshabilitaform();
                $("#Accion").val(action);

                $('#myModal').on('shown.bs.modal', function () {
                    var modal = $(this);
                    if (action === 'actualizar'){
                        modal.find('.modal-title-form').text('Actualizar Usuarios');
                        $('#guardar-usuarios').hide();                    
                        $('#actualizar-usuarios').show();   
                    }else if (action === 'ver'){
                        modal.find('.modal-title-form').text('Datos Usuarios');
                        deshabilitabotones();
                        $('#editar-usuarios').show();   
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
        function deleteUsuarios(usu_id, username){ 
            console.log(usu_id);
            console.log(username);
            document.formDeleteUsuarios.usu_id.value = usu_id;    
            document.formDeleteUsuarios.username.value = username;
            document.formDeleteUsuarios.Accion.value = "eliminar";  
            $('#myModalDelete').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });
        } 