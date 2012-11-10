randomdeals();
function randomdeals()
{
    document_ready();
    function document_ready()
    {
        $(document).ready(function()
        {
            autoload_event();
        })
    }
    function autoload_event()
    {
        $(".dealsbox").mouseenter(function()
        {
            $(this).addClass("noa");
        })
        $(".dealsbox").mouseleave(function()
        {
            $(this).removeClass("noa");
        })
        $ads = $(".dealbox").length;
        if($ads > 5)
        {
            setInterval(animate_ads, 5000);
        }
    }
    function animate_ads()
    {
        if($(".noa").length == 0)
        {
            $(".dealbox").first().animate({"opacity":"0"},400);
            $(".dealsbox").animate({"margin-top":"-139px"},1000,function()
            {
                $(".dealsbox .dealbox").first().css({"opacity":"1"});
                $dbhtml = $(".dealsbox a").first().html();
                $dbhref = $(".dealsbox a").first().attr("href");
                $(".dealsbox").append("<a href='"+$dbhref+"'>"+$dbhtml+"</a>");
                $(".dealsbox a").first().remove();
                $(".dealsbox").css({"margin-top":"auto"});
            });
        }
    }
}