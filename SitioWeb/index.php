<?php

include('cabecera.php');

if(isset($_SESSION['IDUSUARIO'])==''){
  header('Location: login.php');
}else{
  
}


?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Inicio
            <small>Control de Acceso Remoto para Laboratorios y Oficinas</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

          
          <div class="row" id="contenidoLaboratorios">

           



          </div>

          



        

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

  function mostrarLaboratorios(){
    var rol = $('#rolOculto').val();
    
    if(rol==1){
        laboratoriosAdministrador();
    }else{
      laboratoriosUsuario();
    }
  }

  function laboratoriosUsuario(){

    
    ajax = objetoAjax();

    ajax.open("POST", "laboratorio/laboratorios_usuario.php", true);

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          document.getElementById("contenidoLaboratorios").innerHTML = mensajeRespuesta;
          
        }
      }
      ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      ajax.send();
      

    }

     function laboratoriosAdministrador(){
    
      ajax = objetoAjax();

      ajax.open("POST", "laboratorio/laboratorios_administrador.php", true);

      ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
            var mensajeRespuesta = ajax.responseText;

            document.getElementById("contenidoLaboratorios").innerHTML = mensajeRespuesta;
            
          }
        }
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        ajax.send();
        

      }

      function guardarregistro(rutaPulso, idlaboratorio){

        ajax = objetoAjax();

        ajax.open("POST", "laboratorio/enviar_pulso.php", true);

        ajax.onreadystatechange=function() {
            if (ajax.readyState==4) {
              
              
            }
          }
          ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
          ajax.send('rutaPulso='+rutaPulso+"&idlaboratorio="+idlaboratorio);
      }



</script>


<?php
include('pie.php');
?>  