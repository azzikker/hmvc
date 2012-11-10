print();
function print()
{
    $(document).ready(function()
    {
        $("input#printNdiv").click(function()
        {
            $("div#printN").jqprint();
        })
    })
}