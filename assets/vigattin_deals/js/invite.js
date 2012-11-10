invite();
function invite()
{
    $(document).ready(function()
    {
        zclip();
        $("input[value='Copy']").click(function()
        {
            zclip();
        })
        $("input[value='+']").click(function()
        {
            $trhtml = $(".invite-b-tb tbody tr").html();
            $(".invite-b-tb tbody").append("<tr>"+$trhtml+"</tr>");
            $invni = parseInt($("input[name='inv-ni']").val());
            $("input[name='inv-ni']").val($invni+1);
            zclip();
        })
        $("input[value='-']").click(function()
        {
            if($(".invite-b-tb tbody tr").length > 1)
                {
                $(".invite-b-tb tbody tr").last().remove();
                $invni = parseInt($("input[name='inv-ni']").val());
                $("input[name='inv-ni']").val($invni-1);
                zclip();
            }
        })
        $("form").submit(function()
        {
            $("#invite-b-ar-lding").hide();
            $("#invite-b-ar-lding").fadeIn(300);
        })
    })
    function zclip()
    {
        $("input[value='Copy']").zclip(
        {
            path:'assets/vigattin_deals/js/zclip/ZeroClipboard.swf',
            copy:$('input[readonly="readonly"]').val(),
            beforeCopy:function()
            {
                $("#invite-b-msgd").text("Copying...").css({color:"red"});
                $("input[readonly='readonly']").css({background:"red"});
                $("#invite-b-chk").hide();
            },
            afterCopy:function()
            {
                $("#invite-b-msgd").text("Done!").css({color:"green"});
                $("input[readonly='readonly']").css({background:"green"});
                $("input[readonly='readonly']").stop(true,true).animate({"background-color":"#111111"},1000);
                $("#invite-b-chk").fadeIn(200);
            }
        })
    }
}