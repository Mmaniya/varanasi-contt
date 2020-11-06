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
}