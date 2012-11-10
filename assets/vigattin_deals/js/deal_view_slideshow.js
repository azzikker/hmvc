var d_v_s = new d_v_s();
function d_v_s()
{
    dvs_dr()
    function dvs_dr()
    {
        $(document).ready(function()
        {
            autoload_event();
        })
    }
    function autoload_event()
    {
        if($(".dealsview-image img").length > 1)
        {
            $(".dealsview-image").prepend("<div id='dvi-bg'></div>")
            $(".dealsview-image").load('img', function()
            {
                setTimeout(walalang,5000);
            })
        }
        else
        {
            $(".dealsview-image img").css({"left":"0"});
        }
    }
    function walalang()
    {
        $("#dvi-bg").remove();
        autoload_event2();
        autoload_event3();
        $si = setInterval(chg_img,7000);
    }
    function autoload_event2()
    {
        $(".dealsview-image img").first().addClass("active");
        $(".dealsview-image img.active").next().addClass("next");
    }
    function chg_img()
    {
        $active = $(".dealsview-image img.active");
        $next = $(".dealsview-image img.next");
        $diaid = $(".dealsview-image img.active").attr("id");
        
        $(".dealsview-image img.active").css({"left":"0"});
        $(".dealsview-image img.next").css({"left":"690"});
        
        $active.stop(true,true).animate({"left":"-690"},200,function()
        {
            $(".dealsview-image img.active").css({"left":"690px"});
            $active.removeClass("active");
            $(".dealsview-image #imglist div[id='"+$diaid+"']").next().addClass("active");
            $(".dealsview-image #imglist div[id='"+$diaid+"']").removeClass("active");
            if($(".dealsview-image #imglist div.active").length == 0)
            {
                $(".dealsview-image #imglist div").first().addClass("active");
            }
        });
        $next.stop(true,true).animate({"left":"0"},200,function()
        {
            $next.next().addClass("next");
            $next.removeClass("next").addClass("active");
            if($(".dealsview-image img.next").length == 0)
            {
                $(".dealsview-image img").first().addClass("next");
            }
        })
    }
    function autoload_event3()
    {
        $imgs = $(".dealsview-image img").length;
        if($imgs > 1)
        {
            $(".dealsview-image").prepend("<div align='center' id='imglist'></div>");
            $html = "";
            $i=1;
            $(".dealsview-image img").each(function()
            {
                $html = $html+"<div id='"+($i++)+"'></div>";
            })
            $(".dealsview-image #imglist").append($html);
            $(".dealsview-image #imglist div").first().addClass("active");
            click_img();
        }
    }
    function click_img()
    {
        $(".dealsview-image #imglist div").click(function(e)
        {
            $id = parseInt($(e.target).attr("id"));
            $id = $id - 1;
            $(".dealsview-image #imglist div").removeClass("active");
            $(".dealsview-image #imglist div[id='"+($id+1)+"']").addClass("active");
            $(".dealsview-image img").css({"left":"690"});
            $(".dealsview-image img").removeClass("active").removeClass("next");
            if($(".dealsview-image img[id='"+$id+"']").length > 0)
            {
                $(".dealsview-image img[id='"+$id+"']").addClass("active");
            }
            else
            {
                $imgs = $(".dealsview-image img").length;
                $(".dealsview-image img[id='"+$imgs+"']").addClass("active");
            }
            if($(".dealsview-image img.active").next().length > 0)
            {
                $(".dealsview-image img[id='"+$id+"']").next().addClass("next");
            }
            else
            {
                $(".dealsview-image img").first().addClass("next");
            }
            $(".dealsview-image img.active").css({"left":"0"});
            $(".dealsview-image img.next").css({"left":"690"});
            clearInterval($si);
            chg_img();
            $si = setInterval(chg_img,7000);
        })
    }
}