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
                        <th>Bienvenido</th><td>Juan Perez Perez</td>
                        <th>Rut</th><td>11.999.999-K</td>
                    </tr>
                    <tr>
                        <th>Carrera</th><td>Pedagogía en Matemáticas </td>
                        <th>Codigo Carrera</th><td>99999</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <center><h3 class="titulo1">Atenciones</h3></center>
                <h4>Año 2018</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                           <th>Fecha / Hora</th>
                           <th>Asistente Social</th>
                           <th>Estado</th>
                           <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20-05-2018 / 11:20 am </td>
                            <td>Jessica Romero</td>
                            <td>Reservado</td>
                            <td>
                                <!-- <button type="button" class="btn btn-warning btn-xs">Cancelar</button> -->
                                <a href="#.php" class="btn btn-sm btn-warning active" role="button">Cancelar</a>
                            </td>

                        </tr>
                        <tr>
                            <td>14-04-2018 / 09:00 am </td>
                            <td>Jessica Romero</td>
                            <td>Finalizada</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>28-03-2018 / 03:00 pm </td>
                            <td>Jessica Romero</td>
                            <td>Cancelada</td>
                            <td></td>
                        </tr>                        
                    </tbody>
                </table>
                <h4>Año 2017</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                           <th>Fecha / Hora</th>
                           <th>Asistente Social</th>
                           <th>Estado</th>
                           <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>29-11-2017 / 10:40 am </td>
                            <td>Jessica Romero</td>
                            <td>Finalizada</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>09-09-2017 / 03:40 pm </td>
                            <td>Jessica Romero</td>
                            <td>Cancelada</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>28-08-2017 / 10:00 am </td>
                            <td>Jessica Romero</td>
                            <td>Finalizada</td>
                            <td></td>
                        </tr>                        
                    </tbody>
                </table>                
            </div><!-- /.8 -->
                        <center>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <input type="submit" class="btn btn-primary btn-send" value="Reservar Hora"> -->
                                    <a href="agendarhora.php" class="btn btn-primary active" role="button">Reservar Hora</a>
                                </div>
                            </div>
                        </center>
        </div> <!-- /.row-->
    </div> <!-- /.container-->
</body>
</html>
