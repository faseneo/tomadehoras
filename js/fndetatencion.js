        function deshabilitabotones(){
            document.getElementById('editar-detatencion').style.display = 'none';
            document.getElementById('guardar-detatencion').style.display = 'none';
            document.getElementById('actualizar-detatencion').style.display = 'none';
        }
        function limpiaform(){
            $("#detAteId").val("");
            $("#detAteTxt").val("");
            $("#detAteEst").val("");
        }        
        function habilitaform(){
            $("#detAteId").prop( "disabled", false );
            $("#detAteTxt").prop( "disabled", false );
            $("#detAteEst").prop( "disabled", false );
        }
        function deshabilitaform(){
            $("#detAteId").prop( "disabled", true );
            $("#detAteTxt").prop( "disabled", true );
            $("#detAteEst").prop( "disabled", true );
        }

    $(document).ready(function(){
        function validarFormulario(){
            var txtTexto = document.getElementById('detAteTxt').value;
            var txtEstado = document.getElementById('detAteEst').value;
                //Test campo obligatorio
                if(txtTexto == null || txtTexto.length == 0 || /^\s+$/.test(txtTexto)){
                    alert('ERROR: El campo texto no debe ir vacío o con espacios en blanco');
                    document.getElementById('detAteTxt').focus();
                    return false;
                }    
                if(txtEstado == null || txtEstado.length == 0 || /^\s+$/.test(txtEstado)){
                    alert('ERROR: El campo estado no debe ir vacío o con espacios en blanco');
                    document.getElementById('txtEstado').focus();
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
                url: "../controllers/controllersdetatencion.php", 
            })
            .done(function( data, textStatus, jqXHR ) {
                $("#listadetatencion").html("");
                if ( console && console.log ) {
                    console.log( " data success : "+ data.success 
                        + " \n data msg : "+ data.message 
                        + " \n textStatus : " + textStatus
                        + " \n jqXHR.status : " + jqXHR.status );
                }
                for(var i=0; i<data.datos.length;i++){
                                console.log('id: '+data.datos[i].det_ate_id + ' texto: '+data.datos[i].det_ate_texto);

                                fila = '<tr  class="listadetatencion"><td>'+ data.datos[i].det_ate_texto +'</td>';
                                fila += '<td>'+ data.datos[i].det_ate_estado +'</td>';

                                fila += '<td><button id="ver-detatencion" type="button" '
                                fila += 'class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"'
                                fila += ' onclick="verDetAtencion(\'ver\',\'' + data.datos[i].det_ate_id + '\')">';
                                fila += 'Ver / Editar</button>';
                                fila += ' <button id="delete-language-modal" name="delete-language-modal" type="button" ';
                                fila += 'class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModalDelete" ';
                                fila += 'onclick="deleteDetAtencion(\''+ data.datos[i].det_ate_id +'\',\''
                                + data.datos[i].det_ate_texto +'\')">';
                                fila += 'Eliminar</button></td>';
                                fila += '</tr>';
                                $("#listadetatencion").append(fila);
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
        $("#crea-detatencion").click(function(e){
            e.preventDefault();
            limpiaform();
            habilitaform();
            $("#Accion").val("registrar");
            $('#myModal').on('shown.bs.modal', function () {
                var modal = $(this);
                modal.find('.modal-title-form').text('Creación Detalle Atencion');  
                deshabilitabotones();
                $('#guardar-detatencion').show();
                $('#detAteTxt').focus();
            });
        });

        // implementacion boton para guardar
        $("#guardar-detatencion").click(function(e){
            e.preventDefault();
            if(validarFormulario()==true){
                var datax = $("#formDetAtencion").serializeArray();
                $.each(datax, function(i, field){
                    console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                });
                $.ajax({
                    data: datax, 
                    type: "POST",
                    dataType: "json", 
                    url: "../controllers/controllersdetatencion.php", 
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
        $("#editar-detatencion").click(function(e){
            e.preventDefault();
            $('.modal-title-form').text('Editar Detalle Atencion');
            habilitaform();
            deshabilitabotones();
            $('#actualizar-detatencion').show();
            $("#Accion").val("actualizar");               
        });

        //  envia los nuevos datos para actualizar
        $("#actualizar-detatencion").click(function(e){
                    // Detenemos el comportamiento normal del evento click sobre el elemento clicado
                    e.preventDefault();
                    if(validarFormulario()==true){
                        var datax = $("#formDetAtencion").serializeArray();
                        /*   $.each(datax, function(i, field){
                            console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                        });*/
                        $.ajax({
                            data: datax,    // En data se puede utilizar un objeto JSON, un array o un query string
                            type: "POST",   //Cambiar a type: POST si necesario
                            dataType: "json",  // Formato de datos que se espera en la respuesta
                            url: "../controllers/controllersdetatencion.php",  // URL a la que se enviará la solicitud Ajax
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
        $("#eliminar-detatencion").click(function(e){
            e.preventDefault();
            console.log("paso");
            var datax = $("#formDeleteDetAtencion").serializeArray();

            console.log("paso2");

                    $.each(datax, function(i, field){
                        console.log("contenido del form = "+ field.name + ":" + field.value + " ");
                    });
                console.log("paso3");
                    $.ajax({
                        data: datax, 
                        type: "POST",
                        dataType: "json", 
                        url: "../controllers/controllersdetatencion.php",
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
    function verDetAtencion(action, detatencionid){
        deshabilitabotones();
        var datay = {"detAteId": detatencionid,
                     "Accion":"obtener"
                    };
        $.ajax({
            data: datay, 
            type: "POST",
            dataType: "json", 
            url: "../controllers/controllersdetatencion.php",
        })
        .done(function(data,textStatus,jqXHR ) {
            if ( console && console.log ) {
                console.log( " data success : "+ data.success 
                    + " \n data msg : "+ data.message 
                    + " \n textStatus : " + textStatus
                    + " \n jqXHR.status : " + jqXHR.status );
            }
            $("#detAteId").val(data.datos.det_ate_id);
            $("#detAteTxt").val(data.datos.det_ate_texto);
            $("#detAteEst").val(data.datos.det_ate_estado);

            deshabilitaform();
            $("#Accion").val(action);

            $('#myModal').on('shown.bs.modal', function () {
                var modal = $(this);
                if (action === 'actualizar'){
                    modal.find('.modal-title-form').text('Actualizar Detalle Atencion');
                    $('#guardar-detatencion').hide();                    
                    $('#actualizar-detatencion').show();   
                }else if (action === 'ver'){
                    modal.find('.modal-title-form').text('Datos Detalle Atencion');
                    deshabilitabotones();
                    $('#editar-detatencion').show();   
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
    function deleteDetAtencion(iddetatencion, nameDetAtencion){     
        document.formDeleteDetAtencion.detAteId.value = iddetatencion;
        document.formDeleteDetAtencion.nameDetAtencion.value = nameDetAtencion;
        document.formDeleteDetAtencion.Accion.value = "eliminar";
        $('#myModalDelete').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
    }