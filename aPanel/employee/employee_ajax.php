<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];
$employeeObj = new Employee;

// 1. add and update role

if ($action == 'add_new_role') {
    ob_clean();
    $param['role_name'] = $_POST['role_name'];
    $param['role_abbr'] = $_POST['role_abbr'];
    $param['role_description'] = check_input($_POST['role_description']);
   
    if (empty(trim($_POST['id']))) {

        $param['added_by'] = $_POST['admin_id'];
        $result = Table::insertData(array('tableName' => TBL_EMPLOYEE_ROLE, 'fields' => $param, 'showSql' => 'N'));
        $response = array("result" => 'Success', "data" => 'Successfully Added');
        echo json_encode($response);

    } else {
        
        $param['updated_by'] = $_POST['admin_id'];
        $where = array('id' => $_POST['id']);
        $result = Table::updateData(array('tableName' => TBL_EMPLOYEE_ROLE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));                    
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);      

    }
    exit();
}

// 2.role position

if($action =='employee_role_position'){
    ob_clean();
    if (count($_POST['role_id']) > 0) {
        foreach ($_POST['role_id'] as $key => $val) {
            $param['position'] = $key + 1;
            $where = array('id' => $val);
            $result = Table::updateData(array('tableName' => TBL_EMPLOYEE_ROLE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        }
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }
    exit();
}

// 3.remove role

if($action == 'remove_employee_role'){
    ob_clean();
    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_EMPLOYEE_ROLE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}

// 4.role status chnage

if ($action == 'role_status_change') {
    $param['status'] = $_POST['status'];
    $param['updated_by'] = $_POST['admin_id'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_EMPLOYEE_ROLE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}




// 1.Add nEdit Employee

if($action == 'add_edit_employee'){

    /* insert and update tbl_refernce */

    if($_POST['reached_mms_by'] == 'reference'){
     
        
        if (empty(trim($_POST['ref_id']))) {

            $param['username']          = $_POST['username'];
            $param['usermobile']        = $_POST['usermobile'];
            $param['working_mms']       = $_POST['working_mms'];
            $param['if_yes_member_id']  = $_POST['if_yes_member_id'];
         
            $param['added_by'] = $_POST['admin_id'];
            $result = Table::insertData(array('tableName' => TBL_REFERENCE, 'fields' => $param, 'showSql' => 'N'));
            $explode = explode('::', $result);                
            $referenceid = trim($explode[2]);  

            $param = array();
            $param['if_reference_or_consultancy_id'] = $referenceid;

        }else{

            if($_POST['working_mms'] == 'Y'){
                $param['if_yes_member_id']  = $_POST['if_yes_member_id'];
                $param['username']          = '';
                $param['usermobile']        = '';
            }else{
                $param['if_yes_member_id']  = '';
                $param['username']          = $_POST['username'];
                $param['usermobile']        = $_POST['usermobile'];
            }
            
            $param['working_mms']       = $_POST['working_mms'];
            $param['updated_by'] = $_POST['admin_id'];
            $where = array('id' => $_POST['ref_id']);
            $result = Table::updateData(array('tableName' => TBL_REFERENCE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

            $param = array();
            $param['if_reference_or_consultancy_id'] = $_POST['ref_id'];
        }
    }

    /* employee table param */

    $param['first_name']            = $_POST['first_name'];
    $param['last_name']             = check_input($_POST['last_name']);
    $param['gender']                = $_POST['gender'];
    $param['mobile']                = $_POST['mobile'];
    $param['personal_email']        = $_POST['personal_email'];
    $param['address']               = $_POST['address'];
    $param['city']                  = $_POST['city'];
    $param['state']                 = $_POST['state'];
    $param['zipcode']               = $_POST['zipcode'];
    $param['blood_group']           = $_POST['blood_group'];
    $param['emergency_contact_no']  = $_POST['emergency_contact_no'];

    $param['select_degree']         = $_POST['select_degree'];
    $param['course']                = $_POST['course'];
    $param['completed_year']        = $_POST['completed_year'];
    $param['college_name']          = $_POST['college_name'];
    $param['role_id']               = $_POST['role_id'];
    $param['relevant_field']        = $_POST['relevant_field'];
    $param['if_experience_years']   = $_POST['if_experience_years'];

    $param['joining_date']          = $_POST['joining_date'];
    $param['company_email']         = $_POST['company_email'];
    $param['password']              = $_POST['password'];
    $param['reached_mms_by']        = $_POST['reached_mms_by'];

    /* upload employee profile */

    if ($_FILES['employee_img']['name'] != '') {
        $newFileName = '';
        $filename = basename($_FILES['employee_img']['name']);
        $file_tmp = $_FILES['employee_img']["tmp_name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $baseName = basename($filename, $ext);
        $newFileName = rand() . '.' . $ext;
        $param['employee_img'] = $newFileName;
        move_uploaded_file($file_tmp = $_FILES['employee_img']["tmp_name"], "uploads/profile/" . $newFileName) or die('image upload fail');
    }

    /* upload employee id_proof */

    if ($_FILES['id_proof']['name'] != '') {
        $newFileName = '';
        $filename = basename($_FILES['id_proof']['name']);
        $file_tmp = $_FILES['id_proof']["tmp_name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $baseName = basename($filename, $ext);
        $newFileName = rand() . '.' . $ext;
        $param['id_proof'] = $newFileName;
        move_uploaded_file($file_tmp = $_FILES['id_proof']["tmp_name"], "uploads/id_proof/" . $newFileName) or die('image upload fail');
    }



    if (empty(trim($_POST['id']))) {

        /* insert employee table */

        $getLstid = $employeeObj->get_employee_details();
        foreach($getLstid as $key => $value){ }
        $empid = $value->id+1;

        $param['emp_code'] = 'MMSEMP'.$empid;
        $param['added_by'] = $_POST['admin_id'];
        $result = Table::insertData(array('tableName' => TBL_EMPLOYEE, 'fields' => $param, 'showSql' => 'N'));
        $explode = explode('::', $result);                
        $employeeid = trim($explode[2]);

        /* insert employee package */

        $param = array();
        $param['employee_id']           = $employeeid;
        $param['monthly_package']       = $_POST['monthly_package'];
        $param['bank_name']             = $_POST['bank_name'];
        $param['account_number']        = $_POST['account_number'];
        $param['account_name']          = $_POST['account_name'];
        $param['ifsc_code']             = $_POST['ifsc_code'];
        $param['upi_id']                = $_POST['upi_id'];
        $param['added_by']              = $_POST['admin_id'];

        $result = Table::insertData(array('tableName' => TBL_EMPLOYEE_PACKAGE, 'fields' => $param, 'showSql' => 'N'));
        $explode = explode('::', $result);

        $response = array("result" => 'Success', "data" => 'Added Successfully');
        echo json_encode($response);

    }else{

        /* update employee table */

        $param['updated_by'] = $_POST['admin_id'];
        $where = array('id' => $_POST['id']);
        $result = Table::updateData(array('tableName' => TBL_EMPLOYEE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        
        /* update employee package */
                
        $param = array();
        $param['monthly_package']       = $_POST['monthly_package'];
        $param['bank_name']             = $_POST['bank_name'];
        $param['account_number']        = $_POST['account_number'];
        $param['account_name']          = $_POST['account_name'];
        $param['ifsc_code']             = $_POST['ifsc_code'];
        $param['upi_id']                = $_POST['upi_id'];

        $param['updated_by'] = $_POST['admin_id'];
        $where = array('employee_id' => $_POST['id']);
        $result = Table::updateData(array('tableName' => TBL_EMPLOYEE_PACKAGE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));        
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }

}

// 2.remove role

if($action == 'remove_employee'){
    ob_clean();

    $employeeObj->id = $_POST['id'];
    $getempid = $employeeObj->get_employee_details();

    $where = array('id' => $getempid[0]->if_reference_or_consultancy_id);

    if($getempid[0]->reached_mms_by == 'reference'){

        $result = Table::deleteData(array('tableName' => TBL_REFERENCE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

    }elseif ($getempid[0]->reached_mms_by == 'consultancy'){

        $result = Table::deleteData(array('tableName' => TBL_CONSULTANCY, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    }
    array();
    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_EMPLOYEE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}
