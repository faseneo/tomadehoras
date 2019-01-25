<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "admheader.php"; ?>    
    <title>Buscador</title>
    <script src="../js/fnusuarios.js"></script>
</head>
<body>
    <?php include "admbarranav.php"; ?>
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-md-9">  
                <h2 class="sub-header">Usuarios</h2>
                <div class="table-responsive">
                    <button type="button" id="crea-usuarios" class="btn btn-sm btn-primary"
                    data-toggle="modal" data-target="#myModal" >NUEVO</button> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="25%">Usuarios</th>
                                <th width="20%">Rol</th>
                                <th width="20%">Estado</th>
                                <th width="35%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="listausuarios">
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
                    <h4 class="modal-title-form" id="myModalLabel">Usuarios</h4>
                </div>
                <form role="form" name="formusuarios" id="formusuarios" method="post">
                    <fieldset>
                            <input type="hidden" name="id" id="id" value="" />
                            <input type="hidden" id="Accion" name="Accion" value="registrar">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="username">Nombre de Usuario</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario" required>
                          </div>
                          <div class="form-group">
                              <label for="pass">Contraseña</label>
                              <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                          </div>
                          <div class="form-group">
                              <label for="rol">Rol</label>
                                <select class="form-control" name="rol" id="rol">
                                </select>
                          </div>
                            <div class="form-group">
                              <label for="estado">Estado</label>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="0">No Activo</option>
                                    <option value="1" selected>Activo</option>  
                                </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button id="editar-usuarios" name="editar-usuarios" type="button" class="btn btn-warning">Editar</button>
                            <button id="actualizar-usuarios" name="actualizar-usuarios" type="button" class="btn btn-primary">Actualizar</button> 
                            <button id="guardar-usuarios" name="guardar-usuarios" type="button" class="btn btn-primary">Guardar Nuevo</button>
                            <button id="cancel" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </fieldset>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   <!-- Comienzo de Modal que permite ingresar los datos personales de la tabla "personas_dae" -->
   <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title-form" id="myModalLabel2">Datos Personales</h4>
                </div>
                <form role="form" name="formpersdae" id="formpersdae" method="post">
                    <fieldset>
                            <input type="hidden" name="iddae" id="iddae" value="" />
                            <input type="hidden" name="usu_id" id="usu_id" value="" />
                            <input type="hidden" id="Acciondae" name="Acciondae" value="registrar">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="nombres">Nombres</label>
                              <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" required>
                          </div>
                          <div class="form-group">
                              <label for="apellidos">Apellidos</label>
                              <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                          </div>
                          <div class="form-group">
                              <label for="correo">Correo</label>
                              <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                          </div>
                          <div class="form-group">
                              <label for="anexo">Anexo</label>
                              <input type="text" class="form-control" id="anexo" name="anexo" placeholder="Anexo" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button id="editar-persdae" name="editar-persdae" type="button" class="btn btn-warning">Editar</button>
                            <button id="actualizar-persdae" name="actualizar-persdae" type="button" class="btn btn-primary">Actualizar</button> 
                            <button id="guardar-persdae" name="guardar-persdae" type="button" class="btn btn-primary">Guardar Nuevo</button>
                            <button id="cancel" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </fieldset>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
   <!-- Fin Modal que permite ingresar los datos personales de la tabla "personas_dae" -->
   <!-- Modal DELETE -->
    <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalDeleteLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalDeleteLabel">Eliminación de Usuarios</h4>
                </div>
                <form role="form" name="formDeleteUsuarios" id="formDeleteUsuarios" method="post" action="">
                    <input type="hidden" name="usu_id" id="usu_id" value="" />
                    <input type="hidden" name="Accion" id="Accion" value="" />
                    <div class="modal-body">
                        <div class="input-group">
                            <label for="pregunta">¿Está seguro de eliminar el Usuario seleccionado?</label>
                        </div>
                        <div class="input-group">
                            <label for="username">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="eliminar-usuarios" name="eliminar-usuarios" type="button" class="btn btn-primary">Aceptar</button>
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