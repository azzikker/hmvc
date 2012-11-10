function vigdeals()
{
    vigdeals_dr();
    function vigdeals_dr()
    {
        $(function()
        {
            textoverflow();
            locationtoggle();
            animatesteps();
            $(".deal-box-info-btnanddd-vgs").mouseenter(function(e)
            {
                $(e.currentTarget).find("#deal-box-info-btnanddd-vg-box-vgin").stop(true,true).animate({"right":"0px"},300);
            })
            $(".deal-box-info-btnanddd-vgs").mouseleave(function(e)
            {
                $(e.currentTarget).find("#deal-box-info-btnanddd-vg-box-vgin").stop(true,true).animate({"right":"232px"},300);
            })
            $(".deal-box-info-btnanddd-vgs a").attr("href",$(".deal-box-info-btnanddd-vgs a").attr("buylink"));
            $(".deal-box-info-btnanddd3-vgs").mouseenter(function(e)
            {
                $(e.currentTarget).find("#deal-box-info-btnanddd3-vg-box-vgin").stop(true,true).animate({"right":"0px"},300);
            })
            $(".deal-box-info-btnanddd3-vgs").mouseleave(function(e)
            {
                $(e.currentTarget).find("#deal-box-info-btnanddd3-vg-box-vgin").stop(true,true).animate({"right":"232px"},300);
            })
            $("#myaccount").parent().mouseenter(function()
            {
                $("#myaccount-menu").stop(true,true).slideDown();
            })
            $("#myaccount").parent().mouseleave(function()
            {
                $("#myaccount-menu").stop(true,true).slideUp();
            })
            /*if($(window).width() > 1300)
            {
                $("body").append("<div id='referafriend'><img src=''></div>");
                $("#referafriend").css({"top":"100px","right":"10px"});
                $("#referafriend img").css({width:"150px"});
            }*/
            $("#etcbtn-rec").click(function(e)
            {
                $recurl = $(this).parent().attr("href");
                $("body").prepend("<div id='recommendframe' style='display:none'><div id='recommendframe2'></div></div>").css({"overflow":"hidden"});
                $("#recommendframe").fadeIn();
                $("#recommendframe").css({height:"100%"});
                $("#recommendframe").prepend('<div id="vigloading"><img src="assets/vigattin_deals/images/loading2.gif" alt=""></div>')
                $("#recommendframe #vigloading").show();
                $("#recommendframe2").load($recurl+" .content",function()
                {
                    $("#recommendframe #vigloading").remove();
                    $("#recommend").removeClass("fleft").css({"margin":"auto","margin-top":"20px"});
                    $("#recommend-b-b div").find("input[type='submit']").parent().append("<input type='button' value='Cancel'>");
                    $("#recommend-b-b-rpu").attr("value",$("title").text()).attr({"readonly":"readonly"});
                    $("#recommend input[value='Cancel']").click(function()
                    {
                        $("#recommendframe").fadeOut(function()
                        {
                            $("#recommendframe").remove();
                        })
                        $("body").css({"overflow":"auto"});
                    })
                    $("#ads").remove();
                })
                history.pushState('', '', location.pathname);
                e.preventDefault();
            })
            if($(".ads-b").length > 5)
                {
                $("#ads-b-b-b").height(122 * ($(".ads-b").length - 1));
                setInterval(ads,5000);
            }
            else
                {
                adsme();
            }
            $("select[name='month']").append('<option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>');
            $("select[name='month']").change(function()
            {
                $monthsel = $(this).val();
                window.location.href='past_deals?m='+$monthsel+'';
            })
            //lavalamp();
        })
    }
    function animatesteps()
    {
        $("#rpc-h-div").css({"display":"none"});
        $(window).load(function()
        {
            $("#rpc-h-div")
            .slideToggle();
        })
    }
    function locationtoggle()
    {
        $("#location-ddown").click(function()
        {
            $("#locationt").slideToggle();
        })
    }
    function textoverflow()
    {
        $dbih = $("#deal-box-info").height();
        $(".btncontainer").each(function(a,b)
        {
            $dbi = $(b).parent().find("#deal-box-info-statement");
            $dbish = $dbi.outerHeight();
            $btnh = $(b).height() + $dbish;
            $url = $(b).find("a").attr("href");
            if($btnh > $dbih)
            {
                $dbi.attr("style","height:22px;overflow:hidden;position:relative;");
                $dbi.find(".readmore").remove();
                $dbi.append("<div class='readmore' style='text-shadow:0px 2px 5px black;position:absolute;left:75px;top:15px;background: rgba(51, 51, 51, 0.5);text-align: center;font-weight: bold;font-size: 11px;'>Hover to Read More..</div>");
                $dbi.mouseenter(function(e)
                {
                    $(e.target).find(".readmore").remove();
                    $(e.target).attr("style","left:5px;width:230px;position:absolute;z-index:200;background:#383737;overflow:visible;-moz-box-shadow: 0px 0px 8px #000000;-webkit-box-shadow: 0px 0px 8px #000000;box-shadow: 0px 0px 8px #000000;border:none 5px #000000;-moz-border-radius-topleft: 5px;-moz-border-radius-topright:5px;-moz-border-radius-bottomleft:5px;-moz-border-radius-bottomright:5px;-webkit-border-top-left-radius:5px;-webkit-border-top-right-radius:5px;-webkit-border-bottom-left-radius:5px;-webkit-border-bottom-right-radius:5px;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;");
                })
                $dbi.mouseleave(function(e)
                {
                    $(e.target).attr("style","height:22px;overflow:hidden;position:relative;");
                    $(e.target).find(".readmore").remove();
                    $(e.target).append("<div class='readmore' style='text-shadow:0px 2px 5px black;position:absolute;left:75px;top:15px;background: rgba(51, 51, 51, 0.5);text-align: center;font-weight: bold;font-size: 11px;'>Hover to Read More..</div>");
                })
            }
        })
    }
    function lavalamp()
    {
        var style = 'easeOutElastic';

        var default_left = Math.round($('#vlava li.selected').offset().left - $('#vlava').offset().left) + 210;
        var default_width = $('#vlava li.selected').width() - 50;

        $('#box').css({left: default_left});
        $('#box .head').css({width: default_width});

        $('#vlava li').hover(function () {

            left = Math.round($(this).offset().left - $('#vlava').offset().left) + 210;
            width = $(this).width(); 

            $('#box').stop(false, true).animate({left: left},{duration:1000, easing: style});    
            $('#box .head').stop(false, true).animate({width:width - 50},{duration:1000, easing: style});    

        }).click(function () {

            $('#vlava li').removeClass('selected');    

            $(this).addClass('selected');

        });

        $('#vlava').mouseleave(function () {

            default_left = Math.round($('#vlava li.selected').offset().left - $('#vlava').offset().left) + 210;
            default_width = $('#vlava li.selected').width() - 50;

            $('#box').stop(false, true).animate({left: default_left},{duration:1500, easing: style});    
            $('#box .head').stop(false, true).animate({width:default_width},{duration:1500, easing: style});        

        });
    }
    function ads()
    {
        if($("#ads-b-b.ads-b-b-h").length == 1)
            {
            $adsfhtml = $(".ads-b").first().parent().html();
            $adsflink = $("#ads-b-b a").first().attr("href");
            $(".ads-b").first().animate({"opacity":"0"},1000,function()
            {
                $(this).css({"opacity":"0.5"});
            });
            $("#ads-b-b").animate({"margin-top":"-112px"},1000,function()
            {
                $("#ads-b-b").append("<a href='"+$adsflink+"'>"+$adsfhtml+"</a>");
                $("#ads-b-b a").first().remove();
                $("#ads-b-b").css({"margin-top":"20px"});
                adsme();
            });
        }
    }
    function adsme()
    {
        $(".ads-b").mouseenter(function(e)
        {
            $(e.currentTarget).css({"-moz-box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)"});
            $(e.currentTarget).css({"-webkit-box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)"});
            $(e.currentTarget).css({"box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)"});
            $("#ads-b-b").removeClass("ads-b-b-h");
            $(".ads-b").stop(true,true).animate({"opacity":"0.1"});
            $(e.currentTarget).stop(true,true).animate({"opacity":"1"},500)
            $(e.currentTarget).find("#ads-b-h").show().css({"opacity":"0"}).animate({"opacity":"1"},500);
            $(e.currentTarget).mouseleave(function()
            {
                $(".ads-b").attr("style","");
                $(".ads-b").stop(true,true).animate({"opacity":"0.5"});
                $("#ads-b-b").addClass("ads-b-b-h");
                $(e.currentTarget).stop(true,true).animate({"opacity":"0.5"},500);
                $(e.currentTarget).find("#ads-b-h").stop(true,true).animate({"opacity":"0"},500).hide();
            })
        })
    }
}
function monthsel()
{
    $(function()
    {
        if($monthselected != "")
        {
            $monsel = parseInt($monthselected);
            $("option[value='"+$monsel+"']").attr("selected","selected");
        }
    })
}
function scrolleffect()
{
    function dr()
    {
        //first load
        $(".deal-box-imgs.notload").each(function(a,b)
        {
            if($(window).scrollTop()+$(window).height() > $(b).offset().top)
            {
                $(b).attr("src",$(b).attr("original")).removeClass("notload");
                $(b).parent()
                .append(
                "<div class='imgloading' style='position:absolute;z-index:202;left:0;right:0;top:100px;text-align:center;'><img src='assets/vigattin_deals/images/loading2.gif' style='width:40px;'></div>"
                );
                $(b).load(function()
                {
                    $(b).parent().find(".imgloading").remove();
                    $(b).hide();
                    $(b).removeAttr("original");
                    $(b).fadeIn(500,function()
                    {
                        $(b).attr("style","");
                    });
                })
            }
        })
        //auto load
        $(window).scroll(function()
        {
            $(".deal-box-imgs.notload").each(function(a,b)
            {
                if($(window).scrollTop()+$(window).height() > $(b).offset().top)
                {
                    $(b).attr("src",$(b).attr("original")).removeClass("notload");
                    $(b).parent()
                .append(
                "<div class='imgloading' style='position:absolute;z-index:202;left:0;right:0;top:100px;text-align:center;'><img src='assets/vigattin_deals/images/loading2.gif' style='width:40px;'></div>"
                );
                    $(b).load(function()
                    {
                        $(b).parent().find(".imgloading").remove();
                        $(b).hide();
                        $(b).removeAttr("original");
                        $(b).fadeIn(500,function()
                        {
                            $(b).attr("style","");
                        });
                    })
                }
            })
        })
    }
    function init()
    {
        $(function()
        {dr();})
    }
    init();
}
function viewvideo2()
{
    viewvideo2_dr();
    function viewvideo2_dr()
    {
        $(document).ready(function()
        {
            $(".pdeal-b-ib-e-b").click(function(e)
            {
                $videoi = $(this).find("#pdeal-b-ib-e-b-txt").attr("link");
                if($videoi != "")
                    {
                    $("body").css({"overflow":"hidden"});
                    $("body").prepend("<div id='watchvideo' style='display:none'></div>");
                    $("body").prepend("<div id='watchvideo2' style='display:none'><div style='position:relative; margin:auto;'>"+$videoi+"</div></div>");
                    $("#watchvideo2 div").append('<img id="vidclose" src="assets/vigattin_deals/images/close.png" alt="" style="position:absolute; top:-30px; right:-30px; cursor:pointer;">');
                    $("#watchvideo2").find("iframe").load(function(e)
                    {
                        $("#watchvideo").fadeIn();
                        $iwidth = $(this).width();
                        $iheight = $(this).height();
                        $wheights = $(window).height()/2;
                        $("#watchvideo2 div").width($iwidth).height($iheight);
                        $("#watchvideo2").fadeIn();
                        if($wheights > $iheight){
                        $("#watchvideo2").css({"margin-top":($wheights-$iheight)+50});}
                        $(this).css({"border":"5px solid black","-moz-box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)","-webkit-box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)","box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)"});
                    })
                    $("#vidclose").click(function()
                    {
                        $("body").css({"overflow":"auto"});
                        $("#watchvideo2").remove();
                        $("#watchvideo").fadeOut(function()
                        {
                            $("#watchvideo").remove();
                        })
                    })
                }
                else
                    {                   
                    $("#errormsg").remove();
                    $errormsg = "No video found";
                    $("body").prepend('<div id="errormsg">'+$errormsg+'</div>');
                    $("#errormsg").hide();
                    //$("html,body").scrollTop(0);
                    $("#errormsg").stop(true,true).fadeIn();
                    setInterval(hideerror,5000);
                }
            })
            $(".pdeal-b-ib-d-r-t").click(function(e)
            {
                $videoi = $(this).attr("link");
                if($videoi != "")
                    {
                    $("body").css({"overflow":"hidden"});
                    $("body").prepend("<div id='watchvideo' style='display:none'></div>");
                    $("body").prepend("<div id='watchvideo2' style='display:none'><div style='position:relative; margin:auto;'>"+$videoi+"</div></div>");
                    $("#watchvideo2 div").append('<img id="vidclose" src="assets/vigattin_deals/images/close.png" alt="" style="position:absolute; top:-30px; right:-30px; cursor:pointer;">');
                    $("#watchvideo2").find("iframe").load(function(e)
                    {
                        $("#watchvideo").fadeIn();
                        $iwidth = $(this).width();
                        $iheight = $(this).height();
                        $wheights = $(window).height()/2;
                        $("#watchvideo2 div").width($iwidth).height($iheight);
                        $("#watchvideo2").fadeIn();
                        if($wheights > $iheight){
                        $("#watchvideo2").css({"margin-top":($wheights-$iheight)+50});}
                        $(this).css({"border":"5px solid black","-moz-box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)","-webkit-box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)","box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)"});
                    })
                    $("#vidclose").click(function()
                    {
                        $("body").css({"overflow":"auto"});
                        $("#watchvideo2").remove();
                        $("#watchvideo").fadeOut(function()
                        {
                            $("#watchvideo").remove();
                        })
                    })
                }
                else
                    {
                    $("#errormsg").remove();
                    $errormsg = "No video found";
                    $("body").prepend('<div id="errormsg">'+$errormsg+'</div>');
                    $("#errormsg").hide();
                    //$("html,body").scrollTop(0);
                    $("#errormsg").stop(true,true).fadeIn();
                    setInterval(hideerror,5000);
                }
            })
            $(".deal-box-info-btnanddd-wv").click(function(e)
            {
                $videoi = $(this).find("div").attr("link");
                if($videoi != "")
                    {
                    $("body").css({"overflow":"hidden"});
                    $("body").prepend("<div id='watchvideo' style='display:none'></div>");
                    $("body").prepend("<div id='watchvideo2' style='display:none'><div style='position:relative; margin:auto;'>"+$videoi+"</div></div>");
                    $("#watchvideo2 div").append('<img id="vidclose" src="assets/vigattin_deals/images/close.png" alt="" style="position:absolute; top:-30px; right:-30px; cursor:pointer;">');
                    $("#watchvideo2").find("iframe").load(function(e)
                    {
                        $("#watchvideo").fadeIn();
                        $iwidth = $(this).width();
                        $iheight = $(this).height();
                        $wheights = $(window).height()/2;
                        $("#watchvideo2 div").width($iwidth).height($iheight);
                        $("#watchvideo2").fadeIn();
                        if($wheights > $iheight){
                        $("#watchvideo2").css({"margin-top":($wheights-$iheight)+50});}
                        $(this).css({"border":"5px solid black","-moz-box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)","-webkit-box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)","box-shadow":"1px 11px 15px 10px rgba(0, 0, 0, 0.4)"});
                    })
                    $("#vidclose").click(function()
                    {
                        $("body").css({"overflow":"auto"});
                        $("#watchvideo2").remove();
                        $("#watchvideo").fadeOut(function()
                        {
                            $("#watchvideo").remove();
                        })
                    })
                }
                else
                    {
                    $("#errormsg").remove();
                    $errormsg = "No video found";
                    $("body").prepend('<div id="errormsg">'+$errormsg+'</div>');
                    $("#errormsg").hide();
                    //$("html,body").scrollTop(0);
                    $("#errormsg").stop(true,true).fadeIn();
                    setInterval(hideerror,5000);
                }
            })
        })
    }
    function hideerror()
    {
        $("#errormsg").stop(true,true).fadeOut(function()
        {
            $(this).remove();
        })
    }
}
function googlemap()
{
    googlemap_dr();
    function googlemap_dr()
    {
        $(document).ready(function()
        {
            $("#deal-info-c-gm").parent().find("li").each(function(a,b)
            {
                $(b).click(function(e)
                {
                    $gmlink = $(e.currentTarget).attr("link");
                    if($gmlink == "")
                    {
                        $("#deal-info-c-gm").empty();
                    }
                    else
                    {
                        $("#deal-info-c-gm").empty().append("<iframe class=\"google_iframe\" width=\"300\" scrolling=\"no\" height=\"300\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\"></iframe>");
                        $("#deal-info-c-gm iframe").attr("src",$gmlink+"&z=15&output=embed");
                    }
                })
            })
        })
    }
}
function slideshow()
{
    //slideshow_dr();
    function slideshow_dr()
    {
        $(document).ready(function()
        {
            $dbis = $(".deal-box-imgs");
            $imgl = $dbis.length;
            if($imgl > 1)
            {
                $dbi = $("#deal-box-img");
                $imgw = $dbis.width();
                $imgh = $dbis.height();
                imgbuttons();
                hoverbuttons();
                clickimg();
                $timer = setInterval(chgimg,5000);
            }
        })
    }
    function hoverbuttons()
    {
        $(".imgbtns").mouseenter(function(e)
        {
            $(e.target).find("div").stop(true,true).fadeIn();
        })
        $(".imgbtns").mouseleave(function(e)
        {
            $(e.target).find("div").stop(true,true).fadeOut();
        })
    }
    function chgimg()
    {
        $dbis.attr("style","");
        if($(".imgbtns.active").next().length == 0)
        {
            $(".imgbtns").first().click();
        }
        else
        {
            $(".imgbtns.active").next().click();
        }
    }
    function clickimg()
    {
        $(".imgbtns").click(function(e)
        {
            clearInterval($timer);
            $timer = setInterval(chgimg,5000);
            if($(e.target).hasClass("active") == false)
            {
                $btn = $(e.target).attr("btn");
                $prevbtn = $(".imgbtns.active").attr("btn");
                if($prevbtn > $btn)
                {
                    imgright();
                }
                else
                {
                    imgleft();
                }
                $(".imgbtns").removeClass("active");
                $(e.target).addClass("active");
            }
        })
    }
    function imgright()
    {
        $dbis.attr("style","");
        $(".deal-box-imgs#"+$prevbtn+"")
        .stop(true,true)
        .animate({
            "margin-left":$imgw
        },function()
        {
            $(".deal-box-imgs#"+$prevbtn+"").removeClass("active");
        })
        $(".deal-box-imgs#"+$btn+"")
        .addClass("active")
        .css({
            "margin-left":-$imgw
        })
        .stop(true,true)
        .animate({
            "margin-left":"0"
        })
    }
    function imgleft()
    {
        $dbis.attr("style","");
        $(".deal-box-imgs#"+$prevbtn+"")
        .stop(true,true)
        .animate({
            "margin-left":-$imgw
        },function()
        {
            $(".deal-box-imgs#"+$prevbtn+"").removeClass("active");
        })
        $(".deal-box-imgs#"+$btn+"")
        .addClass("active")
        .css({
            "margin-left":$imgw
        })
        .stop(true,true)
        .animate({
            "margin-left":"0"
        })
    }
    function imgbuttons()
    {
        $dbi.append("<div id='imgnav'></div>");
        $("#imgnav")
        .css({
            "height":"20px",
            "width":"20px",
            "margin":"auto",
            "position":"absolute",
            "top":($imgh-20),
            "left":"0",
            "right":"0"
        })
        for($i=1;$i<=$imgl;$i++)
        {
            $imgbtns = $(".deal-box-imgs#"+$i+"").attr("src2");
            $("#imgnav").append("<div class='imgbtns' btn='"+($i)+"'><div><img src='assets/general/images/deals_gallery/thumbnail/"+($imgbtns)+"'></div></div>");
            $(".imgbtns div img").load(function(e)
            {
                $(".imgbtns div").css({
                    "width":$(e.target).width()
                });
            })
        }
        $("#imgnav").width($("#imgnav").width()*$i);
        $(".imgbtns")
        .css({
            "width":"20px",
            "height":"12px",
            "position":"relative",
            "float":"left",
            "cursor":"pointer",
            "z-index":"200"
        })
        $(".imgbtns").first().addClass("active");
        $dbis.first().addClass("active");
    }
    /*slideshow_dr();
    function slideshow_dr()
    {
        $(document).ready(function()
        {
            $dbi = $(".deal-box-imgs");
            $imgw = $dbi.width();
            $imgl = $dbi.length;
            $cnt = 0;
            $("#deal-box-img div").width($imgw * $imgl);
            if($imgl > 1)
                {
                $("#deal-box-img").append("<div id='loadingimg'><img src='assets/vigattin_deals/images/loading.gif'></div>");
                $(".deal-box-imgs").ready(function()
                {
                    $("#loadingimg").remove();
                    $cnt = $imgl;
                    setInterval(chgimg,0);
                })
            }
        });
    }
    function chgimg()
    {
        $("#deal-box-img div").unbind();
        for($i=0;$i<$cnt;$i++)
            {
            $("#deal-box-img div").delay(5000).animate({"margin-left":"-"+($imgw * $i)},500);
        }
        $("#deal-box-img div").delay(5000).animate({"margin-left":"0px"},1000);
    }*/
}
function payment()
{
    payment_dr();
    function payment_dr()
    {
        $(document).ready(function()
        {
            $("#rpc-ba-c input").attr("placeholder","Type here...");
            $("#rpc-ba-c-i input").focusin(function()
            {
                $(this).animate({"background-color":"#fff"},500).css({"color":"#000"});
            })
            $("#rpc-ba-c-i input").focusout(function(e)
            {
                $(this).animate({"background-color":"#454545"},500).css({"color":"#7b7b7b"});
            })
            $("input[name='zc'],input[name='pn']").keydown(function(event) {
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
            $("form").submit(function(e)
            {
                if($("form.submitnow").length == 0)
                {
                    $("span[id^='error']").empty();
                    $fn = $("input[name='fn']").val();
                    $pn = $("input[name='pn']").val();
                    $add1 = $("input[name='add1']").val();
                    $ct = $("input[name='ct']").val();
                    $prov = $("input[name='prov']").val();
                    $zc = $("input[name='zc']").val();
                    $errors = 0;
                    if(!$fn)
                    {
                        $("#errorfn").text("Please type your Full Name");
                        $errors = 1;
                    }
                    if(!$pn)
                    {
                        $("#errorpn").text("Please type your Phone Number");
                        $errors = 1;
                    }
                    if(!$add1)
                    {
                        $("#erroradd1").text("Please type your Address");
                        $errors = 1;
                    }
                    if(!$ct)
                    {
                        $("#errorct").text("Please type your City");
                        $errors = 1;
                    }
                    if(!$prov)
                    {
                        $("#errorprov").text("Please type your Province");
                        $errors = 1;
                    }
                    if(!$zc)
                    {
                        $("#errorzc").text("Please type your Zip Code");
                        $errors = 1;
                    }
                    if($errors == 0)
                    {
                        if(hasNumber($("input[name='add1']").val()) == true)
                        {
                            $(this).addClass("submitnow");
                            $(this).submit();
                        }
                        else
                        {
                            $("#erroradd1").text("Please type your Address with Unit Number");
                            e.preventDefault();
                        }
                    }
                    else
                    {
                        e.preventDefault();
                    }
                }
                else
                {
                    $("#rpc-btn-ns").attr("disabled","disabled");
                    $("#rpc-btn").append("<div id='btnloading'><img src='assets/vigattin_deals/images/loading2.gif' style='width:40px'></div>");
                    $("#btnloading").css({"position":"absolute","right":"130px","top":"3px"});
                }
            })
        })
    }
}
function hasNumber(s) 
{
  return /\d/.test(s);
}
function profile()
{
    profile_dr();
    function profile_dr()
    {
        $(document).ready(function()
        {
            $("#profile-c-c-i input").focusin(function()
            {
                $(this).animate({"background-color":"#fff"},500).css({"color":"#000"});
            })
            $("#profile-c-c-i input").focusout(function()
            {
                $(this).animate({"background-color":"#454545"},500).css({"color":"#7b7b7b"});
            })
        })
    }
}
function prequest()
{
    prequest_dr();
    function prequest_dr()
    {
        $(document).ready(function()
        {
            $(".pdeal-b-ib-req").click(function(e)
            {
                if($(e.target).hasClass("reqed") == false && $(e.target).hasClass("pdeal-b-ib-req") == true)
                    {
                    $pdealid = $(this).attr("deal");
                    $.post("vigdeals/vigdealswauth/request", {deal_id:$pdealid}, function(data)
                    {
                        success:
                        {
                            $(e.target).addClass("reqed");
                            $requests = parseInt($(e.target).parent().find("#pdeal-b-ib-req-cnt span").text());
                            $(e.target).parent().find("#pdeal-b-ib-req-cnt span").text($requests+1);
                        }
                    })
                }
            })
        })
    }
}
function errr()
{
    errr_dr();
    function errr_dr()
    {
        $(function()
        {
            history.pushState('', '', location.pathname);
            $("#errormsg").remove();
            $("body").prepend('<div id="errormsg">'+$errormsg+'</div>');
            if($bgerror != "")
                {
                $("#errormsg").css({background:$bgerror});
            }
            $("#errormsg").hide();
            //$("html,body").scrollTop(0);
            $("#errormsg").fadeIn();
            setInterval(hideerror,5000);
        })
    }
    function hideerror()
    {
        $("#errormsg").fadeOut(function()
        {
            $(this).remove();
        })
    }
}
