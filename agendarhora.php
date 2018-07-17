<!DOCTYPE html>
<html lang="es">
<head>
	<?php include "header.php"; ?> 
	<title>Toma de horas</title>
</head>
<body>
	<?php include "cabecera.php"; ?>  

	<div class="container" >
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<table class="table">
					<tr>
						<th>Nombre</th><td>Juan Perez Perez</td>
						<th>Rut</th><td>11.999.999-K</td>
					</tr>
					<tr>
						<th>Carrera</th><td>Pedagogía en Matemáticas </td>
						<th>Codigo Carrera</th><td>99999</td>
					</tr>
				</table>
			</div>
		</div>
		<form name="" id="" action="" class="form-horizontal">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2" >
					<div class="form-group">
						<label class="col-sm-4 control-label">Seleccione asistente</label>
						<div class="col-sm-4">
							<select id="" class="form-control">
								<option value=0>Seleccione...</option>
								<option value=1>Asistente 1</option>
								<option value=2>Asistente 2</option>
								<option value=3>Asistente 3</option>
							</select>
						</div>
							<form>
								<a href="historialatenciones.php" class="btn btn-primary active" role="button">Historial Atenciones</a>
							</form>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<center>
						<h3 class="titulo1">Asistente Social: Juanita Perez</h3>
					</center>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 col-lg-offset-1">

					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="memoFecha">Fecha Atención</label>
									<input name="memoFecha" id="memoFecha" type="date" class="form-control" required>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<center><h3>Horas</h3></center>           
								<table class="table table-bordered">
									<tr>
										<th><label><input name= "#" type="radio"> 9:00</label></th>
										<th><label><input name= "#" type="radio"> 9:20</label></th>
										<th><label><input name= "#" type="radio"> 9:40</label></th>
									</tr>
									<tr>
										<th><label><input name= "#" type="radio"> 10:00</label></th>
										<th><label><input name= "#" type="radio"> 10:20</label></th>
										<th><label><input name= "#" type="radio"> 10:40</label></th>
									</tr>
									<tr>
										<th><label><input name= "#" type="radio"> 11:00</label></th>
										<th><label><input name= "#" type="radio"> 11:20</label></th>
										<th><label><input name= "#" type="radio"> 11:40</label></th>
									</tr>
									<tr>
										<th><label><input name= "#" type="radio"> 12:00</label></th>
										<th><label><input name= "#" type="radio"> 12:20</label></th>
										<th><label><input name= "#" type="radio"> 14:20</label></th>
									</tr>
									<tr>
										<th><label><input name= "#" type="radio"> 14:40</label></th>
										<th><label><input name= "#" type="radio"> 15:00</label></th>
										<th><label><input name= "#" type="radio"> 15:20</label></th>
									</tr>
									<tr>
										<th><label><input name= "#" type="radio"> 15:40</label></th>
										<th><label><input name= "#" type="radio"> 16:00</label></th>
										<th><label><input name= "#" type="radio"> 16:20</label></th>
									</tr>
								</table>
							</div>							
						</div>
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label">Tipo de atencion</label>

									<select id="" class="form-control">
										<option value=0>Seleccione...</option>
										<option value=1>Tipo 1</option>
										<option value=2>Tipo 2</option>
										<option value=3>Tipo N</option>
									</select>

								</div>
							</div>
						</div>
						<center>
							<div class="row">
								<div class="col-md-10">
									<form>
										<input type="submit" class="btn btn-primary btn-send" value="Reservar Hora">
										<input type="submit" class="btn btn-primary btn-send" value="Cancelar">
									</form>
								</div>
							</div>
						</center>
					</div>
				</form>                   
			</div>
		</div>
	</div>
</body>
</html>