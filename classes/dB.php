<?
 
 class dB{
         
     function __construct(){
     }
         
     public static function insertSql($Sql){ 
         $con=mysqli_connect(BA_DBHOST,BA_DBUSER,BA_DBPASSWORD,BA_DBNAME);
           $dbconn = new DatabaseConnection();
         mysqli_query($dbconn->dbconn,'SET NAMES utf8');
         mysqli_query($con,$Sql) or die(mysqli_error($con));	
         return mysqli_insert_id($con);
     }
     
     public static function updateSql($Sql){
      $con=mysqli_connect(BA_DBHOST,BA_DBUSER,BA_DBPASSWORD,BA_DBNAME);
         $dbconn = new DatabaseConnection();
         mysqli_query($dbconn->dbconn,'SET NAMES utf8');
         mysqli_query($con,$Sql) or die(mysqli_error($con));
         return mysqli_affected_rows($con) ;
     }
     
     public static function deleteSql($Sql){
     $con=mysqli_connect(BA_DBHOST,BA_DBUSER,BA_DBPASSWORD,BA_DBNAME);
      $dbconn = new DatabaseConnection();
         mysqli_query($dbconn->dbconn,'SET NAMES utf8');
         mysqli_query($con,$Sql) or die(mysqli_error($con));
         return mysqli_affected_rows($con) ;
     }
     
     public static function sExecuteSql($Sql){
        //$con=mysqli_connect(BA_DBHOST,BA_DBUSER,BA_DBPASSWORD,BA_DBNAME);
         $dbconn = new DatabaseConnection();               
          mysqli_query($con,'SET NAMES utf8');
          $Resource = mysqli_query($dbconn->dbconn,$Sql);	
         $Row = @mysqli_fetch_object($Resource) ;
         @mysqli_free_result($Resource);
         return $Row ;
     }
     
     public static function mExecuteSql($Sql){
         $con=mysqli_connect(BA_DBHOST,BA_DBUSER,BA_DBPASSWORD,BA_DBNAME);
         $dbconn = new DatabaseConnection();
         mysqli_query($dbconn->dbconn,'SET NAMES utf8');
         $Resource = mysqli_query($con,$Sql);	
         while($Row = @mysqli_fetch_object($Resource)) {$Rs[] = $Row;}
         @mysqli_free_result($Resource);
         return $Rs ;
     }
 
    public static function getNumRows($Sql) {
          $Resource = mysqli_query($Sql);	
         $rowCount= mysqli_num_rows($Resource);
         @mysqli_free_result($Resource);
         return $rowCount;
    }		
 
     public static function mSelectHash($Sql){
         $Resource = mysqli_query($Sql);	
         return db::rowsToHash($Resource);
         }
    
     public static function sSelectHash($Sql){
         $Resource = mysqli_query($Sql);	
         return db::rowToHash($Resource);
         }
 
    
     public static function rowsToHash($result)
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
     
     public static function rowToHash($result)
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
     
     public static function SelectFilter($table,$fields="*",$where="",$order_by="",$order="ASC",$limit=1000,$offset=0)
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
          
 }
 ?>