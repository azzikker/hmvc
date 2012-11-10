profile();
function profile()
{
    profile_dr();
    function profile_dr()
    {
        $(document).ready(function()
        {
            $("#profile-c-ei a").click(function(e)
            {
                $url = $(this).attr("href");
                loadContent($url);
                history.pushState('', '', location.pathname);
                e.preventDefault();
            })
        })
    }
    function loadContent(url)
    {
        $scrheight=$(window).height()/2;
        $("body").append("<div id='temp' style='display:none'></div>")
        .append("<div id='loadinginfo' style='position:absolute;top:"+$scrheight+"px;left:50%;'><img src='assets/vigattin_deals/images/loading2.gif' style='width:50px;'></div>");
        $(".content").hide()
        .load(url+" .content",function(data)
        {
            $("#temp").append(data);
            $thtml = $("#temp .content").html();
            $(".content").html($thtml);
            $(".content").ready(function()
            {
                $("#loadinginfo").remove();
               $(".content").fadeIn();
            });
            $("#temp").remove();
        })
    }
}