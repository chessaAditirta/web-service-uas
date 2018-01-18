<?php
/*
 * PHP SOAP - How to create a SOAP Server and a SOAP Client
 */
$options = array('location' => 'http://localhost/projekUAS/server_pusat/crud/soapServer.php',
    'uri' => 'http://localhost/projekUAS/server_pusat/crud/', "trace" => 1);
try {
    $client = new SoapClient(null, $options);
    $id_transaksi    = $_GET['id'];
    $komen  = $client->hapusData($id_transaksi);
} catch (SoapFault $ex) {
    echo $client->__getLastResponse();
}
?>
<script type="text/javascript">
	alert('<?php echo $komen; ?>');
	window.location.href='index.php';
</script>