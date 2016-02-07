<?php

include('cabecera.php');

if(isset($_SESSION['IDUSUARIO'])==''){
  header('Location: login.php');
}else{
  if($_SESSION['IDROL']!=1){
    header('Location: index.php');
  }
}
require('usuario/sistemaMalla.php');


?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Registros
            <small>Control de Acceso Remoto para Laboratorios y Oficinas</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i> Registros</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

          
          
          <div class="row">
            <div class="col-md-12">
              <br>
               <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><b>Registro de Apertura de Laboratorios y Oficinas</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Laboratorio/Oficina</th>
                        <th>Semestre</th>
                        <th>Fecha - Hora</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php

                        require('conexion.php');
                        $con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

                        $sql = "SELECT * FROM registro R, usuario U, laboratorio L WHERE R.idusuario=U.idusuario AND L.idlaboratorio=R.idlaboratorio";
                        $resultado = pg_query($con, $sql);



                        while($reg=pg_fetch_assoc($resultado)){
                            
                          
                        

                      ?>
                      <tr>
                        <td><?php echo $reg['idregistro'] ?></td>
                        <td><?php echo $reg['nombre'] ?></td>
                        <td><?php echo $reg['apellido'] ?></td>
                        <td><?php echo $reg['nombre_laboratorio'] ?></td>
                        <td><?php echo $reg['semestre_registro'] ?></td>
                        <td><?php echo $reg['fecha_hora_registro'] ?></td>
                        
                      </tr>
                      <?php
                        }
                      ?>
                      
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>


            
          </div>

         



        

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<?php
include('pie.php');
?>  