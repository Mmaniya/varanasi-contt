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

}