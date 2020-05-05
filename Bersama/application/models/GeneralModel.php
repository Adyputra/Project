<?php
/**
 *
 */
class GeneralModel extends CI_Model
{
  public function getData($tabel, $key=""){
    $query = "";
    if($tabel == "getbanner"){
     
    } else{
      $query = "SELECT * FROM ".$tabel." WHERE status = '1'";
    }
      $db_result = $this->db->query($query);
      $result_object = $db_result->result_array();
      return $result_object;
  }

  public function getDataSingle($tabel, $key){
    $query = "";
    if($tabel == "detailpesanan"){
      $query = "SELECT a.*, b.*, c.nama, d.* from penjualan a 
      left join tbkalender b on a.id_kalender=b.id_kalender  
      left join tbcustomer c on a.id_customer=c.id  
      left join akunbank d on a.kode_akunbank=d.kode_akunbank 
      where a.kode_penjualan='$key'";
    }else{
      $query = "SELECT * FROM ".$tabel." WHERE status != '0'";
    }
      $db_result = $this->db->query($query);
      $result_object = $db_result->row_array();
      return $result_object;
  }

  public function insertData($tabel, $arr){
    $cek = $this->db->insert($tabel, $arr);
    return $cek;
  }
  public function updateData($tabel, $arr, $id, $key){
    $cek = $this->db->update($tabel, $arr, [$key => $id]);
    return $cek;
  }
  public function deleteData($tabel, $key, $id){
    $cek = $this->db->delete($tabel, [$key => $id]);
    return $cek;
  }

  function random_number($maxlength)
  {
    $chary = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $return_str = "";
    for ($x = 0; $x < $maxlength; $x++) {
      $return_str .= $chary[rand(0, count($chary) - 1)];
    }
    return $return_str;
  }
  function random_semua($maxlength) {
    $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                    "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $return_str = "";
    for ( $x=0; $x<$maxlength; $x++ ) {
        $return_str .= $chary[rand(0, count($chary)-1)];
    }
    return $return_str;
  }

  public function kirimemail($email, $subject, $pesan)
  {
    $config = array(
    'protocol' => 'smtp',
    'smtp_host' => "mail.evoindo.com",
    'smtp_port' => 465,
    'smtp_user' => "silaper@evoindo.com",
    'smtp_pass' => "silaper2020",
    'mailtype' => 'html',
    'smtp_crypto' => 'ssl',
    'charset' => 'iso-8859-1'
    );


    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");

    $this->email->from("silaper@evoindo.com", $subject);
    $this->email->to($email);
    $this->email->cc("silaper@evoindo.com");

    $this->email->subject($subject);
    $this->email->message($pesan);

      $kirim = $this->email->send();
      return $kirim;
    }


}
