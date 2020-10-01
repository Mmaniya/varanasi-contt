<?php

class DatabaseConnection
{
	var $dbconn;
	var $BA_DBHOST = BA_DBHOST;
	var $BA_DBUSER = BA_DBUSER;
	var $BA_DBPASSWORD = BA_DBPASSWORD;
	var $BA_DBNAME = BA_DBNAME;
	
	
	 
	function __construct()
	{
		$link = mysqli_connect($this->BA_DBHOST, $this->BA_DBUSER, $this->BA_DBPASSWORD);
		if($link){
			$this->dbconn = $link;
			mysqli_select_db ($link,$this->BA_DBNAME);
		}else{
			echo mysqli_error();
			$this->dbconn = false;
		}
	}
	
	function Select($sql)
	{
		$result = mysqli_query($sql) or die(mysqli_error());
		return $this->rows_to_hash($result);
	}
	
	function SelectOne($sql)
	{
		$result = mysqli_query($sql) or die(mysqli_error());
		return $this->row_to_hash($result);
	}	
	
	function TotalCount($table)
	{
		$sql = "SELECT count(*) from " . $table;
		mysqli_query($sql) or die(mysqli_error());
		
	}
	
	function Execute($sql)
	{
		$result = mysqli_query($sql) or die(mysqli_error());
		return $result;
	}
	
	function rows_to_hash($result)
	{
		if (mysqli_num_rows($result)==0)
			return false;
			
		$ret = array();
		$j=0;		
		while($thisrow=mysqli_fetch_row($result))
		{
			$i = 0;
			while ($i < mysqli_num_fields($result)) 
			{
				$meta = mysqli_fetch_field($result, $i);
				$ret[$j][$meta->name] = $thisrow[$i];
				$i++;
			}
			$j++;
		}
		return $ret;
	}
	
	function row_to_hash($result)
	{
		global $logger;
		if (mysqli_num_rows($result)==0)
		{
			return false;
		}
		
		$i = 0;
		$ret = mysqli_fetch_row($result);
		while ($i < mysqli_num_fields($result)) 
		{
			$meta = mysqli_fetch_field($result, $i);
			$ret[$meta->name] = $ret[$i];
			$i++;
		}
		return $ret;	
	}
	
	function SelectFilter($table,$fields="*",$where="",$order_by="",$order="ASC",$limit=1000,$offset=0)
	{
		$sql = "SELECT " . $fields . " FROM " . $table;
		if ($where != "")
		{
			$sql = $sql + " WHERE " . $where;
		}
		if ($order_by != "")
		{
			$sql = $sql + " ORDER BY " . $order_by . " " . $order;
		}
		$sql = $sql + " LIMIT " . $limit;
		if ($offset != "")
		{
			$sql = $sql + " OFFSET " . $offset;
		}
		$result = mysqli_query($sql) or die(mysqli_error());
		return $result;
	}	
		
	function Close()
	{
		mysqli_close($this->dbconn);
	}
   
   function __destruct() 
   {
       $this->Close();
   }	
	

} // class DatabaseConnection

$dbconn = new DatabaseConnection();

?>
