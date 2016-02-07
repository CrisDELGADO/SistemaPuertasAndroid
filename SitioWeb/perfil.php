<?php
  include('cabecera.php');

  if(isset($_SESSION['IDUSUARIO'])==''){
      header('Location: login.php');
  }else{
    
  }
?>


 <!-- Content Wrapper. Contains page content -->
<div  id="contenedor" class="content-wrapper">
  <section class="content-header">
    <h1>
      Perfil
      <small>Control de Acceso Remoto para Laboratorios y Oficinas</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> Perfil</a></li>
      
    </ol>
  </section>


    <?php

    require('conexion.php');
    $con = pg_connect($cadena) or die ("Error de Conexion". pg_last_error());

    $sql = "SELECT * FROM usuario WHERE idusuario='".$_SESSION['IDUSUARIO']."'";
    $resultado = pg_query($con, $sql);



    while($reg=pg_fetch_assoc($resultado)){
        
      
    

    ?>


    <section class="content">
      <div class="row">
        <div class="col-md-6">
        <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i>Mis Datos</i></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" name="frmDatosPersonales">
                        <fieldset>
                            <div id="mensajeFrmDatosPersonales">

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
                           
                           
                            
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-block btn-lg btn-primary" onclick="actualizarMisDatos(); return false;"><i class="fa fa-save"></i> Guardar Cambios</button>
                      </fieldset>
                    </form>
                  </div>
                </div>
        </div>

        <?php } ?>


        <div class="col-md-6">
        <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i>Cambiar Contraseña</i></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" name="frmCambiarPassword">
                        <fieldset>
                            <div id="mensajeFrmCambiarPassword">

                            </div>
                            
                            <div class="form-group">
                                <label>Contraseña Actual</label>
                                <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                            </div>
                            <div class="form-group">
                                <label>Nueva Contraseña</label>
                                <input class="form-control" placeholder="Contraseña" name="passwordnueva" type="password" value="">
                            </div>
                            <div class="form-group">
                                <label>Verificar Contraseña</label>
                                <input class="form-control" placeholder="Verificar Contraseña" name="passwordnueva2" type="password" value="">
                            </div>
                            
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-block btn-lg btn-primary" onclick="cambiarContrasena(); return false;"><i class="fa fa-key"></i> Cambiar Contraseña</button>
                      </fieldset>
                    </form>
                  </div>
                </div>
        </div>
      </div>
    </section>
    
</div>




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



  function actualizarMisDatos(){
    var nombre = document.frmDatosPersonales.nombre.value;
    var apellido = document.frmDatosPersonales.apellido.value;
    var username = document.frmDatosPersonales.username.value;
     
    
    ajax = objetoAjax();

    ajax.open("POST", "usuario/actualizar_datos.php", true);
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          if(mensajeRespuesta == 'BIEN'){
            window.location.reload(true);
          }else{
            var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
            document.getElementById("mensajeFrmDatosPersonales").innerHTML = htmlAlerta;
          }
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("nombre="+nombre+"&apellido="+apellido+"&username="+username);
    
  }

  function cambiarContrasena(){
    var password = document.frmCambiarPassword.password.value;
    var passwordnueva = document.frmCambiarPassword.passwordnueva.value;
    var passwordnueva2 = document.frmCambiarPassword.passwordnueva2.value;

    

    
    ajax = objetoAjax();

    ajax.open("POST", "usuario/cambiarPassword.php", true);
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          if(mensajeRespuesta == 'BIEN'){
            window.location.reload(true);
          }else{
            var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
            document.getElementById("mensajeFrmCambiarPassword").innerHTML = htmlAlerta;
          }
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("password="+password+"&passwordnueva="+passwordnueva+"&passwordnueva2="+passwordnueva2);
    
  }

</script>



<?php
  include('pie.php');
?>