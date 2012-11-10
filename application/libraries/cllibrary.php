<?php
    class CLLibrary
    {
        function timeleft($time_left=0, $endtime=null) 
        { 
            if($endtime != null) 
                $time_left = $endtime - time(); 
            if($time_left > 0)
            { 
                $days = floor($time_left / 86400); 
                $time_left = $time_left - $days * 86400; 
                $hours = floor($time_left / 3600); 
                $time_left = $time_left - $hours * 3600; 
                $minutes = floor($time_left / 60); 
                $seconds = $time_left - $minutes * 60; 
            }
            else
            { 
                return array(0, 0, 0, 0);
            }
            return array($days, $hours, $minutes, $seconds);
        }
    }
?>
