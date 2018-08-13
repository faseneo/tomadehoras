<html>
    <head>
	<?php include "admheader.php"; ?>
	<script src="../js/fndetatencion.js"></script>    
    </head>
    <body>

 <?php include "admbarranav.php"; ?>  

        <div class="container" style="margin-top:50px">
            <div class="row">
				<div class="col-md-9">
					<h2 class="sub-header">Detalle Atencion</h2>
					<div class="table-responsive">
						<!-- Añadimos un botón para el diálogo modal onclick="newServicio()"-->
						<button type="button" id="crea-detatencion" class="btn btn-sm btn-primary"
								data-toggle="modal" data-target="#myModal" >NUEVO</button> 
						<table class="table table-striped">
							<thead>
								<tr>
									<th width="33%">Texto</th>
									<th width="33%">Estado</th>
									<th width="33%">Acciones</th>
								</tr>
							</thead>
							<tbody id="listadetatencion">
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
					<h4 class="modal-title-form" id="myModalLabel">Detalle Atencion</h4>
				</div>
				<form role="form" name="formDetAtencion" id="formDetAtencion" method="post" action="">
					<input type="hidden" name="detAteId" id="detAteId" value="" />
					<input type="hidden" name="Accion" id="Accion" value="" />
					<div class="modal-body">
						<div class="form-group">
							<label for="detAteTxt">Texto</label>
							<input id="detAteTxt" class="form-control" type="text" name="detAteTxt" value="" title="Ingrese un texto" required />
						</div>
						<div class="form-group">
							<label for="detAteEst">Estado</label>
							<select class="form-control" name="detAteEst" id="detAteEst">
                                <option value="">- Selecciona un Estado -</option>
                                <option value="1">Activo</option>
                                <option value="0">No Activo</option>    
                            </select>
						</div>
					</div>
					<div class="modal-footer">
						<button id="editar-detatencion" name="editar-detatencion" type="button" class="btn btn-warning">Editar</button>
						<button id="actualizar-detatencion" name="actualizar-detatencion" type="button" class="btn btn-primary">Actualizar</button>
						<button id="guardar-detatencion" name="guardar-detatencion" type="button" class="btn btn-primary">Guardar</button>
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
					<h4 class="modal-title" id="myModalDeleteLabel">Eliminación de Detalle Atencion</h4>
				</div>
				<form role="form" name="formDeleteDetAtencion" id="formDeleteDetAtencion" method="post" action="">
					<input type="hidden" name="detAteId" id="detAteId" value="" />
					<input type="hidden" name="Accion" id="Accion" value="" />
					<div class="modal-body">
						<div class="input-group">
							<label for="pregunta">¿Está Seguro de eliminar el Detalle Atencion seleccionado?</label>
						</div>       
						<div class="input-group">
							<label for="nameDetAtencion">Texto Detalle Atencion</label>
							<input type="text" class="form-control" id="nameDetAtencion" name="nameDetAtencion" placeholder="" readonly>
						</div>
					</div>
					<div class="modal-footer">
						<button id="eliminar-detatencion" name="eliminar-detatencion" type="button" class="btn btn-primary">Aceptar</button>
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