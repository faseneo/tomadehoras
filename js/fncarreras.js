        function deshabilitabotones(){
            document.getElementById('editar-carrera').style.display = 'none';
            document.getElementById('guardar-carrera').style.display = 'none';
            document.getElementById('actualizar-carrera').style.display = 'none';
        }
        function limpiaform(){
            $("#carrId").val("");
            $("#carrCod").val("");
            $("#carrNom").val("");
            $("#carrFacId").val("");
        }        
        function habilitaform(){
            $("#carrId").prop( "disabled", false );
            $("#carrCod").prop( "disabled", false );
            $("#carrNom").prop( "disabled", false );
            $("#carrFacId").prop( "disabled", false );
        }
        function deshabilitaform(){
            $("#carrId").prop( "disabled", true );
            $("#carrCod").prop( "disabled", true );
            $("#carrNom").prop( "disabled", true );
            $("#carrFacId").prop( "disabled", true );
        }

    $(document).ready(function(){
        function validarFormulario(){
            var txtCodigo = document.getElementById('carrCod').value;
            var txtNombre = document.getElementById('carrNom').value;
            var txtFacId = document.getElementById('carrFacId').value;
                //Test campo obligatorio
                if(txtCodigo == null || txtCodigo.length == 0 || /^\s+$/.test(txtCodigo)){
                    alert('ERROR: El campo codigo no debe ir vacío o con espacios en blanco');
                    document.getElementById('carrCod').focus();
                    return false;
                }    
                if(txtNombre == null || txtNombre.length == 0 || /^\s+$/.test(txtNombre)){
                    alert('ERROR: El campo nombre no debe ir vacío o con espacios en blanco');
                    document.getElementById('carrNom').focus();
                    return false;
                }
                if(txtFacId == null || txtFacId.length == 0 || /^\s+$/.test(txtFacId)){
                    alert('ERROR: El campo facultad Id no debe ir vacío o con espacios en blanco');
                    document.getElementById('carrFacId').focus();
                    return false;
                }               
            return true;
        }         
        deshabilitabotones();

        var getlista = function (){
            var datax = {
                "Accion":"listar"
            }
            $.ajax({
                data: datax, 
                type: "GET",
                dataType: "json", 
                url: "../controllers/controllerscarreras.php", 
            })
            .done(function( data, textStatus, jqXHR ) {
                $("#listacarreras").html("");
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                for(var i=0; i<data.datos.length;i++){
                                console.log('id: '+data.datos[i].carr_id + ' nombre: '+data.datos[i].carr_nom);

                                fila = '<tr  class="listacarreras"><td>'+ data.datos[i].carr_nom +'</td>';
                                fila += '<td>'+ data.datos[i].carr_cod +'</td>';
                                fila += '<td>'+ data.datos[i].carr_facul_id +'</td>';

                                fila += '<td><button id="ver-carrera" type="button" '
                                fila += 'class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"'
                                fila += ' onclick="verCarrera(\'ver\',\'' + data.datos[i].carr_id + '\')">';
                                fila += 'Ver / Editar</button>';
                                fila += ' <button id="delete-language-modal" name="delete-language-modal" type="button" ';
                                fila += 'class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModalDelete" ';
                                fila += 'onclick="deleteCarrera(\''+ data.datos[i].carr_id +'\',\''
                                + data.datos[i].carr_nom +'\')">';
                                fila += 'Eliminar</button></td>';
                                fila += '</tr>';
                                $("#listacarreras").append(fila);
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

        //Levanta modal nuevo
        $("#crea-carrera").click(function(e){
            e.preventDefault();
            limpiaform();
            habilitaform();
            $("#Accion").val("registrar");
            $('#myModal').on('shown.bs.modal', function () {
                var modal = $(this);
                modal.find('.modal-title-form').text('Creación Carrera');  
                deshabilitabotones();
                $('#guardar-carrera').show();
                $('#carrNom').focus();
            });
        });

        // implementacion boton para guardar
        $("#guardar-carrera").click(function(e){
            e.preventDefault();
            if(validarFormulario()==true){
                var datax = $("#formCarrera").serializeArray();
                $.each(datax, function(i, field){
                    console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                });
                $.ajax({
                    data: datax, 
                    type: "POST",
                    dataType: "json", 
                    url: "../controllers/controllerscarreras.php", 
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
                        modal2.find('.modal-title').text('Mensaje del Servidor');
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
        $("#editar-carrera").click(function(e){
            e.preventDefault();
            $('.modal-title-form').text('Editar Carrera');
            habilitaform();
            deshabilitabotones();
            $('#actualizar-carrera').show();
            $("#Accion").val("actualizar");               
        });

        //  envia los nuevos datos para actualizar
        $("#actualizar-carrera").click(function(e){
                    // Detenemos el comportamiento normal del evento click sobre el elemento clicado
                    e.preventDefault();
                    if(validarFormulario()==true){
                        var datax = $("#formCarrera").serializeArray();
                        /*   $.each(datax, function(i, field){
                            console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });*/
                        $.ajax({
                            data: datax,    // En data se puede utilizar un objeto JSON, un array o un query string
                            type: "POST",   //Cambiar a type: POST si necesario
                            dataType: "json",  // Formato de datos que se espera en la respuesta
                            url: "../controllers/controllerscarreras.php",  // URL a la que se enviará la solicitud Ajax
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
        $("#eliminar-carrera").click(function(e){
            e.preventDefault();
            console.log("paso");
            var datax = $("#formDeleteCarrera").serializeArray();

            console.log("paso2");

                    $.each(datax, function(i, field){
                        console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                    });
                console.log("paso3");
                    $.ajax({
                        data: datax, 
                        type: "POST",
                        dataType: "json", 
                        url: "../controllers/controllerscarreras.php",
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
    //funcion levanta modal y muestra  los datos de Facultad cuando presion boton Ver/Editar, aca se puede modificar si quiere
    function verCarrera(action, carreraid){
        deshabilitabotones();
        var datay = {"carrId": carreraid,
                     "Accion":"obtener"
                    };
        $.ajax({
            data: datay, 
            type: "POST",
            dataType: "json", 
            url: "../controllers/controllerscarreras.php",
        })
        .done(function(data,textStatus,jqXHR ) {
            if ( console && console.log ) {
                console.log( " data success : "+ data.success 
                    + " \n data msg : "+ data.message 
                    + " \n textStatus : " + textStatus
                    + " \n jqXHR.status : " + jqXHR.status );
            }
            $("#carrId").val(data.datos.carr_id);
            $("#carrCod").val(data.datos.carr_cod);
            $("#carrNom").val(data.datos.carr_nom);
            $("#carrFacId").val(data.datos.carr_facul_id);

            deshabilitaform();
            $("#Accion").val(action);

            $('#myModal').on('shown.bs.modal', function () {
                var modal = $(this);
                if (action === 'actualizar'){
                    modal.find('.modal-title-form').text('Actualizar Carrera');
                    $('#guardar-carrera').hide();                    
                    $('#actualizar-carrera').show();   
                }else if (action === 'ver'){
                    modal.find('.modal-title-form').text('Datos Carrera');
                    deshabilitabotones();
                    $('#editar-carrera').show();   
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
    // Funcion que levanta modal para eliminar
    function deleteCarrera(idcarrera, nameCarrera){     
        document.formDeleteCarrera.carrId.value = idcarrera;
        document.formDeleteCarrera.nameCarrera.value = nameCarrera;
        document.formDeleteCarrera.Accion.value = "eliminar";
        $('#myModalDelete').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
    }