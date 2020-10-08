<?php 
class Service {
	
	public function get_service_category() {
        //  $category_id = $this->category_id;
         $query = "SELECT *  from ".TBL_SERVICE_CATEGORIES." ORDER BY position ASC"; 
            return dB::mExecuteSql($query);      
    }
    
    static function service_category($id) {
         $query = "SELECT *  from " . TBL_SERVICE . " WHERE id=".$id;
        return dB::sEXecuteSql($query);
    }
    static function get_service() {
         $query = "SELECT *  from ".TBL_SERVICE."  ORDER BY position ASC "; 
        return dB::mExecuteSql($query);
    }
    static function service_tbl($id) {
         $query = "SELECT *  from ".TBL_SERVICE." WHERE id=".$id;
        return dB::mExecuteSql($query);
    }
    static function service_features($id){
        if(!empty($id)){
            $param = array('tableName' => TBL_SERVICE_FEATURES, 'fields' => array('*'), 'showSql' => 'N', 'condition' => array('id' => $id . '-INT'));
            return Table::getData($param);
        }
    }
    static function service_faq($id){
        if(!empty($id)){
            $param = array('tableName' => TBL_SERVICE_FAQ, 'fields' => array('*'), 'showSql' => 'N', 'condition' => array('id' => $id . '-INT'));
            return Table::getData($param);
        }
    }

}