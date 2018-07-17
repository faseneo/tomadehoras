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
                <center><h3 class="titulo1">Cancelar Hora</h3></center>
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
            </div><!-- /.8 -->
        </div> <!-- /.row-->

    </div> <!-- /.container-->

      
</body>
</html>