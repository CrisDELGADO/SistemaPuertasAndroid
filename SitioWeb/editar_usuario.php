<?php

include('cabecera.php');

if(isset($_SESSION['IDUSUARIO'])==''){
  header('Location: login.php');
}else{
  if($_SESSION['IDROL']!=1){
    header('Location: index.php');
  }else{
    if(!$_GET['idusuario']&&!$_GET['idusuariovinculado']){
         header('Location: usuario.php');
    }
  }
}


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
            <li><a href="usuario.php"><i class="fa fa-users"></i> Usuarios</a></li>
            <li class="active">Editar Usuario</li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

         
          <?php

          require('conexion.php');
          $con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

          $sql = "SELECT * FROM usuario WHERE idusuario='".$_GET['idusuario']."' AND idrol!=1";
          $resultado = pg_query($con, $sql);

          $regresar = TRUE;



          while($reg=pg_fetch_assoc($resultado)){
              $regresar = FALSE;
            
          

          ?>
       

          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i>Editar Usuario</i></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                    <form role="form" name="frmNuevoUsuario">
                        <fieldset>

                            <div id="mensajeFrmNuevoUsuario">

                            </div>
                            <div class="form-group">
                                <label>Nombres</label>
                                <input class="form-control" placeholder="Nombres" name="nombre" type="text" autofocus value="<?php echo $reg['nombre'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input class="form-control" placeholder="Apellidos" name="apellido" type="text" autofocus value="<?php echo $reg['apellido'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus value="<?php echo $reg['username'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Contraseña Actual</label>
                                <input class="form-control" placeholder="Contraseña" name="password" type="text" autofocus disabled value="<?php echo $reg['password'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Nueva Contraseña (Opcional)</label>
                                <input class="form-control" placeholder="Nueva Contraseña" name="password2" type="text" autofocus>
                            </div>
                          
                            
                      
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                      <div class="col-md-12"><label>Asignación de Laboratorios</label></div>
                     
                    </div>
                      <div class="callout callout-info">
                        <h4>Recuerde:</h4>
                        <p align="justify">Aquí podrá vincular un Usuario con el Sistema de Mallas. 
                          Este Usuario tendrá los permisos de Acceso a Laboratorios 
                            y Oficinas de acuerdo a su Horario estabecido.</p>
                      </div>

                    <div class="form-group">
                    
                      <label>Vinculación de Usuario</label>
                      <select class="form-control select2 " data-placeholder="Usuarios" style="width: 100%;" name="vinculacion">
                        <?php
                            require('conexionMalla.php');
                            $con2 = pg_connect($cadena2) or die ("Error de Conexion". pg_last_error());
                            $sql = "SELECT * FROM auth_user";

                            $resultado = pg_query($con2, $sql);

                            if(!$resultado){
                              //ERROR DE BUSQUEDA
                            }

                            $valoresOption = '';

                            while($reg=pg_fetch_assoc($resultado)){
                              if($reg['id']==$_GET['idusuariovinculado']){
                                $valoresOption.="<option selected='selected' value=".$reg['id'].">".$reg['first_name']." ".$reg['last_name']."</option>";
                              }else{
                                $valoresOption.="<option value=".$reg['id'].">".$reg['first_name']." ".$reg['last_name']."</option>";
                              }
                              
                            }

                            echo $valoresOption;
                            
                        ?>
                      </select>
                      
                      
                    </div>
                    </fieldset>
                    </form>


                    </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-lg btn-primary" onclick="editarUsuario(); return false;"><i class="fa fa-save"></i> Guardar Cambios</button>
                  </div>
                </div>
            </div>
          </div>

          <?php
            }

            if($regresar)header('Location: usuario.php');
          ?>



        

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<script type="text/javascript">

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



  function editarUsuario(){
    var idusuario = <?php echo $_GET['idusuario'] ?>;
    var nombre = document.frmNuevoUsuario.nombre.value;
    var apellido = document.frmNuevoUsuario.apellido.value;
    var username = document.frmNuevoUsuario.username.value;
    var password = document.frmNuevoUsuario.password.value;
    var password2 = document.frmNuevoUsuario.password2.value;
    var idusuariovinculado = document.frmNuevoUsuario.vinculacion.value;

    ajax = objetoAjax();

    ajax.open("POST", "usuario/editarUsuario.php", true);
    ajax.onreadystatechange=function() {
      if (ajax.readyState==4) {
        var mensajeRespuesta = ajax.responseText;

        if(mensajeRespuesta == 'BIEN'){
          window.location='usuario.php';
        }else{
          var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                         '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                          '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                          '</div>';
          document.getElementById("mensajeFrmNuevoUsuario").innerHTML = htmlAlerta;
        }
      }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("idusuario="+idusuario+"&nombre="+nombre+"&apellido="+apellido+"&username="+username+"&password="+password+"&password2="+password2+"&idusuariovinculado="+idusuariovinculado);
  }

</script>


<?php
include('pie.php');
?>  