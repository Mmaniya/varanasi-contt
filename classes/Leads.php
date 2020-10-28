<?php
class Leads {

    public function get_leads_details(){  

        if(!empty($this->id)){
            $query = "SELECT *  from ".TBL_LEADS." WHERE id =".$this->id.""; 
        } else { 
            $query = "SELECT *  from ".TBL_LEADS." ORDER BY position ASC";         
        }
        return dB::mExecuteSql($query);   
    }

    public function get_clients_count(){               
        $qry ="select id, count(*) total,
            sum(case when status = 'A' then 1 else 0 end) total_active,
            sum(case when status = 'I' then 1 else 0 end) total_inctive,
            sum(case when is_wl_member = 'Y' then 1 else 0 end) wl_member
            from ".TBL_LEADS."";
        return  dB::sExecuteSql($qry);  
    }


}