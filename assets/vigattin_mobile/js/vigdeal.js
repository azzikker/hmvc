function vigdeal()
{
    vigdeal_dr()
    function vigdeal_dr()
    {
        $(function()
        {
            $("#header-profile").click(function()
            {
                $("#profile-menu").slideToggle(400);
            })
            $("#category-btn").click(function()
            {
                if($("#category-icons").is(":hidden") == false)
                {
                    $("#category-icons").slideToggle();
                }
                else
                {
                    $("#category-icons").slideToggle();
                }
            })
            $(".deal-info-top-right,#deal-info-bot.pastgroup").click(function()
            {
                $("#video").empty();
                $(".google_iframe").remove();
                $("#googlemap").hide();
                $ivideo = $(this).attr("link");
                $("#video").prepend("<div id='video-wvideo'>"+$ivideo+"</div>").prepend("<div id='video-close'>CLOSE</div>");
                $('html, body').animate({ scrollTop: 0 }, 'slow');
                $("#video-close").click(function()
                {
                    $("#video").empty();
                    $(".google_iframe").remove();
                    $("#googlemap").hide();
                })
            })
        })
    }
}
function errr()
{
    error_dr();
    function error_dr()
    {
        $(document).ready(function()
        {
            $("body").prepend('<div id="errormsg">'+$errormsg+'</div>');
            $("#navigation").css({"top":"20px"});
            setInterval(hideerror,5000);
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
}
function gm()
{
    gm_dr();
    function gm_dr()
    {
        $(document).ready(function()
        {
            $("#info-dbtn-gm").show();
            $(".info-gmbtn-btn").show();
            $("#info-dbtn-gm").click(function()
            {
                $('html, body').delay(5000).scrollTop(60000);
            })
            $(".info-gmbtn-btn").click(function(e)
            {
                if($(e.target).attr("link") != "")
                {
                    $("#video").empty();
                    $(".google_iframe").remove();
                    $("#googlemap").hide();
                    $('html, body').scrollTop(0);
                    $("#googlemap").append('<iframe class="google_iframe" style="margin-left: 10px; margin-right: 10px;" width="90%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>');
                    $(".google_iframe").attr("src",$(e.target).attr("link")+"&z=15&output=embed");
                    $(".google_iframe").attr("height",$(window).height()+50);
                    $("#googlemap").show();
                }
            })
            $("#googlemap-hide").click(function()
            {
                $("#video").empty();
                $(".google_iframe").remove();
                $("#googlemap").hide();
            })
        })
    }
}
function review()
{
    review_dr();
    function review_dr()
    {
        $(document).ready(function()
        {
            setInterval(chktp,1000);
            validateq();
            $("form").submit(function()
            {
                if(parseInt($("#rpc-body-rev-d input[name='quan']").val()) > parseInt($("#rpc-body-rev-d input[name='quan']").attr("max")))
                {
                    $rerr = "Invalid quantity!";
                    $("#errormsg").remove();
                    $("body").prepend('<div id="errormsg">'+$rerr+'</div>');
                    $("#navigation").css({"top":"20px"});
                    setInterval(hideerror,5000);
                    $('html, body').scrollTop(0);
                    return false;
                }
                else if($("#rpc-body-rev-d select[name='rbst']").val() == 0)
                {
                    $rerr = "Please select address below";
                    $("#errormsg").remove();
                    $("body").prepend('<div id="errormsg">'+$rerr+'</div>');
                    $("#navigation").css({"top":"20px"});
                    setInterval(hideerror,5000);
                    $('html, body').scrollTop(0);
                    return false;
                }
            })
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
    function chktp()
    {
        $op = $(".rpc-body-rev-d-op").attr("op");
        $quan = $("input[name='quan']").val();
        $(".rpc-body-rev-d-dp").text($op*$quan);
        $ntp = $(".rpc-body-rev-d-dp").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $(".rpc-body-rev-d-dp").text("P "+$ntp);
    }
    function validateq()
    {
        $("input[name='quan']").keydown(function(event) {
                if(event.shiftKey)
                {
                    event.preventDefault();
                }

                if (event.keyCode == 46 || event.keyCode == 8)    
                {
                    
                }
                else {
                    if (event.keyCode < 95) {
                        if (event.keyCode < 48 || event.keyCode > 57) {
                            event.preventDefault();
                        }
                    } 
                    else {
                        if (event.keyCode < 96 || event.keyCode > 105) {
                            event.preventDefault();
                        }
                    }
                }
            });
    }
}
function payment()
{
    function _payment()
    {
        $("#paymentsummaryhide").click(function(e)
        {
            $("#rpc-body-revw-c .summary-b").slideToggle(200);
            if($(e.target).text() == "(HIDE)")
            {
                $(e.target).text("(SHOW)");
            }
            else
            {
                $(e.target).text("(HIDE)");
            }
        })
        submitpayment();
    }
    function submitpayment()
    {
        $("form").submit(function(e)
        {
            if($("form.submitnow").length == 0)
            {
                $(this).addClass("submitnow");
                $(this).submit();
            }
            else
            {
                $("#rpc-btn-n").attr("disabled","disabled");
            }
        })
    }
    function payment_init()
    {
        $(function()
        {_payment();})
    }
    payment_init();
}