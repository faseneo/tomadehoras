<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "admheader.php"; ?>    
    <title>Buscador</title>
    <script src="../js/fncodatt.js"></script>
</head>
<body>
    <?php include "admbarranav.php"; ?>
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-md-9">  
                <h2 class="sub-header">Códigos de Atención</h2>
                <div class="table-responsive">
                    <button type="button" id="crea-codatt" class="btn btn-sm btn-primary"
                    data-toggle="modal" data-target="#myModal" >NUEVO</button> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="25%">Código de Atención</th>
                                <th width="50%">Descripción</th>
                                <th width="25%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="listacodatt">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- Fin container-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title-form" id="myModalLabel">Códigos de Atención</h4>
                </div>
                <form role="form" name="formcodatt" id="formcodatt" method="post">
                    <fieldset>
                            <input type="hidden" name="codattid" id="codattid" value="" />
                            <input type="hidden" id="Accion" name="Accion" value="registrar">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="codatt">Código de Atención</label>
                              <input type="text" class="form-control" id="codatt" name="codatt" placeholder="Código de atención">
                              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                          </div>
                            <div class="form-group">
                              <label for="desccodatt">Descripción de Código de Atención</label>
                              <input type="text" class="form-control" id="desccodatt" name="desccodatt" placeholder="Descripción Código de Atención">
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button id="editar-codatt" name="editar-codatt" type="button" class="btn btn-warning">Editar</button>
                            <button id="actualizar-codatt" name="actualizar-codatt" type="button" class="btn btn-primary">Actualizar</button> 
                            <button id="guardar-codatt" name="guardar-codatt" type="button" class="btn btn-primary">Guardar Nuevo Código</button>
                            <button id="cancel" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </fieldset>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
   <!-- Modal DELETE -->
    <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalDeleteLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalDeleteLabel">Eliminación de Código de Atención</h4>
                </div>
                <form role="form" name="formDeleteCodatt" id="formDeleteCodatt" method="post" action="">
                    <input type="hidden" name="codattid" id="codattid" value="" />
                    <input type="hidden" name="Accion" id="Accion" value="" />
                    <div class="modal-body">
                        <div class="input-group">
                            <label for="pregunta">¿Está seguro de eliminar el Código de Atención seleccionado?</label>
                        </div>
                        <div class="input-group">
                            <label for="codatt">Código de Atención</label>
                            <input type="text" class="form-control" id="codatt" name="codatt" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="eliminar-codatt" name="eliminar-codatt" type="button" class="btn btn-primary">Aceptar</button>
                        <button id="cancel" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal mensajes cortos-->
    <div class="modal fade" id="myModalLittle" tabindex="-1" role="dialog" aria-labelledby="myModalLittleLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mensaje</h4>
                </div>
                <div class="modal-body">
                    <p id="msg" class="msg"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cerrarModalLittle" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</body>
</html>