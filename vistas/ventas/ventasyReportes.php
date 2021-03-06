<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";
	$c= new conectar();
	$conexion = $c->conexion();
	$obj= new ventas();

	$sql="SELECT id_venta,fechaCompra,id_cliente,usuarios.nombre from ventas,usuarios WHERE ventas.id_usuario = usuarios.id_usuario group by id_venta ORDER BY id_venta DESC 	";
	$result=mysqli_query($conexion,$sql);
 ?>
<h4>Reportes y ventas</h4>
<div class="row">
	
	
		<div >
		<table class="table table-hover table-condensed table-bordered" id="iddatatable">
			<thead style="background-color: #dc3545;color: white; font-weight: bold;">
				<tr>
					<td>Folio</td>
					<td>Fecha</td>
					<td>Atendido por</td>
					<td>Cliente</td>
					<td>Total</td>
					<td>Ticket</td>
					<td>Reporte</td>
				</tr>
			</thead>
				
				<tfoot style="background-color:#ccc; color: white; font-weight:bold;">
				<tr>
					<td>Folio</td>
					<td>Fecha</td>
					<td>Atendido por</td>
					<td>Cliente</td>
					<td>Total</td>
					<td>Ticket</td>
					<td>Reporte</td>
					</tr>
				
				</tfoot>
				<tbody >
				<?php  while ($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0]; ?></td>
					<td><?php echo $ver[1]; ?></td>
					<td><?php echo $ver[3]; ?></td>
					<td><?php 
							if ($obj->nombreCliente($ver[2])==" ") {
								echo "S/C No aplica";
							}
							else{
								echo $obj->nombreCliente($ver[2]) ;
							}
						 ?></td>
					<td><?php 
							echo "$" . $obj->obtenerTotal($ver[0]);
					 ?></td>
					<td>
						<a href="../procesos/ventas/crearTicketPdf.php?idventa=<?php echo $ver[0] ?>" class="btn btn-link ">
							<i class="fa fa-ticket fa-2x" aria-hidden="true"></i>
						</a>
					</td>
					<td>
						<a href="../procesos/ventas/crearReportePdf.php?idventa=<?php echo $ver[0] ?>" class="btn btn-success btn-sm">
							<i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
						</a>
				</tr>
			<?php endwhile; 
			?>
			</tbody>
			</table>
		</div>
	
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#iddatatable').DataTable({
		"order": [[ 3, "desc" ]]
	});
} );
</script>