<?php
/********************************************************
 * PHP SOAP - How to create a SOAP Server and a SOAP Client
 **********************************************************/
$options = array('location' =>
    'http://localhost/projekUAS/server_pusat/crud/soapServer.php',
    'uri'  => 'http://localhost/projekUAS/server_pusat/crud/', "trace" => 1);
//create an instante of the SOAPClient (the API will be available)
?>
<center>
<?php
try {
    $client = new SoapClient(null, $options);
    echo "<h2>TRANSAKSI </h2>";
    echo "<td><a href='tambah.html'>Tambah</a></td>";
    $tran = $client->bacaData();
    echo '<table border=1>';
    echo "<tr><th>id_transaksi</th><th>id_kantor_cab</th><th>id_sales</th><th>id_barang</th><th>jumlah</th><th>tanggal</th>
	<th colspan=\"2\">Oparasi</th></tr>";
    foreach ($tran as $item) {
        echo "<tr>";
		echo "<td>" . $item['id_transaksi'] . "</td>";
        echo "<td>" . $item['id_kantor_cab'] . "</td>";
        echo "<td>" . $item['id_sales'] . "</td>";
        echo "<td>" . $item['id_barang'] . "</td>";
		echo "<td>" . $item['jumlah'] . "</td>";
		echo "<td>" . $item['tanggal'] . "</td>";
        echo "<td><a href='ubah.php?id=" . $item['id_transaksi'] .
            "'>Edit</a></td>";
        echo "<td><a href='hapus.php?id=" . $item['id_transaksi'] .
            "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (SoapFault $ex) {
    echo "<br>";
    echo $client->__getLastResponse();
}
?>
</center>