mdeal();
function mdeal()
{
    mdeal_document_ready();
    function mdeal_document_ready()
    {
        $(document).ready(function()
        {
            mdeal_autoload();
        })
    }
    function mdeal_autoload()
    {
        $up = $("#mdeal-rev-c-3-1 span").attr("op");
        $("#mdeal-rev-c-3-1").css({"width":"50%"});
        $(".mdeal-rev-c-3").append('<div id="mdeal-rev-c-3-2"></div>');
        $("#mdeal-rev-c-3-2").append('<div><label>Total Price</label></div>').append('<div>&#8369;<span>'+$up+'<span></div>');
        $("#mdeal-rev-c-3-2 span").text($("#mdeal-rev-c-3-2 span").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        $("#mdeal-rev-c-2-q select").change(function()
        {
            mdeal_chgprice();
        })
        $("#mdeal-rev-c-2-q select").keypress(function()
        {
            mdeal_chgprice();
        })
        $("#mdeal-rev-c-2-q select").keydown(function()
        {
            mdeal_chgprice();
        })
    }
    function mdeal_chgprice()
    {
            $up = $("#mdeal-rev-c-3-1 span").attr("op");
            $tp = parseInt($up*$("#mdeal-rev-c-2-q select").val());
            $("#mdeal-rev-c-3-2 span").text($tp);
            $("#mdeal-rev-c-3-2 span").text($("#mdeal-rev-c-3-2 span").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    }
}