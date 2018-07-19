<html>
    <head>
	<?php include "admheader.php"; ?>
	<script src="../js/fnfacultad.js"></script>    
    </head>
    <body>

 <?php include "admbarranav.php"; ?>  

        <div class="container" style="margin-top:50px">
            <div class="row">
				<div class="col-md-9">
					<h2 class="sub-header">Facultades</h2>
					<div class="table-responsive">
						<!-- Añadimos un botón para el diálogo modal onclick="newServicio()"-->
						<button type="button" id="crea-facultad" class="btn btn-sm btn-primary"
								data-toggle="modal" data-target="#myModal" >NUEVO</button> 
						<table class="table table-striped">
							<thead>
								<tr>
									<th width="50%">Nombre</th>
									<th width="50%">Acciones</th>
								</tr>
							</thead>
							<tbody id="listafacultad">
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
					<h4 class="modal-title-form" id="myModalLabel">Facultades</h4>
				</div>
				<form role="form" name="formFacultad" id="formFacultad" method="post" action="">
					<input type="hidden" name="faculId" id="faculId" value="" />
					<input type="hidden" name="Accion" id="Accion" value="" />
					<div class="modal-body">
						<div class="form-group">
							<label for="faculNombre">Nombre</label>
							<input id="faculNombre" class="form-control" type="text" name="faculNombre" value="" title="Ingrese un nombre" required />
						</div>
					</div>
					<div class="modal-footer">
						<button id="editar-facultad" name="editar-facultad" type="button" class="btn btn-warning">Editar</button>
						<button id="actualizar-facultad" name="actualizar-facultad" type="button" class="btn btn-primary">Actualizar</button>
						<button id="guardar-facultad" name="guardar-facultad" type="button" class="btn btn-primary">Guardar</button>
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
					<h4 class="modal-title" id="myModalDeleteLabel">Eliminación de Facultad</h4>
				</div>
				<form role="form" name="formDeleteFacultad" id="formDeleteFacultad" method="post" action="">
					<input type="hidden" name="faculId" id="faculId" value="" />
					<input type="hidden" name="Accion" id="Accion" value="" />
					<div class="modal-body">
						<div class="input-group">
							<label for="pregunta">¿Está Seguro de eliminar la Facultad seleccionada?</label>
						</div>       
						<div class="input-group">
							<label for="nameFacultad">Nombre Facultad</label>
							<input type="text" class="form-control" id="nameFacultad" name="nameFacultad" placeholder="" readonly>
						</div>
					</div>
					<div class="modal-footer">
						<button id="eliminar-facultad" name="eliminar-facultad" type="button" class="btn btn-primary">Aceptar</button>
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