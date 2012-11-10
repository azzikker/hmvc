order();
function order()
{
    order_dc();
    function order_dc()
    {
        $(document).ready(function()
        {
            setInterval(autorun_event,1000);
            /*$("#voucher-b a#print").click(function(e)
            {
                $href = $(this).attr("href");
                loadContent($href);
                history.pushState('', '', location.pathname);
                e.preventDefault();
            })*/
            $("#voucher-b-a span").click(function(e)
            {
                var vdel = confirm("Are you sure to delete your voucher?");
                if(vdel)
                {
                    $del = $(e.target).attr("vid");
                    $("#voucher").append('<iframe id="iforders" name="iforders" style="display: none;"></iframe>');
                    $(e.target).parent().append('<form action="vigdeals/vigdealswauth/vouchdel" method="post" target="iforders"></form>');
                    $(e.target).parent().find("form").append("<input type='hidden' name='orurl' value='"+$("input[name='orurl']").val()+"'><input type='hidden' name='vidd' value='"+$del+"'>").submit();
                }
            })
            $("#voucher-h-ob").unbind();
            $("#voucher-h-ob").click(function()
            {
                $("#voucher-h-ob-hov").slideToggle();
            })
        })
    }
    function loadContent($url)
    {
        $.getScript("assets/general/js/print.js");
        $.getScript("assets/vigattin_deals/js/print.js");
        $("#orderframe2").remove();
        $("body").prepend("<div id='orderframe2' style='display:none'><img id='orderframe2-loading' src='assets/vigattin_deals/images/loading2.gif' alt='' width='35px' style='margin-top: 15%'><div id='orderframe'></div></div>").css({overflow:"hidden"});
        $("#orderframe").hide().load($url+" #voucher-d",function()
        {
            $("#orderframe2").fadeIn();
            $(this).parent().find("#orderframe2-loading").remove();
            $(this).show().append("<img id='orderframe-img' src='assets/vigattin_deals/images/close.png'>");
            $(this).find(" #voucher-d").css({width:"700px",padding:"0px"});
            $("#voucher-d-pn").css({position:"absolute","z-index":"5",width:"50px",right:"-60px",top:"10px"});
            $("#voucher-d").css({overflow:"visible"});
            $("#orderframe-img").click(function()
            {
                $("#orderframe2").fadeOut(function()
                {
                    $("#orderframe2").remove();
                })
                $("body").css({overflow:"auto"});
            })
        });
    }
    function autorun_event()
    {
        $(".voucher-b-r.voucher-b-r2").each(function(index,value)
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
                            $(value).removeClass("voucher-b-r2");
                        }
                    }
                }
            }
            if($(value).hasClass("voucher-b-r2"))
            {
                $(value).find("#d").text($d);
                $(value).find("#h").text($h);
                $(value).find("#m").text($m);
                $(value).find("#s").text($s);
            }
        })
    }
}