<html>
    <head>
	<?php include "admheader.php"; ?>
	<script src="../js/fncarreras.js"></script>    
    </head>
    <body>

 <?php include "admbarranav.php"; ?>  

        <div class="container" style="margin-top:50px">
            <div class="row">
				<div class="col-md-9">
					<h2 class="sub-header">Carreras</h2>
					<div class="table-responsive">
						<!-- Añadimos un botón para el diálogo modal onclick="newServicio()"-->
						<button type="button" id="crea-carrera" class="btn btn-sm btn-primary"
								data-toggle="modal" data-target="#myModal" >NUEVO</button> 
						<table class="table table-striped">
							<thead>
								<tr>
									<th width="25%">Nombre</th>
									<th width="25%">Codigo</th>
									<th width="25%">Facultad Id</th>
									<th width="25%">Acciones</th>
								</tr>
							</thead>
							<tbody id="listacarreras">
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
					<h4 class="modal-title-form" id="myModalLabel">Carreras</h4>
				</div>
				<form role="form" name="formCarrera" id="formCarrera" method="post" action="">
					<input type="hidden" name="carrId" id="carrId" value="" />
					<input type="hidden" name="Accion" id="Accion" value="" />
					<div class="modal-body">
						<div class="form-group">
							<label for="carrNom">Nombre</label>
							<input id="carrNom" class="form-control" type="text" name="carrNom" value="" title="Ingrese un nombre" required />
						</div>
						<div class="form-group">
							<label for="carrCod">Codigo</label>
							<input id="carrCod" class="form-control" type="text" name="carrCod" value="" title="Ingrese un codigo" required />
						</div>
						<div class="form-group">
							<label for="carrFacId">Facultad Id</label>
							<input id="carrFacId" class="form-control" type="text" name="carrFacId" value="" title="Ingrese un Id" required />
						</div>
					</div>
					<div class="modal-footer">
						<button id="editar-carrera" name="editar-carrera" type="button" class="btn btn-warning">Editar</button>
						<button id="actualizar-carrera" name="actualizar-carrera" type="button" class="btn btn-primary">Actualizar</button>
						<button id="guardar-carrera" name="guardar-carrera" type="button" class="btn btn-primary">Guardar</button>
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
					<h4 class="modal-title" id="myModalDeleteLabel">Eliminación de Carrera</h4>
				</div>
				<form role="form" name="formDeleteCarrera" id="formDeleteCarrera" method="post" action="">
					<input type="hidden" name="carrId" id="carrId" value="" />
					<input type="hidden" name="Accion" id="Accion" value="" />
					<div class="modal-body">
						<div class="input-group">
							<label for="pregunta">¿Está Seguro de eliminar la Carrera seleccionada?</label>
						</div>       
						<div class="input-group">
							<label for="nameCarrera">Nombre Carrera</label>
							<input type="text" class="form-control" id="nameCarrera" name="nameCarrera" placeholder="" readonly>
						</div>
					</div>
					<div class="modal-footer">
						<button id="eliminar-carrera" name="eliminar-carrera" type="button" class="btn btn-primary">Aceptar</button>
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