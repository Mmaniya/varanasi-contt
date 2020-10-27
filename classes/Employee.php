<?php 
class Employee {

    public function get_emp_role_count(){               
        $qry ="select id, count(*) total,
            sum(case when status = 'A' then 1 else 0 end) total_active,
            sum(case when status = 'I' then 1 else 0 end) total_inctive
            from ".TBL_EMPLOYEE_ROLE."";
        return  dB::sExecuteSql($qry);  
    }

    public function get_employee_count(){               
        $qry ="select id, count(*) total,
            sum(case when status = 'A' then 1 else 0 end) total_active,
            sum(case when status = 'I' then 1 else 0 end) total_inctive
            from ".TBL_EMPLOYEE."";
        return  dB::sExecuteSql($qry);  
    }

    public function get_employee_role(){  
        if(!empty($this->id)){
            $query = "SELECT *  from ".TBL_EMPLOYEE_ROLE." WHERE id =".$this->id.""; 
        } else { 
            $query = "SELECT *  from ".TBL_EMPLOYEE_ROLE." ORDER BY position ASC";         
        }
        return dB::mExecuteSql($query);   
    }
  
    public function get_employee_details(){  

        if(!empty($this->id)){
            $query = "SELECT *  from ".TBL_EMPLOYEE." WHERE id =".$this->id.""; 
        } else { 
            $query = "SELECT *  from ".TBL_EMPLOYEE." ORDER BY position ASC";         
        }
        return dB::mExecuteSql($query);   
    }

    public function get_employee_package(){
        if(!empty($this->id)){
           $query = "SELECT *  from ".TBL_EMPLOYEE_PACKAGE." WHERE employee_id =".$this->id.""; 
        }
        return dB::mExecuteSql($query);   
    }

    public function get_employee_refernce(){
        if(!empty($this->id)){
           $query = "SELECT *  from ".TBL_REFERENCE." WHERE employee_id =".$this->id.""; 
        }
        return dB::mExecuteSql($query);   
    }
    
    public function get_emp_consultancy(){  
        if(!empty($this->id)){
            $query = "SELECT *  from ".TBL_CONSULTANCY." WHERE employee_id =".$this->id.""; 
        }
        return dB::sExecuteSql($query);   
    }

} ?>