<?php
class Clients {

    public function get_clients_details(){  

        if(!empty($this->id)){
            $query = "SELECT *  from ".TBL_CLIENTS." WHERE id =".$this->id.""; 
        } else { 
            $query = "SELECT *  from ".TBL_CLIENTS." ORDER BY position ASC";         
        }
        return dB::mExecuteSql($query);   
    }

    public function get_clients_count(){               
        $qry ="select id, count(*) total,
            sum(case when status = 'A' then 1 else 0 end) total_active,
            sum(case when status = 'I' then 1 else 0 end) total_inctive,
            sum(case when is_wl_member = 'Y' then 1 else 0 end) wl_member
            from ".TBL_CLIENTS."";
        return  dB::sExecuteSql($qry);  
    }


}