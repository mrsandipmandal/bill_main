<?php
require_once('config.php');

class MainPDO {
	public $db;
	public $variables;
	public function __construct($data = array()) {
		$this->db =  new ONS_PDO();	
		$this->variables  = $data;
	}
	public function __set($name,$value){
		if(strtolower($name) === $this->pk) {
			$this->variables[$this->pk] = $value;
		}
		else {
			$this->variables[$name] = $value;
		}
	}
	public function __get($name)
	{	
		if(is_array($this->variables)) {
			if(array_key_exists($name,$this->variables)) {
				return $this->variables[$name];
			}
		}
		return null;
	}
	public function save($id = "asd") {
		$this->variables[$this->pk] = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];
		$fieldsvals = '';
		$columns = array_keys($this->variables);
		foreach($columns as $column)
		{
			if($column !== $this->pk)
			$fieldsvals .= $column . " = :". $column . ",";
		}
		$fieldsvals = substr_replace($fieldsvals , '', -1);
		if(count($columns) > 1 ) {
			$sql = "UPDATE " . $this->table .  " SET " . $fieldsvals . " WHERE " . $this->pk . "= :" . $this->pk;
			if($id === "0" && $this->variables[$this->pk] === "0") { 
				unset($this->variables[$this->pk]);
				$sql = "UPDATE " . $this->table .  " SET " . $fieldsvals;
			}
			return $this->exec($sql);
			
		}
		return null;
	}
	public function create($fields=array()) { 
	if(!empty($fields)) {$this->variables=$fields;}
		$bindings = empty($fields) ? $this->variables : $fields;
		if(!empty($bindings)) {
			$fields     =  array_keys($bindings);
			$fieldsvals =  array(implode(",",$fields),":" . implode(",:",$fields));
			$sql 		= "INSERT INTO ".$this->table." (".$fieldsvals[0].") VALUES (".$fieldsvals[1].")";
		}
		else {
			$sql 		= "INSERT INTO ".$this->table." () VALUES ()";
		}
		return $this->exec($sql);
	}
	public function delete($id = "xyz") {
		$id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];
		if(!empty($id)) {
			$sql = "DELETE FROM " . $this->table . " WHERE " . $this->pk . "= :" . $this->pk. " LIMIT 1" ;
		}
		return $this->exec($sql, array($this->pk=>$id));
	}

	public function delete_all($id = "xyz") {
		$id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];
		if(!empty($id)) {
			$sql = "DELETE FROM " . $this->table . " WHERE " . $this->pk . "= :" . $this->pk. " " ;
		}
		return $this->exec($sql, array($this->pk=>$id));
	}
	public function find($id = "") {
		$id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];
		if(!empty($id)) {
			$sql = "SELECT * FROM " . $this->table ." WHERE " . $this->pk . "= :" . $this->pk . " LIMIT 1";	
			
			$result = $this->db->row($sql, array($this->pk=>$id));
			$this->variables = ($result != false) ? $result : null;
		}
	}
	
	public function search($fields = array(), $sort = array()) {
		$bindings = empty($fields) ? $this->variables : $fields;
		$sql = "SELECT * FROM " . $this->table;
		if (!empty($bindings)) {
			$fieldsvals = array();
			$columns = array_keys($bindings);
			foreach($columns as $column) {
				$fieldsvals [] = $column . " = :". $column;
			}
			$sql .= " WHERE " . implode(" AND ", $fieldsvals);
		}
		
		if (!empty($sort)) {
			$sortvals = array();
			foreach ($sort as $key => $value) {
				$sortvals[] = $key . " " . $value;
			}
			$sql .= " ORDER BY " . implode(", ", $sortvals);
		}
		return $this->exec($sql,$fields);
	}
	
		public function search_custom($fields = array(),$operator = array(),$limit="", $sort = array()) {
		$bindings = empty($fields) ? $this->variables : $fields;
		$sql = "SELECT * FROM " . $this->table;
		if (!empty($bindings)) {
			$fieldsvals = array();
			$columns = array_keys($bindings);
			foreach($columns as $column) {
				if(!empty($operator))
				{
					$logic=explode(",",$operator[$column]);
					if($logic[0]=="FIND_IN_SET")
					{
					$fieldsvals [] = $logic[0]."(:".$column.",". $column.")>0 ".$logic[1];	
					}
					elseif($logic[0]=="IN")
					{
					$fieldsvals [] = "FIND_IN_SET(".$column.",:". $column.")>0 ".$logic[1];	
					}
					elseif($logic[0]=="BETWEEN")
					{
					$vls=explode("#",$fields[$column]);
					$fields[$column]=$vls[0];
					$fields['to_date']=$vls[1];
					$fieldsvals [] =  $column." ".$logic[0]." :".$column." AND :to_date ".$logic[1];	
					}
					else
					{
						$fieldsvals [] = $column." ".$logic[0]. " :". $column." ".$logic[1];
					}
				}
				else
				{
				$fieldsvals [] = $column . " = :". $column;
				}
			}
			
				if(!empty($operator))
				{
					$sql .= " WHERE " . implode(" ", $fieldsvals);
				}
				else
				{
					$sql .= " WHERE " . implode(" AND ", $fieldsvals);
				}
		}
		
		$bindings = empty($fields) ? $this->variables : $fields;
		if (!empty($sort)) {
			$sortvals = array();
			foreach ($sort as $key => $value) {
				$sortvals[] = $key . " " . $value;
			}
			$sql .= " ORDER BY " . implode(", ", $sortvals);
			
			
		}
		$sql .=" ".$limit;
		
		//return $sql.implode(" ",$fields);
		
		return $this->exec($sql,$fields);
		
	}
	
	public function sum_value_custom($fld,$fields = array(), $operator = array()) {
		$bindings = empty($fields) ? $this->variables : $fields;
		$sql = "SELECT SUM(".$fld.") FROM " . $this->table;
		if (!empty($bindings)) {
			$fieldsvals = array();
			$columns = array_keys($bindings);
			foreach($columns as $column) {
				if(!empty($operator))
				{
					$logic=explode(",",$operator[$column]);
				$fieldsvals [] = $column." ".$logic[0]. " :". $column." ".$logic[1];
				}
				else
				{
				$fieldsvals [] = $column . " = :". $column;
				}
			}
			
				if(!empty($operator))
				{
					$sql .= " WHERE " . implode(" ", $fieldsvals);
				}
				else
				{
					$sql .= " WHERE " . implode(" AND ", $fieldsvals);
				}
		}
		return $this->db->single($sql,$fields);
	}
	
	public function search_value($fld,$fields = array(), $sort = array()) {
		$bindings = empty($fields) ? $this->variables : $fields;
		$sql = "SELECT ".$fld." FROM " . $this->table;
		if (!empty($bindings)) {
			$fieldsvals = array();
			$columns = array_keys($bindings);
			foreach($columns as $column) {
				$fieldsvals [] = $column . " = :". $column;
			}
			$sql .= " WHERE " . implode(" AND ", $fieldsvals);
		}
		
		if (!empty($sort)) {
			$sortvals = array();
			foreach ($sort as $key => $value) {
				$sortvals[] = $key . " " . $value;
			}
			$sql .= " ORDER BY " . implode(", ", $sortvals);
		}
		return $this->db->single($sql,$fields);
	}
	
	public function get_value($table,$fld,$fields = array(), $sort = array()) {
		$bindings = empty($fields) ? $this->variables : $fields;
		$sql = "SELECT ".$fld." FROM " . $table;
		if (!empty($bindings)) {
			$fieldsvals = array();
			$columns = array_keys($bindings);
			foreach($columns as $column) {
				$fieldsvals [] = $column . " = :". $column;
			}
			$sql .= " WHERE " . implode(" AND ", $fieldsvals);
		}
		
		if (!empty($sort)) {
			$sortvals = array();
			foreach ($sort as $key => $value) {
				$sortvals[] = $key . " " . $value;
			}
			$sql .= " ORDER BY " . implode(", ", $sortvals);
		}
		return $this->db->single($sql,$fields);
	}
	
	public function raw_query($sql,$fields = array()) {
		$bindings = empty($fields) ? $this->variables : $fields;
	
	return $this->exec($sql,$fields);	
		
	}
	public function row_count($sql,$fields = array()) {
		$bindings = empty($fields) ? $this->variables : $fields;
	
	return $this->db->single($sql,$fields);	
		
	}
	public function row_count_custom($fields = array(),$operator = array(),$limit="") {
		$bindings = empty($fields) ? $this->variables : $fields;
		$sql = "SELECT count(*) FROM " . $this->table;
		if (!empty($bindings)) {
			$fieldsvals = array();
			$columns = array_keys($bindings);
			foreach($columns as $column) {
				if(!empty($operator))
				{
				$logic=explode(",",$operator[$column]);
				
				if($logic[0]=="BETWEEN")
					{
					$vls=explode("#",$fields[$column]);
					$fields[$column]=$vls[0];
					$fields['to_date']=$vls[1];
					$fieldsvals [] =  $column." ".$logic[0]." :".$column." AND :to_date ".$logic[1];	
					}
				else{
				$fieldsvals [] = $column." ".$logic[0]. " :". $column." ".$logic[1];
				}
				}
				else
				{
				$fieldsvals [] = $column . " = :". $column;
				}
			}
			
				if(!empty($operator))
				{
					$sql .= " WHERE " . implode(" ", $fieldsvals);
				}
				else
				{
					$sql .= " WHERE " . implode(" AND ", $fieldsvals);
				}
		}
		$sql .=" ".$limit;
		//return $sql;
		return $this->db->single($sql,$fields);
	}

			public function search_custom_ultra($fields = array(),$operator = array(),$limit="", $sort = array(),$custom_fild=array('*')) {
		$bindings = empty($fields) ? $this->variables : $fields;
		$custom_fild=implode(",", $custom_fild);
		$sql = "SELECT ".$custom_fild." FROM " . $this->table;
		if (!empty($bindings)) {
			$fieldsvals = array();
			$columns = array_keys($bindings);
			foreach($columns as $column) {
				if(!empty($operator))
				{
					$logic=explode(",",$operator[$column]);
					if($logic[0]=="FIND_IN_SET")
					{
					$fieldsvals [] = $logic[0]."(:".$column.",". $column.")>0 ".$logic[1];	
					}
					elseif($logic[0]=="IN")
					{
					$fieldsvals [] = $column." ".$logic[0]." (:".$column.") ".$logic[1];	
					}
					else
					{
						$fieldsvals [] = $column." ".$logic[0]. " :". $column." ".$logic[1];
					}
				}
				else
				{
				$fieldsvals [] = $column . " = :". $column;
				}
			}
			
				if(!empty($operator))
				{
					$sql .= " WHERE " . implode(" ", $fieldsvals);
				}
				else
				{
					$sql .= " WHERE " . implode(" AND ", $fieldsvals);
				}
		}
		
		if (!empty($sort)) {
			$sortvals = array();
			foreach ($sort as $key => $value) {
				$sortvals[] = $key . " " . $value;
			}
			$sql .= " ORDER BY " . implode(", ", $sortvals);
			
			
		}
		$sql .=" ".$limit;
		//return $sql.implode(" ",$fields);
		return $this->exec($sql,$fields);
	}	
	

	public function all(){
		return $this->db->query("SELECT * FROM " . $this->table);
	}
	
	public function min($field)  {
		if($field)
		return $this->db->single("SELECT min(" . $field . ")" . " FROM " . $this->table);
	}
	public function max($field)  {
		if($field)
		return $this->db->single("SELECT max(" . $field . ")" . " FROM " . $this->table);
	}
	public function avg($field)  {
		if($field)
		return $this->db->single("SELECT avg(" . $field . ")" . " FROM " . $this->table);
	}
	public function sum($field)  {
		if($field)
		return $this->db->single("SELECT sum(" . $field . ")" . " FROM " . $this->table);
	}
	public function count($field)  {
		if($field)
		return $this->db->single("SELECT count(" . $field . ")" . " FROM " . $this->table);
	}	
	
	public function send_sms($mob,$message)
		{
	
//Please Enter Your Details
		$user="dmndia"; //your username
		$key="cb527714a1XX";
		$accusage="1";
		$mobilenumbers=$mob; //enter Mobile numbers comma seperated
		$senderid="DMNDIA"; //Your senderid
		$messagetype="N"; //Type Of Your Message
		//$url="http://onssms.onnetsolution.com/submitsms.jsp?";
		$url="http://103.233.79.246/submitsms.jsp?";
		//domain name: Domain name Replace With Your Domain  
		$message = urlencode($message);
		$postdata = "user=$user&key=$key&mobile=$mobilenumbers&message=$message&senderid=$senderid&accusage=$accusage";
		//echo $url.$postdata;
		$ch = curl_init($url.$postdata);
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
		// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");



		$curlresponse = curl_exec($ch); // execute
		if(curl_errno($ch))
		//echo 'curl error : '. curl_error($ch);
		//echo "Failed to send SMS";
		if (empty($ret)) {
		// some kind of an error happened
		die(curl_error($ch));
		curl_close($ch); // close cURL handler
		} else {
		$info = curl_getinfo($ch);
		curl_close($ch); // close cURL handler
  
   
		}

		}
	
	
	
	
	
	private function exec($sql, $array = null) {
		
		if($array != null) {
			$result =  $this->db->query($sql, $array);	
		}
		else {
			$result =  $this->db->query($sql, $this->variables);	
		}
		// Empty bindings
		$this->variables = array();
		return $result;
	}
	
	
	
}
?>