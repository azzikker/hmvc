<?php
    function displayDivision($i)
    {
        switch ($i)
        {
            case 1:
                return "1st District";
                break;
            case 2:
                return "2nd District";
                break;
            case 3:
                return "3rd District";
                break;
            case 4:
                return "4th District";
                break;
            case 5:
                return "5th District";
                break;
            case 6:
                return "6th District";
                break;
            case 7:
                return "7th District";
                break;
            case 8:
                return "8th District";
                break;
            case 9:
                return "9th District";
                break;                                       
        }
    }
    function initLevel()
    {  
        $CI = get_instance();
        $CI->session->set_userdata(array("LEVEL"=>"1"));       
    }
    function getLevel()
    {
        $CI = get_instance();
        return $CI->session->userdata("LEVEL");
    }
    function increaseLevel()
    {
        $CI = get_instance();
        $CURLEV = $CI->session->userdata("LEVEL");
        $CURLEV+=1;
        $CI->session->set_userdata(array("LEVEL"=>$CURLEV));          
    }
    function decreaseLevel()
    {
        $CI = get_instance();
        $CURLEV = $CI->session->userdata("LEVEL");
        $CURLEV = $CURLEV - 1;        
        $CI->session->set_userdata(array("LEVEL"=>"$CURLEV"));        
    } 
    function getCountryName()
    {
        $CI = get_instance();
        return $CI->session->userdata("country_name");        
    } 
    function getCountryID()
    {
        $CI = get_instance();
        return $CI->session->userdata("country_id");             
    }  
    function timeAgo($tm,$rcs = 0)
    {
        $cur_tm = time(); $dif = $cur_tm-$tm;
        $pds = array('second','minute','hour','day','week','month','year','decade');
        $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
        for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

        $no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);
        if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
        return $x . 'ago';
    }
    function shortenString($string, $length=NULL)
    {
        if ($length == NULL)
            $length = 200;

        $stringDisplay = substr(strip_tags($string), 0, $length);
        if (strlen(strip_tags($string)) > $length)
            $stringDisplay .= ' ...';
        $strlength = strlen(strip_tags($string));
        return $stringDisplay=array($stringDisplay,$strlength);
    }
?>
