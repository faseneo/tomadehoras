<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "header.php"; ?>    
    <title>Toma de horas</title>
</head>
<body>
  <?php include "cabeceramenu2.php"; ?>

       <div class="container" style="margin-top:50px">
            <div class="row">
				<div class="col-md-9">
					<h2 class="sub-header">Tipo de Atención</h2>
					<div class="table-responsive">
						<!-- Añadimos un botón para el diálogo modal onclick="newServicio()"-->
						<button type="button" id="crea-depto" class="btn btn-sm btn-primary"
								data-toggle="modal" data-target="#myModal" >NUEVO</button> 
						<table class="table table-striped">
							<thead>
								<tr>
									<th width="50%">Tipo</th>
									<th width="50%">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Tipo 1</td>
								</tr>
								<tr>
									<td>Tipo 2</td>
								</tr>
								<tr>
									<td>Tipo 3</td>
								</tr>
							</tbody>
		 				</table>
					</div>
				</div>
			</div>
		</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title-form" id="myModalLabel">Tipo de Atención</h4>
				</div>
				<form role="form" name="" id="" method="post" action="">
					<input type="hidden" name="" id="" value="" />
					<input type="hidden" name="Accion" id="Accion" value="" />
					<div class="modal-body">
						<div class="form-group">
							<label for="">Tipo</label>
							<input id="" class="form-control" type="text" name="" value="" title="Ingrese un tipo" required />
						</div>
					</div>
					<div class="modal-footer">
						<button id="" name="" type="button" class="btn btn-warning">Editar</button>
						<button id="" name="" type="button" class="btn btn-primary">Actualizar</button>
						<button id="" name="" type="button" class="btn btn-primary">Guardar</button>
						<button id="cancel" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
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
					<h4 class="modal-title" id="myModalDeleteLabel">Eliminación de Tipo de Atención</h4>
				</div>
				<form role="form" name="" id="" method="post" action="">
					<input type="hidden" name="" id="" value="" />
					<input type="hidden" name="Accion" id="Accion" value="" />
					<div class="modal-body">
						<div class="input-group">
							<label for="pregunta">¿Está Seguro de eliminar el Tipo de Atención seleccionado?</label>
						</div>       
						<div class="input-group">
							<label for="">Nombre Tipo de Atención</label>
							<input type="text" class="form-control" id="" name="" placeholder="" readonly>
						</div>
					</div>
					<div class="modal-footer">
						<button id="" name="" type="button" class="btn btn-primary">Aceptar</button>
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
	</div>

</body>
</html>