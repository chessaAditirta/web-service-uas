<?php
/*
 * PHP SOAP - How to create a SOAP Server and a SOAP Client
 */
$options = array('location' => 'http://localhost/projekUAS/server_pusat/crud/soapServer.php',
    'uri' => 'http://localhost/projekUAS/server_pusat/crud', "trace" => 1);
try {
    $client = new SoapClient(null, $options);
	$id_transaksi = $_POST['id_transaksi'];
    $id_kantor_cab = $_POST['id_kantor_cab'];
    $id_sales = $_POST['id_sales'];
    $id_barang = $_POST['id_barang'];
	$jumlah = $_POST['jumlah'];
	$tanggal = $_POST['tanggal'];
    $komen = $client->updateData($id_transaksi,$id_kantor_cab,$id_sales,$id_barang,$jumlah,$tanggal);
} catch (SoapFault $ex) {
    echo $client->__getLastResponse();
}
?>
<script type="text/javascript">
	alert('<?php echo $komen; ?>');
	window.location.href='index.php';
</script>