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
            Usuarios
            <small>Control de Acceso Remoto para Laboratorios y Oficinas</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i> Usuarios</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

          <div class="row">
            <div class="col-md-3">
              <button class="btn btn-block btn-primary btn-lg" onclick="window.location='nuevo_usuario.php'"><i class='fa fa-user'></i> Nuevo Usuario</button>
            </div>
            
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <br>
               <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><b>Listado de Usuarios</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php

                        require('conexion.php');
                        $con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

                        $sql = "SELECT * FROM usuario WHERE idrol!=1";
                        $resultado = pg_query($con, $sql);



                        while($reg=pg_fetch_assoc($resultado)){
                            
                          
                        

                      ?>
                      <tr>
                        <td><?php echo $reg['idusuario'] ?></td>
                        <td><?php echo $reg['nombre'] ?></td>
                        <td><?php echo $reg['apellido'] ?></td>
                        <td><?php echo $reg['username'] ?></td>
                        <td><?php echo base64_decode($reg['password']) ?></td>
                        <td> 
                          <div class="btn-group">
                            <a onclick="window.location='editar_usuario.php?idusuario=<?php echo $reg['idusuario'] ?>&idusuariovinculado=<?php echo $reg['idusuariovinculado'] ?>'"  title="Editar" style="cursor: pointer;">
                              <span class="glyphicon glyphicon-edit"></span>
                            </a>
                          
                             <a onclick="eliminarUsuario(<?php echo $reg['idusuario'] ?>,'<?php echo $reg['nombre'] ?>','<?php echo $reg['apellido'] ?>');"  title="Eliminar" style="cursor: pointer;">
                               <span class="glyphicon glyphicon-remove"></span>
                            </a>
                          </div>
                        </td>
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


      <div class="modal fade" id="modalEliminarUsuario" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="modal-title" > ¿Desea eliminar este usuario?</div>
            </div>
            <div class="row">
              <div class="col-md-10 col-xs-offset-1">
                <h5><div id="usuarioAEliminar">maria asas</div></h5>
              </div>
            </div>
           
            <div class="modal-footer">
              <button type="button" class="btn btn-info" onClick="eliminarUsuarioConfirmado(codigoUsuario); return false">
                  <span class="fa fa-trash" aria-hidden="true"></span> Eliminar
              </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancel</button>
            </div>
          </div>
        </div>
      </div>



<script type="text/javascript">

  codigoUsuario = 0;

  function eliminarUsuario(idusuario, nombre, apellido){
    codigoUsuario = idusuario;
    $('#usuarioAEliminar').html(''+nombre+' '+apellido);
    $('#modalEliminarUsuario').modal('show');
  }

  function objetoAjax(){
    var xmlhttp=false;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }

  function eliminarUsuarioConfirmado(codigoUsuario){
    ajax = objetoAjax();

    ajax.open("POST", "usuario/eliminarUsuario.php", true);
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
           window.location.reload(true);
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("idusuario="+codigoUsuario);
    
  }

</script>


<?php
include('pie.php');
?>  