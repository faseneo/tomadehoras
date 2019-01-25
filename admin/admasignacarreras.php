<html>
    <head>
	<?php include "admheader.php"; ?>
		<script src="../js/fnasignacarrera.js"></script>
		<link rel="stylesheet" type="text/css" href="../fieldchooser/stylesheets/style.css" />
        <link rel="stylesheet" type="text/css" href="../fieldchooser/stylesheets/jquery-ui.css" />
        <script src="../fieldchooser/scripts/jquery-1.10.2.js"></script>
        <script src="../fieldchooser/scripts/jquery-ui.js"></script>
		<script src="../fieldchooser/fieldChooser.js"></script>
		<script>
            $(document).ready(function () {
                var $sourceFields = $("#sourceFields");
                var $destinationFields = $("#destinationFields");
                var $chooser = $("#fieldChooser").fieldChooser(sourceFields, destinationFields);
            });
        </script>
    </head>
    <body>

 <?php include "admbarranav.php"; ?>  

        <div class="container" style="margin-top:50px">
            <div class="row">
				<div class="col-md-12">
					<h2 class="sub-header">Asignación de Carreras a las Asistentes</h2>
				</div>	
			</div>		
			<form action="" method="post" enctype="multipart/form-data" name="form_asigna_car" class="form-group-lg" id="form_asigna_car">
			<table class="table" width="900" border="0" align="center" cellpadding="2" cellspacing="10">
				<tr>
					<td width="30%">
						<label for="tiporol">Seleccione Asistente : </label>
						<select class="form-control" name="asistentes" id="asistentes">
							
						</select>
					</td>
					<td width="12%">
						&nbsp;
					</td>
					<td width="30%">
						
					</td>
					<td width="28%">
						&nbsp;
					</td>
				</tr>
			</table>
			<div id="fieldChooser" tabIndex="1">
	            <div id="sourceFields">
	            </div>
            	<div id="destinationFields">
	            </div>
	            <button id="guardar-asignacion" name="guardar-asignacion" type="button" class="btn btn-primary">Guardar Asignación</button>
	        </div>
			
		</form>
        
		</div><!-- Fin Container -->
    </body>
</html>