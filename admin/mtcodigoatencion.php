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
            <div class="col-lg-8 col-lg-offset-2">
                <center><h1>Mantenedor de Códigos de Atención</h1></center><br><br>
<form name="formcodatt" id="formcodatt" method="post">
    <input type="hidden" id="Accion" name="Accion" value="registrar">
  <fieldset>
    <legend>Ingrese Código de Atención y su Descripción</legend>
    
    <div class="form-group">
      <label for="codigo de atención">Código de Atención</label>
      <input type="text" class="form-control" id="codatt" name="codatt" placeholder="Código de atención">
      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
      <label for="Descripción Código">Descripción de Código de Atención</label>
      <input type="text" class="form-control" id="desccodatt" name="desccodatt" placeholder="Descripción Código de Atención">
    </div>
    <button type="submit" class="btn btn-primary" id="enviar" name="enviar">Guardar Nuevo Código</button>
  </fieldset>
</form>

            </div><!-- /.8 -->
        </div> <!-- /.row-->
    </div> <!-- /.container-->
     <!-- Modal mensajes cortos-->
    <div class="modal fade" id="myModalLittle" tabindex="-1" role="dialog" aria-labelledby="myModalLittleLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Mensaje</h4>
          </div>
          <div class="modal-body">
            <p id="msg" class="msg"></p>
          </div>
          <div class="modal-footer">
            <button type="button" id="cerrarModalLittle" class="btn btn-default" data-dismiss="modal">Continuar</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>