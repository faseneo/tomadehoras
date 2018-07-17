<!DOCTYPE html>
<html lang="es">
<head>
	<?php include "header.php"; ?>    
	<title>Toma de horas</title>
	<script>
		$(document).ready(function(){
		    $('[data-toggle="popover"]').popover();   
		});
	</script>
</head>
<body>
	<?php include "cabeceramenu.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-lg-offset-0">
				<!-- Tab links -->
				<ul class="nav nav-tabs">
				    <li class="active"><a data-toggle="tab" href="#registro">Registro atención</a></li>
				    <li><a data-toggle="tab" href="#historialhoras">Registro de Horas </a></li>
				    <li><a data-toggle="tab" href="#historialatencion">Historial Atención</a></li>
				    <li><a data-toggle="tab" href="#cancelar">Cancelar hora</a></li>
				    <li><a data-toggle="tab" href="#agendar">Agendar hora</a></li>
				</ul>
				<!-- Tab content -->
				<div class="tab-content">
				    <div id="registro" class="tab-pane fade in active">
						<div class="row">
							<div class="col-lg-12">
								<table class="table">
									<tr>
										<th>Bienvenido</th><td>Juan Perez Perez</td>
										<th>Rut</th><td>11.999.999-K</td>
									</tr>
									<tr>
										<th>Carrera</th><td>Pedagogía en Matemáticas </td>  
										<th>Codigo Carrera</th><td>99999</td>
									</tr>
								</table>
								<form action="" name="formatencion">
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="fechaatencion">Fecha atención</label>
												<input id="fechaatencion" name="fechaatencion" type="text" class="form-control" disabled value="06-05-2018" >
											</div>
										</div>	
										<div class="col-lg-4">
											<div class="form-group">
												<label for="horaatencion">Hora atención</label>
												<input id="horaatencion" name="horaatencion" type="text" class="form-control" disabled value="16:20" >
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="tipoatencion">Tipo atencion</label>
												<input id="tipoatencion" name="tipoatencion" type="text" class="form-control" disabled value="tipo N" >
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="motivointerno">Motivo (interno)</label>
										<textarea id="motivointerno" name="motivointerno" cols="100" rows="5" class="form-control" ></textarea>
									</div>
									<div class="form-group">
										<label for="motivoexterno">Motivo (externo)</label>
										<textarea id="motivoexterno" name="motivoexterno" cols="100" rows="5" class="form-control" ></textarea>
									</div>
										<center><button type="button" class="btn btn-primary btn-send">Guardar</button></center>
								</form>
							</div>
						</div>
				    </div>
				    <div id="historialhoras" class="tab-pane fade">
						<div class="row">
							<div class="col-lg-12">
								<center><h3>Historial de citas</h3></center>
				                <h4>Año 2018</h4>
				                <table class="table table-striped">
				                    <thead>
				                        <tr>
				                           <th width="30%">Fecha / Hora</th>
				                           <th width="40%">Asistente Social</th>
				                           <th width="15%">Estado</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                        <tr>
				                            <td>20-05-2018 / 11:20 am </td>
				                            <td>Jessica Romero</td>
				                            <td>Reservado</td>
				                        </tr>
				                        <tr>
				                            <td>14-04-2018 / 09:00 am </td>
				                            <td>Jessica Romero</td>
				                            <td>Finalizada</td>
				                        </tr>
				                        <tr>
				                            <td>28-03-2018 / 03:00 pm </td>
				                            <td>Jessica Romero</td>
				                            <td>Cancelada 
												<a href="#" data-toggle="popover" title="Motivo" data-content="No puedo asistir problema salud">
												<span class="glyphicon glyphicon-info-sign"></span></a>
				                            </td>
				                        </tr>                        
				                    </tbody>
				                </table>
				                <h4>Año 2017</h4>
				                <table class="table table-striped">
				                    <thead>
				                        <tr>
				                           <th width="30%">Fecha / Hora</th>
				                           <th width="40%">Asistente Social</th>
				                           <th width="15%">Estado</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                        <tr>
				                            <td>29-11-2017 / 10:40 am</td>
				                            <td>Jessica Romero</td>
				                            <td>Finalizada</td>
				                        </tr>
				                        <tr>
				                            <td>09-09-2017 / 03:40 pm</td>
				                            <td>Jessica Romero</td>
				                            <td>Cancelada 
												<a href="#" data-toggle="popover" title="Motivo" data-content="prueba de ultimo minuto">
												<span class="glyphicon glyphicon-info-sign"></span></a>
				                            </td>
				                        </tr>
				                        <tr>
				                            <td>28-08-2017 / 10:00 am</td>
				                            <td>Jessica Romero</td>
				                            <td>Finalizada</td>
				                        </tr>                        
				                    </tbody>
				                </table>
							</div>
						</div>
				    </div>
					<div id="historialatencion" class="tab-pane fade">
						<div class="row">
							<div class="col-lg-12">
								<table class="table" width="60%">
									<thead>
										<tr>
											<th width="10%">Fecha atención</th>
											<th width="10%">Hora atención</th>
											<th>Comentario Interno</th>
											<th>Comentario Externo</th>
										</tr>
										
									</thead>
									<tbody>
										<tr>
											<td>06-05-2018</td>
											<td>16:20 </td>
											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur dignissim faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis magna dolor, aliquet ultricies enim sodales id. Ut tortor elit, tempor sit amet pharetra et, ultricies a elit. Donec cursus elit at nulla scelerisque, in posuere leo gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur dignissim faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis magna dolor, aliquet ultricies enim sodales id. Ut tortor elit, tempor sit amet pharetra et, ultricies a elit. Donec cursus elit at nulla scelerisque, in posuere leo gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
										</tr>
										<tr>
											<td>14-04-2018</td>
											<td>16:20 </td>
											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur dignissim faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis magna dolor, aliquet ultricies enim sodales id. Ut tortor elit, tempor sit amet pharetra et, ultricies a elit. Donec cursus elit at nulla scelerisque, in posuere leo gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur dignissim faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis magna dolor, aliquet ultricies enim sodales id. Ut tortor elit, tempor sit amet pharetra et, ultricies a elit. Donec cursus elit at nulla scelerisque, in posuere leo gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
										</tr>
										<tr>
											<td>10-04-2018</td>
											<td>16:20 </td>
											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur dignissim faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis magna dolor, aliquet ultricies enim sodales id. Ut tortor elit, tempor sit amet pharetra et, ultricies a elit. Donec cursus elit at nulla scelerisque, in posuere leo gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur dignissim faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis magna dolor, aliquet ultricies enim sodales id. Ut tortor elit, tempor sit amet pharetra et, ultricies a elit. Donec cursus elit at nulla scelerisque, in posuere leo gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
										</tr>
										<tr>
											<td>24-03-2018</td>
											<td>15:20</td>
											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur dignissim faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis magna dolor, aliquet ultricies enim sodales id. Ut tortor elit, tempor sit amet pharetra et, ultricies a elit. Donec cursus elit at nulla scelerisque, in posuere leo gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur dignissim faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean venenatis magna dolor, aliquet ultricies enim sodales id. Ut tortor elit, tempor sit amet pharetra et, ultricies a elit. Donec cursus elit at nulla scelerisque, in posuere leo gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
										</tr>										

									</tbody>
								</table>
							</div>
						</div>
				    </div>				    
				    <div id="cancelar" class="tab-pane fade">
				    	<form action="" name="formatencion">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="fechaatencion">Fecha atención</label>
											<input id="fechaatencion" name="fechaatencion" type="text" class="form-control" disabled value="06-05-2018" >
										</div>
									</div>	
									<div class="col-lg-4">
										<div class="form-group">
											<label for="horaatencion">Hora atención</label>
											<input id="horaatencion" name="horaatencion" type="text" class="form-control" disabled value="16:20" >
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="tipoatencion">Tipo atencion</label>
											<input id="tipoatencion" name="tipoatencion" type="text" class="form-control" disabled value="tipo N" >
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="motivocancela">Motivo de cancelación</label>
									<textarea id="motivocancela" name="motivocancela" cols="100" rows="5" class="form-control" ></textarea>
								</div>
							<center><button type="button" class="btn btn-primary btn-send">Guardar</button></center>
						</form>
				    </div>
					<div id="agendar" class="tab-pane fade"><br>
		 				<div class="container" >
		        			<div class="row">
		            			<div class="col-lg-12">
									<form name="" id="" action="" class="form-horizontal">
		  								<div class="container">
											<div class="row">
												<div class="col-md-4">
						                            <div class="form-group">
						                                <label for="memoFecha">Fecha Atención</label>
						                                <input name="memoFecha" id="memoFecha" type="date" class="form-control" required>
						                                <div class="help-block with-errors"></div>
						                            </div>
						                        </div>
												<div class="col-md-8">
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
											    <div class="col-sm-4">
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
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>