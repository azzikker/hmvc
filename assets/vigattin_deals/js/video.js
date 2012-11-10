viewvideo();
function viewvideo()
{
    vv_d_r();
    function vv_d_r()
    {
        $(document).ready(function()
        {
            vv_click_event();
        })
    }
    function vv_click_event()
    {
        $(".dealsview-video-button").click(function()
        {
            $video = $(this).attr("attr");
            $("body").css({"overflow":"hidden"});
            $(".dealsview-videocontainer").append("<div class='dealsview-videocontainer-bg'></div>");
            $(".dealsview-videocontainer-bg").click(function()
            {
                $("body").css({"overflow":"auto"});
                $(".dealsview-videocontainer").empty();
            })
            $(".dealsview-videocontainer").append("<div class='dealsview-videocontainer-bg2'></div>");
            $(".dealsview-videocontainer-bg2").click(function()
            {
                $("body").css({"overflow":"auto"});
                $(".dealsview-videocontainer").empty();
            })
            $(".dealsview-videocontainer-bg2").append("<div>"+$video+"</div>");
            $(".dealsview-videocontainer-bg2 iframe").load(function()
            {
                $(this).css({"border":"10px solid black","-moz-box-shadow":"1px 2px 5px black","-webkit-box-shadow":"1px 2px 5px black","box-shadow":"1px 2px 5px black"});
                $(".dealsview-videocontainer-bg2 iframe").parent().append("<div class='dealsview-videocontainer-close'>Close</div>");
                create_closevid_butt_action();
            })
        });
    }
    function create_closevid_butt_action()
    {
        $(".dealsview-videocontainer-close").click(function()
        {
            $("body").css({"overflow":"auto"});
            $(".dealsview-videocontainer").empty();
        }) 
    }
}