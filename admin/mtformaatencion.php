<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "admheader.php"; ?>    
    <title>Buscador</title>
    <script src="../js/fnformaatt.js"></script>
</head>
<body>
    <?php include "admbarranav.php"; ?>
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-md-9">  
                <h2 class="sub-header">Formas de Atención</h2>
                <div class="table-responsive">
                    <button type="button" id="crea-formaatt" class="btn btn-sm btn-primary"
                    data-toggle="modal" data-target="#myModal" >NUEVO</button> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="25%">Forma de Atención</th>
                                <th width="50%">Estado</th>
                                <th width="25%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="listaformaatt">
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
                    <h4 class="modal-title-form" id="myModalLabel">Formas de Atención</h4>
                </div>
                <form role="form" name="formformaatt" id="formformaatt" method="post">
                    <fieldset>
                            <input type="hidden" name="formaattid" id="formaattid" value="" />
                            <input type="hidden" id="Accion" name="Accion" value="registrar">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="formaatt">Forma de Atención</label>
                              <input type="text" class="form-control" id="formaatt" name="formaatt" placeholder="Forma de Atención">
                          </div>
                            <div class="form-group">
                              <label for="formaattestado">Estado</label>
                                <select class="form-control" name="formaattestado" id="formaattestado">
                                    <option value="">- Selecciona un Estado -</option>
                                    <option value="1">Activo</option>
                                    <option value="0">No Activo</option>    
                                </select>
                              <!-- <input type="text" class="form-control" id="formaattestado" name="formaattestado" placeholder="Estado"> -->
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button id="editar-formaatt" name="editar-formaatt" type="button" class="btn btn-warning">Editar</button>
                            <button id="actualizar-formaatt" name="actualizar-formaatt" type="button" class="btn btn-primary">Actualizar</button> 
                            <button id="guardar-formaatt" name="guardar-formaatt" type="button" class="btn btn-primary">Guardar Nuevo</button>
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
                    <h4 class="modal-title" id="myModalDeleteLabel">Eliminación de Forma de Atención</h4>
                </div>
                <form role="form" name="formDeleteFormaatt" id="formDeleteFormaatt" method="post" action="">
                    <input type="hidden" name="formaattid" id="formaattid" value="" />
                    <input type="hidden" name="Accion" id="Accion" value="" />
                    <div class="modal-body">
                        <div class="input-group">
                            <label for="pregunta">¿Está seguro de eliminar la Forma de Atención seleccionada?</label>
                        </div>
                        <div class="input-group">
                            <label for="formaatt">Código de Atención</label>
                            <input type="text" class="form-control" id="formaatt" name="formaatt" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="eliminar-formaatt" name="eliminar-formaatt" type="button" class="btn btn-primary">Aceptar</button>
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