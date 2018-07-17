<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "header.php"; ?>    
    <title>Toma de Horas - UMCE</title>
</head>
<body>
    <?php include "cabeceramenu2.php"; ?>
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 ">
                <div class="row">
                    <div class="col-lg-6">
                        <form name="formasistentes" id="formasistentes" action="" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nombre Asistente </label>
                            <div class="col-sm-8">
<!--                                 <p class="form-control-static">email@example.com</p> -->
                                <select id="asistentes" class="form-control">
                                <option value=0>Seleccione...</option>
                                <option value=1>Asistente 1</option>
                                <option value=2>Asistente 2</option>
                                <option value=3>Asistente 3</option>
                            </select>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <center>
                            <h4>
                                <span class="glyphicon glyphicon-backward"></span>
                                    Semana en curso
                                <span class="glyphicon glyphicon-forward"></span>
                            </h4>
                        </center>
                    </div>
                    <div class="col-lg-6">
                        <center><h4>Marzo 2018</h4></center>
                    </div>            
                </div>



                </div>
            </div>

                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-bordered text-right">
                            <tr class="filaasistente">
                                <th colspan="2">Lunes</th>
                                <th colspan="2">Martes</th>
                                <th colspan="2">Miercoles</th>
                                <th colspan="2">Jueves</th>
                                <th colspan="2">Viernes</th>
                            </tr>
                            <tr class="filabloqueo2">
                                <!-- <td width="10"></td> -->
                                <td>Bloquear día</td>
                                <td><input type="checkbox"></td>
                                <!-- <td width="10"></td> -->
                                <td>Bloquear día</td>
                                <td><input type="checkbox"></td>
                                <!-- <td width="10"></td> -->
                                <td>Bloquear día</td>
                                <td><input type="checkbox"></td>
                                <!-- <td width="10"></td> -->
                                <td>Bloquear día</td>
                                <td><input type="checkbox"></td>
                                <!-- <td width="10"></td> -->
                                <td>Bloquear día</td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <!-- <td class="success" width="10" height="30"><p class="dia">05</p></td> -->
                                <td width="70" colspan="2">
                                    <table class="tabledia table-hover small agenda agenda-hover ">
                                        <tr class="morning"><td>9:00</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalEstado" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalEstado" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:20</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                    </table>
                                </td>
                                <!-- <td class="success" width="10"><p class="dia">06</p></td> -->
                                <td width="70" colspan="2">
                                    <table class="tabledia table-hover small agenda agenda-hover ">
                                        <tr class="morning"><td>9:00</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:20</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                    </table>
                                </td>
                                <!-- <td class="success" width="10"><p class="dia">07</p></td> -->
                                <td width="70" colspan="2">
                                    <table class="tabledia table-hover small agenda agenda-hover ">
                                        <tr class="morning"><td>9:00</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:20</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                    </table>
                                </td>
                                <!-- <td class="success" width="10"><p class="dia">08</p></td> -->
                                <td width="70" colspan="2">
                                    <table class="tabledia table-hover small agenda agenda-hover ">
                                        <tr class="morning"><td>9:00</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:20</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                    </table>
                                </td>
                                <!-- <td class="success" width="10"><p class="dia">09</p></td> -->
                               <td width="70" colspan="2">
                                    <table class="tabledia table-hover small agenda agenda-hover ">
                                        <tr class="morning"><td>9:00</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:20</td><td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>9:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>10:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>11:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="morning"><td>12:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>14:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>15:40</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:00</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                        <tr class="afternoon"><td>16:20</td> <td><b><a href="fichaestudiante2.php">11.999.999-5</a></b></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                                </button></td>
                                            <td><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button></td><td><input type="checkbox"></td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
        </div> <!-- /.row-->
        <div class="row">
            <div class="col-md-12">
                <center>
                <input type="submit" class="btn btn-primary" value="Bloquear">
                <input type="submit" class="btn btn-primary" value="Desbloquear">
                </center>
            </div>
        </div> <!-- /.row-->
    </div> <!-- /.container-->

    <div class="modal fade" id="myModalEstado" tabindex="-1" role="dialog" aria-labelledby="myModalEstadoLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cambiar Estado</h4>
                </div>
                <div class="modal-body">
                    <!-- <p id="msg" class="msg"></p> -->
                             <div class="row">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label class="control-label">Seleccione estado</label>
                                        <select id="" class="form-control">
                                            <option value=0>Seleccione...</option>
                                            <option value=1>Estado 1</option>
                                            <option value=2>Estado 2</option>
                                            <option value=3>Estado 3</option>
                                        </select>
                                 
                                    </div>
                                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cerrarModalLittle" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>
