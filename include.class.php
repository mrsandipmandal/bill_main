<?php
require_once("common.php");
	class Init_Table Extends MainPDO {
		
			protected $table='';
			protected $pk='';
		
			public function set_table($table, $pk)
    {
    $this->table=$table;
    $this->pk=$pk;
	}
	}


?>