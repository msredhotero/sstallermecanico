<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Dashboard",$_SESSION['refroll_predio'],'');



?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Taller Mecanico</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>




    
   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">

<h3>Dashboard</h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Bienvenido</p>
        	
        </div>
    	<div class="cuerpoBox">
    		<h3>Sistema de Gestión de Talleres</h3>
    	</div>
    </div>
    
    
    
    
    
   
</div>


</div>




<script type="text/javascript">
$(document).ready(function(){
	
	$('#buscar').click(function(e) {
        $.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						reffecha: $('#reffecha').val(),
						zona: $('#refzona option:selected').text(),
						accion: 'traerResultadosPorTorneoZonaFecha'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#resultados').html(response);
						
				}
		});
		
		
		$.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						zona: $('#refzona option:selected').text(),
						reffecha: $('#reffecha').val(),
						accion: 'TraerFixturePorZonaTorneo'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#posiciones').html(response);
						
				}
		});
		
		
		$.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						zona: $('#refzona option:selected').text(),
						reffecha: $('#reffecha').val(),
						accion: 'Goleadores'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#goleadores').html(response);
						
				}
		});
		
		$.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						reffecha: $('#reffecha').val(),
						zona: $('#refzona option:selected').text(),
						accion: 'Suspendidos'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#suspendidos').html(response);
						
				}
		});
		
		$.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						reffecha: $('#reffecha').val(),
						zona: $('#refzona option:selected').text(),
						accion: 'AmarillasAcumuladas'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#amarillas').html(response);
						
				}
		});
		
		$.ajax({
				data:  {reftorneo: $('#reftorneo').val(),
						refzona: $('#refzona').val(),
						reffecha: $('#reffecha').val(),
						zona: $('#refzona option:selected').text(),
						accion: 'FairPlay'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#fairplay').html(response);
						
				}
		});
    });
	
	 $( '#dialogDetalle' ).dialog({
		autoOpen: false,
		resizable: false,
		width:800,
		height:740,
		modal: true,
		buttons: {
			"Ok": function() {
				$( this ).dialog( "close" );
			}
		}
	});

	 $( '#dialog2' ).dialog({
		autoOpen: false,
		resizable: false,
		width:800,
		height:740,
		modal: true,
		buttons: {
			"Ok": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	

});
</script>
<?php } ?>
</body>
</html>
