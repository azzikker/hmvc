timer();
function timer()
{
    document_ready();
    function document_ready()
    {
        $(document).ready(function()
        {
            autorun_event2();
            setInterval(autorun_event,1000);
        })
    }
    function autorun_event2()
    {
        $(".m-dealbox-timer").show();
        $(".m-dealbox-timer").each(function(index, value)
        {
            $dS = parseInt($(value).find("#d").text(),10);
            $hS = parseInt($(value).find("#h").text(),10);
            $mS = parseInt($(value).find("#m").text(),10);
            $sS = parseInt($(value).find("#s").text(),10);
            if($dS <= 0 && ($hS <= 12 && $mS <= 59))
            {
                $(value).find("div").css({"color":"red"});
            }
        })
    }
    function autorun_event()
    {
        $(".m-dealbox-timer").each(function(index, value)
        {
            $d = parseInt($(value).find("#d").text(),10);
            $h = parseInt($(value).find("#h").text(),10);
            $m = parseInt($(value).find("#m").text(),10);
            $s = parseInt($(value).find("#s").text(),10);
            if($s > 0)
            {
                $s--;
            }
            else
            {
                $s = 59;
                if($m > 0)
                {
                    $m--;
                }
                else
                {
                    $m = 59;
                    if($h > 0)
                    {
                        $h--;
                    }
                    else
                    {
                        $h = 23;
                        if($d > 0)
                        {
                            $d--;
                        }
                        else
                        {
                            window.location.href = "mobile?e=timeout";
                            alert("Your selected deal has been outdated.")
                        }
                    }
                }
            }
            
            if($d < 10)
            {
                $d = "0" + $d;
            }
            if($h < 10)
            {
                $h = "0" + $h;
            }
            if($m < 10)
            {
                $m = "0" + $m;
            }
            if($s < 10)
            {
                $s = "0" + $s;
            }
            $(value).find("#d").text($d);
            $(value).find("#h").text($h);
            $(value).find("#m").text($m);
            $(value).find("#s").text($s);
        })
    }
}