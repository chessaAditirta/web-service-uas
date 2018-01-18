<?php
/*
 * PHP SOAP - How to create a SOAP Server and a SOAP Client
 */
$options = array('location' => 'http://localhost/projekUAS/server_pusat/crud/soapServer.php',
    'uri' => 'http://localhost/projekUAS/server_pusat/crud/', "trace" => 1);
//create an instante of the SOAPClient (the API will be available)
$id_transaksi = $_GET['id'];
try {
    $client = new SoapClient(null, $options);
    $tran    = $client->bacaUbah($id_transaksi);
    foreach ($tran as $item) {
		$id_transaksi    = $item['id_transaksi'];
        $id_kantor_cab    = $item['id_kantor_cab'];
        $id_sales   = $item['id_sales'];
        $id_barang = $item['id_barang'];
		$jumlah = $item['jumlah'];
		$tanggal = $item['tanggal'];
    }
} catch (SoapFault $ex) {
    echo "<br>";
    echo $client->__getLastResponse();
}?>
<center>
<h2>Ubah Data Transaksi</h2>
<table>
	<form action="update.php" method="post">
		<tr>
			<td>ID TRANSAKSI</td>
			<td><input type="text" name="id_transaksi" value= "<?php echo $id_transaksi; ?>"> </td>
		</tr>
		<tr>
		<tr>
			<td>ID KANTOR CABANG</td>
			<td><input type="text" name="id_kantor_cab" value= "<?php echo $id_kantor_cab; ?>"> </td>
		</tr>
		<tr>
			<td>ID SALES</td>
			<td><input type="text" name="id_sales" value= "<?php echo $id_sales; ?>"> </td>
		</tr>
		<tr>
			<td>ID BARANG</td>
			<td><input type="text" name="id_barang" value="<?php echo $id_barang; ?>"><td>
		</tr>
		<tr>
		<tr>
			<td>JUMLAH</td>
			<td><input type="text" name="jumlah" value="<?php echo $jumlah; ?>"><td>
		</tr>
		<tr>
		<tr>
			<td>TANGGAL</td>
			<td><input type="text" name="tanggal" value="<?php echo $tanggal; ?>"><td>
		</tr>
		<tr>
			<td><input type="submit" value="Update"></td>
		</tr>
	</form>
</table>
<a href='index.php'>Kembali</a>
</center>