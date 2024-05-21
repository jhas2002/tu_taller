<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<style>
	@page {
		margin-left: 0;
		margin-right: 0;
		margin-top: 0;
	}
	table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 15px;
}
</style>
<body>
	<div>
		<img src="<?php echo base_url('sources/images/logo.jpg') ?>" style="position: absolute; text-align: center; top: 2%; left: 2%; width:100px;">
		<div style="position: absolute; top: 2%; left: 41%; text-align: center;">
			<h1>COTIZACIÓN</h1>
		</div>
		<div style="position: absolute; top: 3.5%; left: 80%;">
			<h3>Fecha: <spam style="font-weight: normal;"><?php echo $fecha ?></spam></h3>
		</div>
		<div style="position: absolute; text-align: left; top: 15%; left: 2%; width:325px;">
			<h3 style="background: #A0DED6; text-align: center;">TALLER</h3>
			<h4>Nombre: <spam style="font-weight: normal;"><?php echo $nombreTaller ?></spam></h4>
			<h4>Dirección: <spam style="font-weight: normal;"><?php echo $direccion ?></spam></h4>
			<h4>Teléfono : <spam style="font-weight: normal;"><?php echo $telefono ?></spam></h4>
			<h4>Email: <spam style="font-weight: normal;"><?php echo $emailT ?></spam></h4>
		</div>
		<div style="position: absolute; text-align: left; top: 15%; left: 70%; width:325px;">
			<h3 style="background: #A0DED6; text-align: center;">CLIENTE</h3>
			<h4>Nombre: <spam style="font-weight: normal;"><?php echo $nombre ?></spam></h4>
			<h4>Teléfono: <spam style="font-weight: normal;"><?php echo $celular ?></spam></h4>
			<h4>Email: <spam style="font-weight: normal;"><?php echo $emailC ?></spam></h4>
		</div>
		<div style="position: absolute; top: 50%; left: 2%; width: 98%; text-align: center; align-items: center; align-content: center;">
			<table style="text-align: center; align-items: center; width: 98%;">
				<thead>
					<tr>
						<th>Servicio</th>
						<th>Solución</th>
						<th>Tiempo</th>
						<th>Costo</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $servicio ?></td>
						<td><?php echo $solucion ?></td>
						<td><?php echo $tiempo ?></td>
						<td><?php echo $costo ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="position: absolute; top: 70%; left: 2%; width: 98%; text-align: center; align-items: center;">
			<p>Gracias por escoger nuestro taller para su cotización esperemos verlo en el taller próximamente</p>
		</div>
</body>
</html>
