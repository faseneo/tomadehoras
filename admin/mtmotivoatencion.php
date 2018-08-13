<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "admheader.php"; ?>    
    <title>Buscador</title>
    <script src="../js/fnmotivoatt.js"></script>
</head>
<body>
    <?php include "admbarranav.php"; ?>
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-md-9">  
                <h2 class="sub-header">Motivo de Atención</h2>
                <div class="table-responsive">
                    <button type="button" id="crea-motivoatt" class="btn btn-sm btn-primary"
                    data-toggle="modal" data-target="#myModal" >NUEVO</button> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="25%">Motivo de Atención</th>
                                <th width="50%">Estado</th>
                                <th width="25%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="listamotivoatt">
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
                    <h4 class="modal-title-form" id="myModalLabel">Motivo de Atención</h4>
                </div>
                <form role="form" name="formmotivoatt" id="formmotivoatt" method="post">
                    <fieldset>
                            <input type="hidden" name="motivoattid" id="motivoattid" value="" />
                            <input type="hidden" id="Accion" name="Accion" value="registrar">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="motivoatt">Motivo de Atención</label>
                              <input type="text" class="form-control" id="motivoatt" name="motivoatt" placeholder="Motivo de Atención">
                          </div>
                            <div class="form-group">
                              <label for="motivoattestado">Estado</label>
                                <select class="form-control" name="motivoattestado" id="motivoattestado">
                                    <option value="">- Selecciona un Estado -</option>
                                    <option value="1">Activo</option>
                                    <option value="0">No Activo</option>
                                </select>
                              <!-- <input type="text" class="form-control" id="formaattestado" name="formaattestado" placeholder="Estado"> -->
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button id="editar-motivoatt" name="editar-motivoatt" type="button" class="btn btn-warning">Editar</button>
                            <button id="actualizar-motivoatt" name="actualizar-motivoatt" type="button" class="btn btn-primary">Actualizar</button> 
                            <button id="guardar-motivoatt" name="guardar-motivoatt" type="button" class="btn btn-primary">Guardar Nuevo</button>
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
                    <h4 class="modal-title" id="myModalDeleteLabel">Eliminación de Motivo de Atención</h4>
                </div>
                <form role="form" name="formDeleteMotivoatt" id="formDeleteMotivoatt" method="post" action="">
                    <input type="hidden" name="motivoattid" id="motivoattid" value="" />
                    <input type="hidden" name="Accion" id="Accion" value="" />
                    <div class="modal-body">
                        <div class="input-group">
                            <label for="pregunta">¿Está seguro de eliminar el Motivo de Atención seleccionado?</label>
                        </div>
                        <div class="input-group">
                            <label for="motivoatt">Motivo de Atención</label>
                            <input type="text" class="form-control" id="motivoatt" name="motivoatt" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="eliminar-motivoatt" name="eliminar-motivoatt" type="button" class="btn btn-primary">Aceptar</button>
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