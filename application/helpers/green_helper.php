<?php
    function grn($id) {
        $mult1 = $id*11;
        $mult2 = $id*2;
        $power1 = pow($mult1, 3);
        $power2 = pow($id, 5);
        $vut = 0.9;
        $formula_x = sqrt(sqrt(((($power1/99 * (($power2/99)/$mult2/99)/$mult2/99)/$mult2/99) - sqrt($vut))))*12;
        return $formula_x;
    }
    function npfm($sp, $x, $tf, $nr) {
        $npfm = ($sp-($sp*$x))*($tf-$nr);
        return $npfm;
    }
    function total_a($sp, $tf, $nr) {
        $total_a = $sp*($tf-$nr);
        return $total_a;
    }
    function income($total_a, $npfm) {
        $income = $total_a - $npfm;
        return $income;
    }
    function payment_summary_view($company_name, $deal_view_title, $deal_view_amount, $deal_view_due, $date_paid, $receipt_no, $account_no, $bank_name) {
        $payment_summary_view = 'Company Name\t\t\t:\t' . $company_name . '\nDeal Title\t\t\t\t:\t' . $deal_view_title . '\n\n\Amount\t\t\t\t\t:\t' . number_format($deal_view_amount). '\n\n\Payment Due\t\t\t:\t' . $deal_view_due . '\nPayment Distributed\t\t:\t' . $date_paid . '\n\nReceipt No.\t\t\t\t:\t' . $receipt_no . '\nAccount No.\t\t\t\t:\t' . $account_no . '\nBank Name\t\t\t\t:\t' . $bank_name;
        return $payment_summary_view;
    }
    function profile_summary_view($user_name, $user_level, $user_lname, $user_fname, $user_mname, $user_email, $user_no, $user_date) {
        $profile_summary_view = 'Username\t\t\t:\t' . $user_name . '\nUser Level\t\t\t:\t' . $user_level . '\n\nWhole Name\t\t:\t' . $user_lname . ', ' . $user_fname . ' ' . $user_mname . '\nE-mail\t\t\t\t:\t' . $user_email . '\nContact No.\t\t\t:\t' . $user_no . '\n\nDate Registered\t\t:\t' . $user_date;
        return $profile_summary_view;
    }
    function audit_trail($action, $form, $subform, $record, $user_id) {
        $tableA = "audit_trail";
        $insert["audit_date"] = time();
        $insert["audit_action"] = $action;
        $insert["audit_form"] = $form;
        $insert["audit_subform"] = $subform;
        $insert["audit_record"] = $record;
        $insert["user_id"] = $user_id;
        return $insert;
    }
    function xss_cleaner($string) {
        $return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $string );
        $return_str = str_ireplace( '%3Cscript', '', $return_str );
        return $return_str;
    }
    function image_size_filter($tmp, $max_width, $max_height, $min_width, $min_height) {
        list($width, $height, $type, $attr)= getimagesize($tmp);//get the image dimensions & properties
        //size filtering
        if($max_height == "null" || $min_height == "null") {
            if($width > $max_width) { return "large"; }
            elseif($width < $min_width) { return "small"; }     
        }
        else {
            if($width > $max_width || $height > $max_height) { return "large"; }
            elseif($width < $min_width || $height < $min_height) { return "small"; }     
        }
    }
    function image_type_filter($path) {
        $path_info = pathinfo($path);
        $extension = $path_info['extension'];
        //type filtering
        return $extension;
        if($extension == "jpg" || $extension == "jpeg" || $extension == "JPG" || $extension == "JPEG") { return "identified"; }
        return "unidentified";  
    }
    function return_code($string, $voucher_no) {
        $acron = substr(strtoupper(sha1(preg_replace('/\b(\w)\w*\W*/', '\1', $string))), 0, 4);
        $voucher = substr(strtoupper(sha1($voucher_no)), 0, 4);
        $time = substr(strtoupper(sha1(time())), 0, 4);
        $new_string = $acron . "-" . $voucher . "-" . $time;
        return $new_string;
    }
    function hash_encode($string) {
        $CI =& get_instance();
        $encryption_key = $CI->config->item("encryption_key");
        $hash_encode = base64_encode($string . $encryption_key);
        return $hash_encode;
    }
    function hash_decode($string) {
        $CI =& get_instance();
        $encryption_key = $CI->config->item("encryption_key");
        $hash_decode = base64_decode($string);
        $new_hash_decode = str_ireplace($encryption_key,"",$hash_decode);
        return $new_hash_decode;
    }
?>
