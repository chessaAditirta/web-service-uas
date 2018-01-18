<?php
/**********************************************************
 * PHP SOAP - How to create a SOAP Server and a SOAP Client
 *******************************************************/
require_once('../adodb5/adodb.inc.php'); 
require_once('../adodb5/adodb-active-record.inc.php'); 

//koneksi ke database
 $db = NewADOConnection('mysqli');
 $db->Connect('localhost', 'root', '', 'projek_uas_pusat');
   
class Crud {
 //methode tambah data 
 function tambahData($id_transaksi,$id_kantor_cab,$id_sales,$id_barang,$jumlah,$tanggal)
 {
  $tran=new Transaksi;
  $tran->id_transaksi=$id_transaksi;
  $tran->id_kantor_cab=$id_kantor_cab;
  $tran->id_sales=$id_sales;
  $tran->id_barang=$id_barang;
  $tran->jumlah=$jumlah;
  $tran->tanggal=$tanggal;
  if ($tran->save()==1)
  {
 return "Berhasil di simpan";
  }
  else
 return "Ada error, Gagal Menyimpan";
  }
 
  // methode updateData
  function updateData($id_transaksi,$id_kantor_cab,$id_sales,$id_barang,$jumlah,$tanggal)
  {
   $tran=new ADOdb_Active_Record("transaksi");
   $tran->id_transaksi=$id_transaksi;
   $tran->id_kantor_cab=$id_kantor_cab;
   $tran->id_sales=$id_sales;
   $tran->id_barang=$id_barang;
   $tran->jumlah=$jumlah;
   $tran->tanggal=$tanggal;
   $ok = $tran->replace(); // 0=failure, 1=update, 2=insert

   if ($ok==1)
  return "Berhasil diubah";
   else 
  return "gagal di ubah";
   }
   
  //methode baca data
  function bacaData()
  {
     $db = NewADOConnection('mysqli');
     $db->Connect('localhost', 'root', '', 'projek_uas_pusat');
        
     $rs = $db->Execute("SELECT * FROM transaksi ");
     $result = $rs->GetArray(); 
     
    foreach($result as $row=>$value)
      { 
         $return_value[] = array(
						  'id_transaksi'=> $value['id_transaksi'],
                          'id_kantor_cab'=> $value['id_kantor_cab'],
                          'id_sales'=> $value['id_sales'],
                          'id_barang'=> $value['id_barang'],
						  'jumlah'=> $value['jumlah'],
						  'tanggal'=> $value['tanggal']
        );   
   }
  return $return_value;  
    }
  
  //methode baca dan mengubah data
  function bacaUbah($id_transaksi)
  {
     $db = NewADOConnection('mysqli');
     $db->Connect('localhost', 'root', '', 'projek_uas_pusat');
        
     $rs = $db->Execute("SELECT * FROM transaksi WHERE id_transaksi='".$id_transaksi."'");
     $result = $rs->GetArray();
     
    foreach($result as $row=>$value)
      { 
         $return_value[] = array(
						  'id_transaksi'=> $value['id_transaksi'],
                          'id_kantor_cab'=> $value['id_kantor_cab'],
                          'id_sales'=> $value['id_sales'],
                          'id_barang'=> $value['id_barang'],
						  'jumlah'=> $value['jumlah'],
						  'tanggal'=> $value['tanggal']
        );   
   }
  return $return_value;  
    }
  
  //methode hapus data
  function hapusData($id_transaksi)
    {
     $db = NewADOConnection('mysqli');
     $db->Connect('localhost', 'root', '', 'projek_uas_pusat');
        
     $rs = $db->Execute("DELETE FROM transaksi WHERE id_transaksi='".$id_transaksi."'");
  if (!$rs) {
  return "Data tidak berhasil dihapus" ;
  }
     else  
   return "Data berhasil dihapus" ;
 }
}

ADOdb_Active_Record::SetDatabaseAdapter($db,'mConnection');

// menciptakan kelas Transaksi ke tabel transaksi
 
class Transaksi extends ADOdb_Active_Record
{
   public $_dbat = 'mConnection';  
   public $_table = 'transaksi';
}
 

//when in non-wsdl mode the uri option must be specified
$options=array('uri'=>'http://localhost/projekUAS/server_pusat/crud/');

//create a new SOAP server
$server = new SoapServer(NULL,$options);

//attach the API class to the SOAP Server
$server->setClass('Crud');

//start the SOAP requests handler
$server->handle();
?> 