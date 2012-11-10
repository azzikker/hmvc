payment();
function payment()
{
    payment_dr();
    function payment_dr()
    {
        $(document).ready(function()
        {
            $("form").submit(function(e)
            {
                if($("#paymentframe").length > 0)
                {
                    //$href = $(this).attr("action");
                    //loadContent($href);
                    //e.preventDefault();
                }
            })
        })
    }
    function loadContent(url)
    {
        $.post(url,$("form").serialize(),function(data)
        {
            $("#paymentframe").css({height:"100%"});
            $("#paymentframe2").empty();
            $("#paymentframe").prepend('<div id="vigloading"><img src="assets/vigattin_deals/images/loading2.gif" alt=""></div>')
            $("#paymentframe #vigloading").show();
            $("body").append("<div id='temp' style='display:none'></div>")
            $("#temp").append(data);
            $("#paymentframe2").append($("#temp .content").html());
            $("#paymentframe2").wrap("<div class='content'>");
            if($("#paymentframe2 #ads").length == 0)
            {
                $("#paymentframe2 .content").hide().ready(function()
                {
                    $("#paymentframe2 .content").show();
                    $("#paymentframe #vigloading").remove();
                    $("#rpc-btn-b").text("Close").css({margin:"auto",position:"inherit"});
                })
            }
            else
            {
                window.location.href = $("base").attr("href") + url;
            }
            $("#temp").remove();
        })
    }
}