iv();
function iv()
{
    $(document).ready(function()
    {
        $("#deal-box-info-btnanddd-vg").click(function(e)
        {
            //$href = $(this).parent().attr("href");
            //loadContent($href);
            //history.pushState('', '', location.pathname);
            //e.preventDefault();
        })
        //window.onpopstate = function(event) 
        //{
        //$("#vigloading").show();
        //console.log("pathname: "+location.pathname);
        //loadContent2(location.pathname);
        //};
    })
    function loadContent(url)
    {
        $("body").prepend("<div id='paymentframe' style='display:none'><div id='paymentframe2'></div></div>").css({"overflow":"hidden"});
        $("#paymentframe").fadeIn();
        $("#paymentframe").css({height:"100%"});
        $("#paymentframe").prepend('<div id="vigloading"><img src="assets/vigattin_deals/images/loading2.gif" alt=""></div>')
        $("#paymentframe #vigloading").show();
        $("#paymentframe2").load(url+" .content",function()
        {
            if($(this).find("form[action='payment']").length == 1)
            {
                history.pushState('', '', location.pathname);
                $("#paymentframe").css({height:"auto"});
                $("#paymentframe #vigloading").remove();
                $("#rpc-btn-b").text("Cancel");
                $("#rpc-btn-b").click(function()
                {
                    $("body").css({"overflow":"auto"});
                    $("#paymentframe").remove();
                    return false;
                })
                $.getScript("assets/vigattin_deals/js/reviewcart.js");
            }
            else
            {
                window.location.href = $("base").attr("href") + url;
            }
        })
    }
    function hideerror()
    {
        $("#errormsg").animate({"margin-top":"-20"},500,function()
        {
            $(this).remove();
            $("#navigation").css({"top":"0px"});
        });
    }
    //function loadContent2(url)
    //{
    //$(".content").load(url+" .content",function()
    //{
    //$("#vigloading").hide();
    //$(".content .content").unwrap();
    //$.getScript("assets/vigattin_deals/js/payment.js");
    //})
    //}
}