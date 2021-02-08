<?php
require("create_log.php");
class ONS_PDO
{
    public $servername;
	public $username;
	public $password;
	public $requiredLevel;
	public $conn;
	public $isConnected = false;
    private $sQuery;
    private $settings;
    private $parameters;	
    private $log;
    public function __construct()
    {
        $this->log = new Write_Log();
		
		$this->Connect();
		

    }
private function Connect()
	{
		       $dsn            = 'mysql:dbname=trn;host=localhost';
        try {
            # Read settings from INI file, set UTF8
            $this->conn = new PDO($dsn, 'root', '', array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
				PDO::ATTR_PERSISTENT => false
            ));
            
            # We can now log any exceptions on Fatal error. 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            # Disable emulation of prepared statements, use REAL prepared statements instead.
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            # Connection succeeded, set the boolean to true.
            $this->isConnected = true;
        }
        catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
	}
	
	
	
	public function CloseConnection()
    {
        $this->conn = null;
    }
	
	private function Init($query, $parameters =  "")
    {
        if (!$this->isConnected) {
            $this->Connect();
        }
        try {
            $this->sQuery = $this->conn->prepare($query);
            $this->bindMore($parameters);
            if (!empty($this->parameters)) {
                foreach ($this->parameters as $param => $value) {
					//echo $value[0]." ".$value[1];
                    if(is_int($value[1])) {
                        $type = PDO::PARAM_INT;
                    } else if(is_bool($value[1])) {
                        $type = PDO::PARAM_BOOL;
                    } else if(is_null($value[1])) {
                        $type = PDO::PARAM_NULL;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    $this->sQuery->bindValue($value[0], $value[1], $type);
                }
            }
            
            $this->sQuery->execute();
        }
        catch (PDOException $e) {
            echo $this->ExceptionLog($e->getMessage(), $query);
            die();
        }
        $this->parameters = array();
    }
    public function bind($para, $value)
    {
			if(!$this->parameters)
			{
				$this->parameters[0] = array(":" . $para , $value);
			}
			else
			{
        $this->parameters[sizeof($this->parameters)] = array(":" . $para , $value);
			}
    }
	public function bindMore($parray)
    {
        if (empty($this->parameters) && is_array($parray)) {
            $columns = array_keys($parray);
            foreach ($columns as $i => &$column) {
                $this->bind($column, $parray[$column]);
            }
        }
    }
	    public function query($query, $params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $query = trim(str_replace("\r", " ", $query));
        
        $this->Init($query, $params);
        
        $rawStatement = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $query));
        
        $statement = strtolower($rawStatement[0]);
        
        if ($statement === 'select' || $statement === 'show') {
            return $this->sQuery->fetchAll($fetchmode);
        } elseif ($statement === 'insert') {
            return $this->conn->lastInsertId();
        } elseif ($statement === 'update' || $statement === 'delete') {
            return $this->sQuery->rowCount();
        } else {
            return NULL;
        }
    }
	    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
	public function beginTransaction()
    {
        return $this->conn->beginTransaction();
    }
	 public function executeTransaction()
    {
        return $this->conn->commit();
    }
	public function rollBack()
    {
        return $this->conn->rollBack();
    }
	 public function column($query, $params = null)
    {
        $this->Init($query, $params);
        $Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);
        
        $column = null;
        
        foreach ($Columns as $cells) {
            $column[] = $cells[0];
        }
        
        return $column;
        
    }
	public function row($query, $params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $this->Init($query, $params);
        $result = $this->sQuery->fetch($fetchmode);
        $this->sQuery->closeCursor();
        return $result;
    }
	public function single($query, $params = null)
    {
        $this->Init($query, $params);
        $result = $this->sQuery->fetchColumn();
        $this->sQuery->closeCursor();
        return $result;
    }
	
	

public function getValue_Unique($table, $fldnm, $qfld, $qvl)
    {
	if (!$this->isConnected) {
			$this->Connect();
		}	
		
	$stmt = $this->conn->prepare("SELECT $fldnm FROM $table WHERE $qfld = ?");
	$stmt->bindValue(1, $qvl, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}	
	
	
	private function ExceptionLog($message, $sql = "")
	{
		$exception = 'Unhandled Exception. <br />';
		$exception .= $message;
		$exception .= "<br /> You can find the error back in the log.";
		
		if (!empty($sql)) {
			$message .= "\r\nRaw SQL : " . $sql;
		}
		
		header("HTTP/1.1 500 Internal Server Error");
		header("Status: 500 Internal Server Error");
		$this->log->write($message);
		return $exception;
	}
	
	}
	$full_path="http://touristclub.in/ego_app/";
	?>