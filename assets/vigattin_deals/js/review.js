review_cart();
function review_cart()
{
    document_ready();
    function document_ready()
    {
        $(document).ready(function()
        {
            click_event();
        })
    }
    function click_event()
    {
        $(".quanup").click(function()
        {
            $maxquan = parseInt($(".quannum").attr("maxquantity"));
            $quan = parseInt($(".quannum").text());
            $quan = $quan + 1;
            if($quan <= $maxquan)
            {
                $(".quannum").text($quan);
                $(".review-submit input[name='quantity']").attr("value",$quan);
                $unit = parseInt($(".unit label").attr("unit"));
                $unit = $unit * $quan;
                $(".total label").text($unit);
                $(".total label").text($(".total label").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                $(".rf-top #due label").text($unit);
                $(".rf-top #due label").text($(".rf-top #due label").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            }
        })
        $(".quandown").click(function()
        {
            $quan = parseInt($(".quannum").text());
            $quan = $quan - 1;
            if($quan > 0)
                {
                $(".quannum").text($quan);
                $(".review-submit input[name='quantity']").attr("value",$quan);
                $unit = parseInt($(".unit label").attr("unit"));
                $unit = $unit * $quan;
                $(".total label").text($unit);
                $(".total label").text($(".total label").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                $(".rf-top #due label").text($unit);
                $(".rf-top #due label").text($(".rf-top #due label").text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            }
        })
        $(".review-submit input[type='submit']").click(function()
        {
            $locval = $(".redemption option:selected").attr("value");
            if($locval == 0)
            {
                alert("Please Select Address");
                return false;
            }
        })
        $(".redemption select").change(function()
        {
            $loc = $(".redemption select option:selected").attr("value");
            $(".review-submit input[name='loc']").attr("value",$loc);
        })
        $(".deals select").change(function()
        {
            $rcid = $(".deals option:selected").attr("id");
            $rcdivid = $(".review-container div[id='"+$rcid+"']");
            $rctitle = $rcdivid.attr("rctitle");
            $rcmaxq = $rcdivid.attr("maxquantity");
            $rccontent = $rcdivid.attr("rccontent");
            $rcutd = $rcdivid.attr("rcutd");
            $rcimg = $rcdivid.html();
            $rcpar = $(".deals img").parent();
            $rcpar.find("img").remove();
            $rcpar.prepend($rcimg);
            $rcpar.find("span").first().text($rctitle);
            $(".rb-body .unit label").text($rcutd);
            $(".rb-body .total label").text($rcutd);
            $(".review-footer #due label").text($rcutd);
            $(".quan .quannum").text(1);
            $(".quan .quannum").attr("maxquantity",$rcmaxq);
            $(".review-submit input[name='buy2']").attr("value",$rcid);
        })
    }
}