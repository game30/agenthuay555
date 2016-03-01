<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
class moneyTransfer{

	var $conn = null;

	public function __construct(){
		if ( !isset($site_url) ){
			include (dirname(__FILE__)."/../config/config.inc.php");
		}
		include (dirname(__FILE__)."/../config/config_db.php");

		if ( class_exists("connect_db") ){
			$dbconnection = new connect_db();
			$this->conn = $dbconnection->conn();
		}  else{
			exit("no connection");
		}
	}

	public function transfer_customer_list(){

		$sql = "SELECT tb_customer_transfer.*, tb_member.*, tb_bank.* FROM tb_customer_transfer LEFT JOIN tb_member ON tb_customer_transfer.m_id=tb_member.id LEFT JOIN tb_bank ON tb_customer_transfer.bank_id=tb_bank.b_id  WHERE transfer_id = 0 ORDER BY tb_customer_transfer.cs_transfer_date DESC";

		$result = $this->conn->query($sql);
		
		$data = array();
		$item = 0;
		if ( $result->num_rows > 0 ){
			while ( $value = $result->fetch_array() ){
				$data[$item++] = $value;
			}
		}
		$result->free_result();
		return $data;
	}

	public function transfer_customer_info($cs_transfer_id){

		$sql = "SELECT *, (SELECT tb_member.username FROM tb_member WHERE tb_member.id = tb_customer_transfer.m_id ) as username FROM tb_customer_transfer WHERE cs_transfer_id = $cs_transfer_id";

		$result = $this->conn->query($sql);
		$data = $result->fetch_array();
		$result->free_result();
		return $data;
	}



	public function transfer_bank_by_id($bankID, $cs_transfer_id = null){
		$sql = "SELECT *, (SELECT b_name FROM tb_bank WHERE tb_bank.b_id = tb_bank_transfer.bank_id) as bankname, (SELECT b_number FROM tb_bank WHERE tb_bank.b_id = tb_bank_transfer.bank_id) as bankaccount FROM tb_bank_transfer WHERE bank_id = $bankID AND cs_transfer_id = 0";

		if ( $cs_transfer_id != null ){
			$sql = $sql." AND bk_transfer_amount = (SELECT cs_transfer_amount FROM tb_customer_transfer WHERE cs_transfer_id = $cs_transfer_id) ";
		}

		$result = $this->conn->query($sql);

		$data = array();
		$item = 0;
		if ( $result->num_rows > 0 ){
			while ( $value = $result->fetch_array() ){
				$data[$item++] = $value;
			}
		}
		$result->free_result();

		return $data;
	}


	public function transfer_match($bk_transfer_id, $cs_transfer_id, $money_amount, $customer_id){
		// Set bank transfer here
		$sql = "UPDATE tb_bank_transfer SET cs_transfer_id = $cs_transfer_id, bk_transfer_status = 1 WHERE bk_transfer_id = $bk_transfer_id;";
		// Set customer transfer here
		$sql = $sql ." UPDATE tb_customer_transfer SET transfer_id = $bk_transfer_id, cs_transfer_status = 1 WHERE cs_transfer_id = $cs_transfer_id;";

		// Refund Statement Here
		//$sql = $sql ." UPDATE tb_refund SET re_credit = (tb_refund.re_credit + $money_amount) WHERE re_to_m_id = $customer_id;";
	
		if ( !$result = $this->conn->multi_query($sql)) {
			$data['error']['code'] = $this->conn->errno;
			$data['error']['message'] =  $this->conn->error;
		} else {
			$data['error']['code'] =  1;
			$data['error']['message'] = "updated";
		}

		return $data;
	}

	public function transfer_delete( $cs_transfer_id ){
		include (dirname(__FILE__)."/../config/config.inc.php");
		$picture = $this->transfer_customer_info($cs_transfer_id);
		
		if ( !empty($picture) ){
			$list = glob($slipPicturePath."*".$picture['cs_tranfer_file']);
			foreach ( $list as $image ) {
				//echo $image;
				if ( file_exists($image) ){
					unlink($image);
				}
			}
		}

		$sql = "DELETE FROM tb_customer_transfer WHERE cs_transfer_id = $cs_transfer_id;";
		if ( !$result = $this->conn->multi_query($sql)) {
			$data['error']['code'] = $this->conn->errno;
			$data['error']['message'] =  $this->conn->error;
		} else {
			$data['error']['code'] =  1;
			$data['error']['message'] = "deleted";
		}
		
		return $data;
		
	}

}
?>