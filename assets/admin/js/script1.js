/*$(document).ready(function() { $(".tablesorter").tablesorter(); });
$(document).ready(function() {
    //When page loads...
    $(".tab_content").hide(); //Hide all content
    $("ul.tabs li:first").addClass("active").show(); //Activate first tab
    $(".tab_content:first").show(); //Show first tab content

    //On Click Event
    $("ul.tabs li").click(function() {

        $("ul.tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(".tab_content").hide(); //Hide all tab content

        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active ID content
        return false;
    });
}); */
//----------------------------
$(function() { $('.column').equalHeight(); });
//----------------------------
function showList() { 
    $('.add_member').fadeOut(function() { $('.list_member').fadeIn('fast');  window.scrollTo(0,0) });        
    $('.print_member').fadeOut(function() { $('.list_member').fadeIn('fast');  window.scrollTo(0,0) });
    
    $('#optionz').removeAttr('required');        
    $('#optionz'+count).removeAttr('required');        
}
function showAdd() {
    $('.list_member').fadeOut(function() { $('.add_member').fadeIn('fast');  window.scrollTo(0,0) });
    
    $('#optionz').attr('required','required');    
    $('#optionz'+count).attr('required','required');    
}
function showPrint() {
    $('.list_member').fadeOut(function() { $('.print_member').fadeIn('fast');  window.scrollTo(0,0) });    
}
function showEdit() {
    $('.list_member').fadeOut(function() { $('.edit_member').fadeIn('fast'); window.scrollTo(0,0) });    
}
function showSetting() {
    $('.display_member').fadeOut(function() { $('.setting_member').fadeIn('fast'); window.scrollTo(0,0) });    
}
function showDisplay() {
    $('.setting_member').fadeOut(function() { $('.display_member').fadeIn('fast'); window.scrollTo(0,0) });    
}
function showProfile() {
    $('.branch_member').fadeOut(function() { $('.profile_member').fadeIn('fast'); window.scrollTo(0,0) });
}
function showBranch() {
    $('.profile_member').fadeOut(function() { $('.branch_member').fadeIn('fast'); window.scrollTo(0,0) });
}
//----------------------------
function c_ask($msg) {
    var del = confirm($msg);
    if(del) { return true; } else { return false; }
}
//----------------------------
function c_view($msg) {
    var del = alert($msg);
}
//---------------------------- 
/*function discounted() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event() }); }
    function onchange_event() {
        $('.discount').keyup(function() {
            var w=100;
            var x=$('.original').val();
            var y=($('.discount').val()/w)*x;
            var z=x-y;
            $('.discounted').val(z);
        });
        $('.original').keyup(function() {
            var w=100;
            var x=$('.original').val();
            var y=($('.discount').val()/w)*x;
            var z=x-y;
            $('.discounted').val(z);
        });
    }
}   */
//----------------------------
function stock_count() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event_single(); /*onchange_event_group(); */}); }
    function onchange_event_single() { 
        $('.editOStock').keyup(function() {
            var x=$('.editOStock').val()*1; a=$('.editOStock_old').val()*1; y=$('.editCStock').val()*1; b=$('.editCStock_old').val()*1; 
            if(x<=a) { var Ogap = a-x; NewCstock = b-Ogap; $('.editCStock').val(NewCstock); }
        });                                                                     
        $('.editOStock').keyup(function() {
            var x=$('.editOStock').val()*1; a=$('.editOStock_old').val()*1; y=$('.editCStock').val()*1; b=$('.editCStock_old').val()*1;
            if(x>=a) { var Ogap = x-a; NewCstock = b+Ogap; $('.editCStock').val(NewCstock); }
        });
        $('.editCStock').keyup(function() {
            var x=$('.editOStock').val()*1; a=$('.editOStock_old').val()*1; y=$('.editCStock').val()*1; b=$('.editCStock_old').val()*1;
            if(y>x) { var NewCstock = b; $('.editCStock').val(NewCstock); }
        });
        $('.editCStock').keyup(function() {
            var x=$('.editOStock').val()*1; a=$('.editOStock_old').val()*1; y=$('.editCStock').val()*1; b=$('.editCStock_old').val()*1;
            if(b==0) { var NewCstock = b; $('.editCStock').val(NewCstock); }
        })
    }
    /*function onchange_event_group() {
        var select_count=Number($("#mSELECTION_solo").attr("value"));
        var option_count=Number($("#mOPTION_solo"+select_count).attr("value"));
        $('.editOStock_solo'+select_count+'_'+option_count).keyup(function() {
            var x=$('.editOStock_solo'+select_count+'_'+option_count).val()*1; a=$('.editOStock_solo_old'+select_count+'_'+option_count).val()*1; y=$('.editCStock_solo'+select_count+'_'+option_count).val()*1; b=$('.editCStock_solo_old'+select_count+'_'+option_count).val()*1; 
            if(x<=a) { var Ogap = a-x; NewCstock = b-Ogap; $('.editCStock_solo'+select_count+'_'+option_count).val(NewCstock); }
        });                                                                     
        $('.editOStock_solo'+select_count+'_'+option_count).keyup(function() {
            var x=$('.editOStock_solo'+select_count+'_'+option_count).val()*1; a=$('.editOStock_solo_old'+select_count+'_'+option_count).val()*1; y=$('.editCStock_solo'+select_count+'_'+option_count).val()*1; b=$('.editCStock_solo_old'+select_count+'_'+option_count).val()*1;
            if(x>=a) { var Ogap = x-a; NewCstock = b+Ogap; $('.editCStock_solo'+select_count+'_'+option_count).val(NewCstock); }
        });
        $('.editCStock_solo'+select_count+'_'+option_count).keyup(function() {
            var x=$('.editOStock_solo'+select_count+'_'+option_count).val()*1; a=$('.editOStock_solo_old'+select_count+'_'+option_count).val()*1; y=$('.editCStock_solo'+select_count+'_'+option_count).val()*1; b=$('.editCStock_solo_old'+select_count+'_'+option_count).val()*1;
            if(y>x) { var NewCstock = b; $('.editCStock_solo'+select_count+'_'+option_count).val(NewCstock); }
        });
        $('.editCStock_solo'+select_count+'_'+option_count).keyup(function() {
            var x=$('.editOStock_solo'+select_count+'_'+option_count).val()*1; a=$('.editOStock_solo_old'+select_count+'_'+option_count).val()*1; y=$('.editCStock_solo'+select_count+'_'+option_count).val()*1; b=$('.editCStock_solo_old'+select_count+'_'+option_count).val()*1;
            if(b==0) { var NewCstock = b; $('.editCStock_solo'+select_count+'_'+option_count).val(NewCstock); }
        });
    }  */
}
//----------------------------------
function quantity_count() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event_quantity();}); }
    function onchange_event_quantity() {
        $('.editOQ').keyup(function() { 
            var v=$('.edtor').val()*1; w=$('.editRQ').val()*1; x=$('.editOQ').val()*1; y=$('.edtoq').val()*1; z=$('.editOQ_Old').val()*1;
            if(x>=y+z) { 
                var NewOQ = y+z; $('.editOQ').val(NewOQ);
                if(w>=$('.editOQ').val(NewOQ)) { $('.editRQ').val(NewOQ); } 
            }
            else if(x=="") { 
                var NewOQ = z; var Newor = v; $('.editOQ').val(NewOQ); $('.editRQ').val(Newor);
            }
        });
    }
}
//----------------------------------
function search_here() {
    if(!this._haschanged){this.value=''};this._haschanged=true;
}
//----------------------------------
function returned_count() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event_returned();}); }
    function onchange_event_returned() {
        $('.editRQ').keyup(function() { 
            var x=$('.editOQ').val()*1; y=$('.editRQ').val()*1;
            if(y>=x) { var NewRQ = x; $('.editRQ').val(NewRQ); }               
            else if(y=="") { var NewRQ = 0; $('.editRQ').val(NewRQ); }
        });
    }
} 
//----------------------------------
function quantity_returned_count() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event_qc();}); }
    function onchange_event_qc() {
        $('.editTQ').live("keyup", function() {
            var x=$('.editTQ').val()*1; z=$('.editRA').val()*1; 
            var a=$('.editTQ_old').val()*1; b=$('.editRA_old').val()*1;
            var NewTQ = a; NewRA = a*b;
            
            if(x>a) { 
                $('.editTQ').val(NewTQ); $(',editRA').val(NewRA); 
            }
            else if(x=="0") { 
                var NewTQ = "1"; $('.editTQ').val(NewTQ); $(',editRA').val(b); 
            }
            else { 
                $('.editRA').val(x*b); 
            }
        });
    }
}
//----------------------------------
function show_details() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { onclick_event() }); }
    function onclick_event() { 
        $('.show_details').click(function(a) {
            $show_count = $(a.target).attr("detail_count");
            //alert($(e.target).parent().html());
            $('.payment_details'+$show_count).stop(true,true).delay(100).toggle(500);
            if($(this).attr("id") == "icn_show_down")  {
                $(this).stop(true,true).attr("src","assets/admin/images/icn_hide_up.png");   
                $(this).stop(true,true).attr("id","icn_hide_up");
            }
            else {
                $(this).stop(true,true).attr("src","assets/admin/images/icn_show_down.png");   
                $(this).stop(true,true).attr("id","icn_show_down");
            }  
        });                    
    }                                                    
}
//-----------------------------------
function seach_audit(record) {
    window.location.replace("admin/admin_audit/index/"+record);
}
//-----------------------------------
function company_select(record) {
    window.location.replace("admin/admin_customers/index/"+record);
}
//-----------------------------------
function search_record(record) {
    if(!this._haschanged){this.value=''};this._haschanged=true;
}
//-----------------------------------
function deal_select(value) {
    var record = $(".company_select").val();
    window.location.replace("admin/admin_customers/index/"+record+"/"+value); 
}
//-----------------------------------
function subdeal_select(string) {
    var record = $(".company_select").val();
    var value = $(".deals_select").val();
    window.location.replace("admin/admin_customers/index/"+record+"/"+value+"/"+string); 
}
//-----------------------------------image filtering start
function eft() { 
    var extension = new Array();
    var link_location = document.URL;
    var fieldvalue1 = document.getElementById("image_upload").value;          
    var fieldvalue2 = document.getElementById("background_upload").value;  
    
    extension[0] = ".jpg"; extension[1] = ".jpeg";
    
    error101(extension, link_location, fieldvalue1, "?error1=1", "?error2=1");         
    error101(extension, link_location, fieldvalue2, "?error3=1", "?error4=1");    
}
function error101(extension, link_location, fieldvalue, errorA, errorB) {
    var thisext = fieldvalue.substr(fieldvalue.lastIndexOf('.'));
    for(var i = 0; i < extension.length; i++) { if(thisext == extension[i]) { return true; } }    
    if(fieldvalue != "") {  
        var x = link_location.replace(errorA,"");
        var y = x.replace(errorB,"");          
        window.location = y + errorB; 
    }
    return false;
}
//-----------------------------------image filtering end
//-----------------------------------video filtering start
gft();
function gft() {
    var location_action = document.URL;
    if($(".form").attr("action") != location_action+"?error5=1") {  
        $(".vid").live("keyup", function() {
            var form_action = $(".form").attr("action"); 
            var form_faction = $(".form").attr("faction"); 
            var videoUrl = $('.vid').val(); 
            //------------------------------
            var tag_start='(<)';    
            var iframe='(iframe)';    
            var ws='( )';    
            var width='(width)';   
            var eq='(=)';    
            var rw='("560")';   
            var height='(height)';    
            var rh='("315")';   
            var src='(src)';  
            var rq='(")';    
            var http='(http)';  
            var eqr='(:)'; 
            var eqs='(\\/)';
            var yl='(\\/www\\.youtube\\.com\\/embed\\/)([A-Za-z0-9-]+)';
            var frameborder='(frameborder)';   
            var ro='("0")';    
            var al='(allowfullscreen)';   
            var tag_end='(>)';    
            var tag='(<\\/iframe>)';
            var error="<h4 class=\"alert_error void\" style=\"margin-top: 110px;\">The embeded YouTube video is invalid. The format must be like this :<br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/videocode\" frameborder=\"0\" allowfullscreen&gt;&lt;/iframe&gt;</h4>"
            
            var p = new RegExp(tag_start+iframe+ws+width+eq+rw+ws+height+eq+rh+ws+src+eq+rq+http+eqr+eqs+yl+rq+ws+frameborder+eq+ro+ws+al+tag_end+tag,["i"]);
            var match = videoUrl.match(p);
            var m = p.exec(videoUrl);
            
            if (match || $(".vid").val()=="") { 
                $(".void").remove();
                $(".form").attr("action", form_faction);
                $(".alt_btn").show(); $(".blt_btn").hide();
            }
            else {
                $(".void").remove(); 
                $(".vid").after(error); 
                $(".form").attr("action", location_action+"?error5=1");
                $(".alt_btn").hide(); $(".blt_btn").show();       
            }
        });
    }              
}
//-----------------------------------video filtering end
//-----------------------------------I_R changes start
percetage_adjust();
function percetage_adjust() {
    $('.button_income').live("click", function() { 
        income_increase();
    });
    $('.button_remittance').live("click", function() {
        remittance_increase();   
    });
}
function income_increase() {
    $income = $('.a_income').val()*1 + 1;
    $remittance =  100 - $income;
    i_r_change();  
}
function remittance_increase() {
    $remittance =  100 - $('.a_income').val()*1 + 1;
    $income = 100 - $remittance;  
    i_r_change();
}
function i_r_change() {
    if($income == "0") { 
        $income = "99"; $('.a_income').val("99"); 
        $remittance = "1"; $('.a_remittance').val("1");
    }
    else if($income == "100") { 
        $income = "1"; $('.a_income').val("1"); 
        $remittance = "99"; $('.a_remittance').val("99"); 
    }
    $('.income').attr("style","width: "+$income+"%;");
    
    $('.a_income').attr("value",$income); $('.a_remittance').attr("value",$remittance);    
    
    $('.text_income').html(" INCOME ( <b>"+$income+"%</b> )");          
    $('.text_remittance').html(" REMITTANCE ( <b>"+$remittance+"%</b> )");
}
//-----------------------------------I_R changes end
//-----------------empty link start
function link_alternative() {}
//-----------------empty link end