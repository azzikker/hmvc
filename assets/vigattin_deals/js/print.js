print();
function print()
{
    $(document).ready(function()
    {
        $("#printimg").click(function()
        {
            $("div#vouch-c").jqprint();
            $(this).unbind();
            $url = location.href;
            $(this).click(function()
            {
                location.href = $url;
            })
        })
        $("#vouch").mouseenter(function()
        {
            $("#vouch-print").stop(true,true).animate({
                "height":"50px"
            })
        })
        $("#vouch").mouseleave(function()
        {
            $("#vouch-print").stop(true,true).animate({
                "height":"0"
            })
        })
    })
}