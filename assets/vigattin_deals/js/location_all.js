location_address();
function location_address() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { relocate_map(); } 
} 
function relocate_map() {
    $('.location_click').click(function(e) { 
        $locate_address = $(e.target).attr("link");
        if($locate_address == "") {
            $('.google_iframe').attr("src",$locate_address);
        }
        else {
            $('.google_iframe').attr("src",$locate_address+"&z=15&output=embed");
        }
        //alert($locate_address);
    });
}