timer();
function timer()
{
    timer_dr();
    function timer_dr()
    {
        $(function()
        {
            $("#deal-box").mouseenter(function()
            {
                $("#deal-box-img-timer").stop(true,true).animate({"margin-top":"0px"});
            })
            $("#deal-box").mouseleave(function()
            {
                $("#deal-box-img-timer").stop(true,true).animate({"margin-top":"-51px"});
            })
            setInterval(autoload_timer,1000);
        })
    }
    function autoload_timer()
    {
        $("#etcbtn-timer").each(function(index,value)
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
                            $(value).removeClass("etcbtn-timer");
                        }
                    }
                }
            }
            if($(value).hasClass("etcbtn-timer"))
                {
                if($d < 10)
                    {
                    $d = "0"+$d;
                }
                if($h < 10)
                    {
                    $h = "0"+$h;
                }
                if($m < 10)
                    {
                    $m = "0"+$m;
                }
                if($s < 10)
                    {
                    $s = "0"+$s;
                }
                $(value).find("#d").html($d+"<span>d</span>");
                $(value).find("#h").html($h+"<span>h</span>");
                $(value).find("#m").html($m+"<span>m</span>");
                $(value).find("#s").html($s+"<span>s</span>");
            }
        })
    }
}