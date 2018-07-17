<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "header.php"; ?>    
    <title>Toma de horas</title>
</head>
<body>
  <?php include "cabeceramenu2.php"; ?>

		<form name="" id="" action="" class="form-horizontal">
				<center><h4><b>Buscador</b></h4></center>
			<div class="row"><br>
				<div class="col-lg-8 col-lg-offset-2" >
					<div class="form-group">
						<div class="col-sm-4">
                                <input id="" type="text" name="" class="form-control" placeholder="Rut Ej:11999999-5">
						</div>
						<div class="col-sm-4">
                                <input id="" type="text" name="" class="form-control" placeholder="Nombre">
						</div>
						<div class="col-sm-4">
                                <input id="" type="text" name="" class="form-control" placeholder="Apellido">
						</div>

					</div>
				</div>
			</div>
		</form>
				<center><input type="submit" class="btn btn-primary btn-send" value="Buscar"></center><br>

                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="25%">Rut</th>
                                            <th width="25%">Nombre</th>
                                            <th width="25%">Apellido</th>
                                            <th width="25%">Código Carrera</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr>
                                            <td><a href="fichaestudiante2.php">11.999.999-5</a></td>
                                            <td>Juan</td>
                                            <td>Perez</td>
                                            <td>2012</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

</body>
</html>