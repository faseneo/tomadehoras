      //funcion para validar campos del formulario
        function validarFormulario(){
            var txtCodAtt = document.getElementById('codatt').value;
            var txtDescCodAtt = document.getElementById('desccodatt').value;
                //Test campo obligatorio
                if(txtCodAtt == null || txtCodAtt.length == 0){
                    alert('ERROR: El campo Código de Atención no debe ir vacío o con espacios en blanco');
                    document.getElementById('codatt').focus();
                    return false;
                }
                if(txtDescCodAtt == null || txtDescCodAtt.length == 0){
                    alert('ERROR: El campo Descripción Código de Atención no debe ir vacío o con espacios en blanco');
                    document.getElementById('desccodatt').focus();
                    return false;
                }                
                return true;
            }

    $(document).ready(function(){
      // implementacion boton para guardar el código de atención
        $("#enviar").click(function(e){
            e.preventDefault();
            $("#Accion").val("registrar");
            console.log("paso");
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
                    /*if ( console && console.log ) {
                        console.log( " data success : "+ data.success 
                            + " \n data msg : "+ data.message 
                            + " \n textStatus : " + textStatus
                            + " \n jqXHR.status : " + jqXHR.status );
                    }*/
                    $('#myModalLittle').modal('show');
                    $('#myModalLittle').on('shown.bs.modal', function () {
                        var modal2 = $(this);
                        modal2.find('.modal-title').text('Mensaje');
                        modal2.find('.msg').html('<b>' + data.message + '</b>');  
                        $('#cerrarModalLittle').focus();
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
        });
    });