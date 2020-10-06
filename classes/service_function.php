<?php 
class Service {
	
	  static function get_service_category() {
          $query = "SELECT *  from ".TBL_SERVICE_CATEGORIES." ORDER BY position ASC"; 
	        return dB::mEXecuteSql($query);
    }
    static function get_service() {
         $query = "SELECT *  from ".TBL_SERVICE."  ORDER BY position ASC "; 
        return dB::mEXecuteSql($query);
    }
}