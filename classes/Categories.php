<?php 
class Categories {
    public function get_category_count(){               
        $qry ="select id, count(*) total,
            sum(case when status = 'A' then 1 else 0 end) total_active,
            sum(case when status = 'I' then 1 else 0 end) total_inctive
            from ".TBL_SERVICE_CATEGORIES."";
        return  dB::sExecuteSql($qry);  
    }

    public function get_category(){   
        if(!empty($this->status)){
            $query = "SELECT *  from ".TBL_SERVICE_CATEGORIES." WHERE status = 'A' ORDER BY position ASC"; 
        } else { 
            $query = "SELECT *  from ".TBL_SERVICE_CATEGORIES." ORDER BY position ASC"; 
        }
        return dB::mExecuteSql($query);   
    }

    public function get_category_details(){        
          $query = "SELECT *  from ".TBL_SERVICE_CATEGORIES." Where id = ".$this->id;   
        return dB::sExecuteSql($query);   
    }

    public function get_wrk_in_progress_category(){
        //   $query = "SELECT count(*) as total from ".TBL_SERVICE." Where category_id = ".$this->id; 
          $query ="select id, count(*) total,
            sum(case when status = 'A' then 1 else 0 end) total_active,
            sum(case when status = 'I' then 1 else 0 end) total_inctive
            from ".TBL_SERVICE."  Where category_id = ".$this->id;  
        return dB::sExecuteSql($query);   
    }

    public function get_category_service(){        
        $query = "SELECT *  from ".TBL_SERVICE." Where category_id = ".$this->id ." ORDER BY position ASC ";
        return dB::mExecuteSql($query);   
    }

    public function category_service_data(){        
        $query = "SELECT *  from ".TBL_SERVICE." Where id = ".$this->id."";
        return dB::sExecuteSql($query);   
    }
    public function get_service_category_features(){
          $query = "SELECT *  from ".TBL_SERVICE_FEATURES." Where service_id = ".$this->id ." ORDER BY position ASC";   
        return dB::mExecuteSql($query);  
    }
    public function get_service_category_faq(){
          $query = "SELECT *  from ".TBL_SERVICE_FAQ." Where service_id = ".$this->id ." ORDER BY position ASC"; 
        return dB::mExecuteSql($query);  
    }
} ?>