<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$objv= new ventas();


	$c=new conectar();
	$conexion= $c->conexion();	
	$idventa=$_GET['idventa'];

 $sql="SELECT ve.id_venta,
		ve.fechaCompra,
		ve.id_cliente,
		art.nombre,
        art.precio,
        art.descripcion
	from ventas  as ve 
	inner join articulos as art
	on ve.id_producto=art.id_producto
	and ve.id_venta='$idventa'";

$result=mysqli_query($conexion,$sql);

	$ver=mysqli_fetch_row($result);

	$folio=$ver[0];
	$fecha=$ver[1];
	$idcliente=$ver[2];

 ?>	

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Reporte de venta</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
	 <style>
table {
  width:100%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
	 </style>
 </head>
 <body>
 		<img src="../../img/logo1.jpg" width="150" height="150">
 		<br>  
 		<table class="table">
		 	<tr>
 				<th style="text-align:center; background:#032E60; color:white">Master Computer</th>
 			</tr>
 			<tr>
 				<td>Fecha: <?php echo $fecha; ?></td>
 			</tr>
 			<tr>
 				<td>cliente: <?php echo $objv->nombreCliente($idcliente); ?></td>
 			</tr>
			 <tr>
 				<td>Folio: <?php echo $folio ?></td>
 			</tr>
 		</table>


 		<table class="table">
 			<tr style="background:#032E60; color:white">
 				<td>Producto</td>
 				<td>Descripción</td>
 				<td>Cantidad</td>
 				<td>Precio</td>
 			</tr>

 			<?php 
 			$sql="SELECT ve.id_venta,
						ve.fechaCompra,
						ve.id_cliente,
						art.nombre,
				        art.precio,
				        art.descripcion
					from ventas  as ve 
					inner join articulos as art
					on ve.id_producto=art.id_producto
					and ve.id_venta='$idventa'";

			$result=mysqli_query($conexion,$sql);
			$total=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

 			<tr>
 				<td><?php echo $ver[3]; ?></td>
 				<td><?php echo $ver[5]; ?></td>
 				<td>1</td>
 				<td style="text-align:right"><?php echo $ver[4]." €"; ?></td>
 			</tr>
 			<?php 
 				$total=$total + $ver[4];
 			endwhile;
 			 ?>
 			 <tr>
 			 	<td style="text-align:right" colspan="4">Total =  <?php echo $total." €"; ?></td>
 			 </tr>
 		</table>
 </body>
 </html>