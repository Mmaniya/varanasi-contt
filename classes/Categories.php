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
        $query = "SELECT *  from ".TBL_SERVICE_CATEGORIES." ORDER BY position ASC"; 
        return dB::mExecuteSql($query);   
    }
} ?>