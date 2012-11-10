reviewcart();
function reviewcart()
{
    reviewcart_dr();
    function reviewcart_dr()
    {
        $(document).ready(function()
        {
            setInterval(chngquan,500);
            validateq();
            cbinput();
            chkinput();
            $("#rpt-t-th-cb input").click(function()
            {
                if($(this).is(":checked") == true)
                {
                    $("#rpt-t-tb-cb input").attr("checked","checked");
                    $("#rpt-t-tb-cb input").parent().parent().css({"background":"#2B2A2A"});
                }
                else
                {
                    $("#rpt-t-tb-cb input").removeAttr("checked");
                    $("#rpt-t-tb-cb input").parent().parent().css({"background":"#3b3b3b"});
                }
            })
            $("form").submit(function(e)
            {
                e.preventDefault();
                $checked = $(".rpt-t-tb-cb input:checked").length;
                if($checked == 0)
                {
                    $("#errormsg").remove();
                    if($(".rpt-t-tb-q").length != 0)
                    {
                        $errormsg = "Please check atleast one cart.";
                    }
                    else
                    {
                        $errormsg = "Your cart is empty.";
                    }
                    $("body").prepend('<div id="errormsg">'+$errormsg+'</div>');
                    $("#navigation").css({"top":"20px"});
                    $("html,body").scrollTop(0);
                    setInterval(hideerror,5000);
                }
                else
                {
                    chkfields();
                }
            })
            $(".rpt-t-tb-d-opt input").each(function(a,b)
            {
                $(b).change(function(e)
                {
                    if($(e.target).attr("qty") != 0)
                    {
                        $qty = $(e.target).parent().parent().parent().find(".rpt-t-tb-q");
                        $qty.find("input").removeAttr("disabled").val(1);
                        $qty.find("input").attr("max",$(e.target).attr("qty"));
                        $qty.find("span#ql").text($(e.target).attr("qty"));
                    }
                    else
                    {
                        $(b).attr("disabled","disabled");
                    }
                })
            })
        })
    }
    function chkinput()
    {
        $(".rpt-t-tb-q input").keyup(function(e)
        {
            if($(e.target).val() == "")
            {
                $(e.target).val("1");
            }
        })
    }
    function chkfields(e)
    {
        $("span[id^='error']").empty();
        $("td").css({"background-color":"","border-color":""});
        $locerr = 0;
        $quanerr = 0;
        $opterr = "";
        $("#rpt-t-tb-rbst select").each(function(d,e)
        {
            if(ischeck(e) == 1)
            {
                $parents = $(e).parents("tr");
                $parents2 = $(e).parents("td");
                if($parents.find("#rpt-t-tb-rbst select").val() == 0)
                {
                    $parents.find("#errorloc").text("Please Select Address");
                    $parents2.css({"background-color":"#181818","border-color":"#6F3533"});
                    $locerr = 1;
                }
            }
        })
        $(".rpt-t-tb-q input").each(function(d,e)
        {
            if(ischeck(e) == 1)
            {
                $parents = $(e).parents("tr");
                $parents2 = $(e).parents("td");
                if($parents.find(".rpt-t-tb-d-opt").length == 0)
                {
                    if($parents.find(".rpt-t-tb-q input").val() == 0)
                    {
                        $parents.find("#errorquan").text("Please put a valid quantity.");
                        $parents2.css({"background-color":"#181818","border-color":"#6F3533"});
                        $quanerr = 1;
                    }
                    if($parents.find(".rpt-t-tb-q input").val() > parseInt($parents.find(".rpt-t-tb-q input").attr("max")))
                    {
                        $parents.find("#errorquan").text("Please lessen the quantity");
                        $parents2.css({"background-color":"#181818","border-color":"#6F3533"});
                        $quanerr = 1;
                    }
                }
                else
                {
                    $opterr = 0;
                    if($parents.find(".rpt-t-tb-d-opt input:checked").length == 0)
                    {
                        $t = $parents.find("#rpt-t-tb-d-opt-sel").text();
                        $parents.find("#erroropt").text("Please select "+$t);
                        $parents.find("#erroropt").parents("td").css({"background-color":"#181818","border-color":"#6F3533"});
                        $opterr = 1;
                    }
                }
            }
        })
        if($locerr == 0 && $quanerr == 0)
        {
            if($opterr == "")
            {
                $("form").unbind().submit();
            }
            else
            {
                if($opterr == 0)
                {
                    $("form").unbind().submit();
                }
                else
                {
                    $("html,body").scrollTop(0);
                }
            }
        }
        else
        {
            $("html,body").scrollTop(0);
        }
    }
    function ischeck(e)
    {
        $ischeck = $(e).parents("tr").find(".rpt-t-tb-cb input:checked").length;
        return $ischeck;
    }
    function cbinput()
    {
        $("#rpt-t-tb-cb input").click(function()
        {
            $("#rpt-t-th-cb input").removeAttr("checked");
        })
        $("#rpt-t-tb-cb input").change(function()
        {
            if($(this).is(":checked") == true)
            {
                $(this).parent().parent().css({"background":"#2B2A2A"});
            }
            else
            {
                $(this).parent().parent().css({"background":"#3b3b3b"});
            }
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
            $("#paymentframe2 form").wrap("<div class='content'>");
            if($("#paymentframe2 #ads").length == 0)
            {
                $("#paymentframe2 .content").hide().ready(function()
                {
                    $("#paymentframe2 .content").show();
                    $("#paymentframe").css({height:"auto"});
                    $("#paymentframe #vigloading").remove();
                    $("#rpc-btn-b").text("Cancel");
                    $("#rpc-btn-b").click(function()
                    {
                        $("body").css({"overflow":"auto"});
                        $("#paymentframe").remove();
                        return false;
                    })
                    $.getScript("assets/vigattin_deals/js/payment.js");
                })
            }
            else
            {
                $("#paymentframe").remove();
            }
            $("#temp").remove();
        })
    }
    function chngquan()
    {
        totaldue();
        $(".rpt-t-tb-q input").each(function(d,e)
        {
            $q = parseInt($(this).val());
            if($q > 0)
            {
                $up = parseInt($(e).parent().parent().find("#rpt-t-tb-up").text().replace(",","").replace("P","").replace(" ",""));
                $tp = ($up * $q);
                $(e).parent().parent().find("#rpt-t-tb-tp").text($tp);
                $ntp = $(e).parent().parent().find("#rpt-t-tb-tp").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $(e).parent().parent().find("#rpt-t-tb-tp").text("P "+$ntp);
            }
        })
    }
    function totaldue()
    {
        $td = 0;
        $tp = 0;
        $w = 0;
        $(".rpt-t-tb-cb input:checked").each(function(a,b)
        {
            $u =  $(b).parent().parent().find(".rpt-t-tb-q input").val();
            $up = parseInt($(b).parent().parent().find(".rpt-t-tb-up").text().replace(",","").replace("P ",""));
            $tp = $tp + ($u * $up);
            //$tp = $tp + parseInt($(this).parent().parent().find(".rpt-t-tb-tp").text().replace(",","").replace("P ",""));
        });
        $td = $tp;
        $("#rpc-td span").text($td);
        $ntd = $("#rpc-td span").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $("#rpc-td span").text($ntd);
    }
    function hideerror()
    {
        $("#errormsg").animate({"margin-top":"-20"},500,function()
        {
            $(this).remove();
            $("#navigation").css({"top":"0px"});
        });
    }
    function validateq()
    {
        $(".rpt-t-tb-q").each(function(a,b)
        {
            $(b).keydown(function(event) {
                if(event.shiftKey)
                    {
                    event.preventDefault();
                }

                if (event.keyCode == 46 || event.keyCode == 8)    {
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