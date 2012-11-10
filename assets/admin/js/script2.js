//----------------------------COMPANIES
function add_ccontact() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event() }); }
    function onchange_event() { insert_ccontact(); }
}
function edit_ccontact() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event() }); }
    function onchange_event() { custom_ccontact(); }
}
function delete_ccontact() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_ccontact() 
    }); }                                                    
} 
function insert_ccontact() {
    $("#add_more_ccontact").click(function() {
        var count_cc=Number($("#nCCONTACT").attr("value"))+1;
        $cc = $('#cc').append("<input id=\"options\" class=\"CN"+count_cc+" addCCN"+count_cc+"\" type=\"text\" name=\"addCCN"+count_cc+"\" maxlength=\"20\">");
        $("#nCCONTACT").attr("value",count_cc);
        $(".CC").attr("count_cc",count_cc);
        block_cc();
        return false;
    });
}
function custom_ccontact() {
    $("#add_more_ccontact").click(function() {
        var count_cc=Number($("#nCCONTACT").attr("value"))+1;
        $cc = $('#cc').append("<input id=\"options\" class=\"CN"+count_cc+" editCCN"+count_cc+"\" type=\"text\" name=\"editCCN"+count_cc+"\" maxlength=\"20\">");
        $("#nCCONTACT").attr("value",count_cc);
        $(".CC").attr("count_cc",count_cc);
        block_cc();
        return false;
    });
}
function remove_ccontact() { 
    $('.CC').click(function(a) {
        var count_cc=Number($("#nCCONTACT").attr("value"))-1;
        $count = $(a.target).attr("count_cc");
        $cc_value = $("#nCCONTACT").val();
        if($("#nCCONTACT").val()==$("#mCCONTACT").val()) {
            none_cc();
        }
        else {
            $(".CN"+$cc_value).remove(); 
            $("#nCCONTACT").attr("value",count_cc);
            $(".CC").attr("count_cc",count_cc);
        } 
    });                    
}
function none_cc() { 
    $(".CC").removeClass("on"); 
    $(".CC").addClass("off"); 
}
function block_cc() { 
    $(".CC").removeClass("off"); 
    $(".CC").addClass("on"); 
}
//----------------------------
function add_bcontact() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event() }); }
    function onchange_event() { insert_bcontact(); }
}
function edit_bcontact() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event() }); }
    function onchange_event() { custom_bcontact(); }
}
function delete_bcontact() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_bcontact() 
    }); }                                                    
} 
function insert_bcontact() {
    $("#add_more_bcontact").click(function() {
        var count_bc=Number($("#nBCONTACT").attr("value"))+1;
        $bc = $('#bc').append("<input id=\"options\" class=\"CN"+count_bc+" addBCN"+count_bc+"\" type=\"text\" name=\"addBCN"+count_bc+"\" maxlength=\"20\">");
        $("#nBCONTACT").attr("value",count_bc);
        $(".BC").attr("count_bc",count_bc);
        block_bc();
        return false;
    });
}
function custom_bcontact() {
    $("#add_more_bcontact").click(function() {
        var count_bc=Number($("#nBCONTACT").attr("value"))+1;
        $bc = $('#bc').append("<input id=\"options\" class=\"CN"+count_bc+" editBCN"+count_bc+"\" type=\"text\" name=\"editBCN"+count_bc+"\" maxlength=\"20\">");
        $("#nBCONTACT").attr("value",count_bc);
        $(".BC").attr("count_bc",count_bc);
        block_bc();
        return false;
    });
}
function remove_bcontact() { 
    $('.BC').click(function(a) {
        var count_bc=Number($("#nBCONTACT").attr("value"))-1;
        $count = $(a.target).attr("count_bc");
        $bc_value = $("#nBCONTACT").val();
        if($("#nBCONTACT").val()==$("#mBCONTACT").val()) {
            none_bc();
        }
        else {
            $(".CN"+$bc_value).remove(); 
            $("#nBCONTACT").attr("value",count_bc);
            $(".BC").attr("count_bc",count_bc);
        } 
    });                    
}
function none_bc() { 
    $(".BC").removeClass("on"); 
    $(".BC").addClass("off"); 
}
function block_bc() { 
    $(".BC").removeClass("off"); 
    $(".BC").addClass("on"); 
}
//----------------------------DEALS
function deal_type() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() {
         if($('#type').val()=="Single Deal") {
            remove(); remove_deals();
            $('#main_title').append("Deal Title"); $('#main_statement').append("Deal Statement");
            remove_add(); insert_amount(); insert_single();
        }
        else if($('#type').val()=="Group Deal") {
            remove(); remove_deals();
            $('#main_title').append("Main Title"); $('#main_statement').append("Main Statement");
            insert_add(); insert_deals(); insert_group();
        }
    }
}
function remove() { $('#main_title').empty(); $('#main_statement').empty(); }
function remove_deals() { $('#deal_header').empty(); $('#deals_cover').empty(); }
function remove_add() { $('#add_more').hide(); }
function insert_add() { $('#add_more').show(); }
//----------------------------
function insert_single() { 
    $('#deals_single').show(); 
    $('#deals_group').hide(); 
    stock_option_single_condition();
    hide_double();
    show_single();
    option_single();
    H_excess_single();
    T_excess_single();
    clear_location();
    /*selection_single(); option_single();*/ 
}
function insert_group() { 
    $('#deals_single').hide(); 
    $('#deals_group').show();  
    $('input#optionz1').attr('required','required');
    hide_single(); 
    show_double();
    option_group();
    H_excess_group();
    T_excess_group();
    clear_location();
    /*selection_group(); option_group();*/ 
}
//----------------------------clearing & cleaning operation start
function hide_single() {
    $(".single_id").removeAttr("required"); 
    $("input.single_id").attr("value","");
    $("textarea.single_id").attr("value","");
}
function show_single() {
    $(".single_id").attr("required","required");
    $("input.single_id").attr("value","");
    $("textarea.single_id").attr("value","");
}
function hide_double() {
    $(".double_id").removeAttr("required"); 
    $("input.double_id").attr("value","");
    $("textarea.double_id").attr("value","");
}
function show_double() {
    $(".double_id").attr("required","required");
    $("input.double_id").attr("value","");
    $("textarea.double_id").attr("value","");
}
//----------------------------clearing operation end
//----------------------------remove excess start
function OH_excess_single() { deal_stock_single1; }
function H_excess_single() {
    var count=$("#nDEAL").val();   
    $("#deal_highlights_group"+count).empty();
    //for single
    $("#deal_highlights_single").append("<input id=\"highlights\" class=\"single_id H1\" type=\"text\" name=\"addH_single1\" maxlength=\"255\" required=\"required\">");
    $("#nH_single").val(1);
    none_h_single();   
}
function T_excess_single() {
    var count=$("#nDEAL").val();
    $("#deal_terms_group"+count).empty();
    //for single
    $("#deal_terms_single").append("<input id=\"terms\" class=\"single_id T1\" type=\"text\" name=\"addT_single1\" maxlength=\"255\" required=\"required\">");
    $("#nT_single").val(1);
    none_t_single();   
}
//group
function H_excess_group() {
    $("#deal_highlights_single").empty();
    //for group
    var count=$("#nDEAL").val();
    $("#deal_highlights_group"+count).empty();
    $("#deal_highlights_group"+count).append("<input id=\"highlights\" class=\"double_id H"+count+"_1\" type=\"text\" name=\"addH_group"+count+"_1\" maxlength=\"255\" required=\"required\">");
    $("#nH_group"+count).val(1);
    none_h_group();
} 
function T_excess_group() {
    $("#deal_terms_single").empty();
    //for group 
    var count=$("#nDEAL").val();
    $("#deal_terms_group"+count).empty();
    $("#deal_terms_group"+count).append("<input id=\"terms\" class=\"double_id T"+count+"_1\" type=\"text\" name=\"addT_group"+count+"_1\" maxlength=\"255\" required=\"required\">");
    $("#nT_group"+count).val(1);
    none_t_group();
} 
//----------------------------remove excess end
//----------------------------option && non-option start
function option_single() {
    $("input#optionz1").val(""); $("input#optionz1").removeAttr("required");
    //for single 
    $("#option_switcher").val("NO OPTIONS"); 
    $("input#optionz").val(""); $("input#optionz").attr("required","required");
    $("input#options").val(""); $("input#options").removeAttr("required");     
    $(".none_option").show(); 
    $(".with_option").hide(); 
} 
function option_group() {
    $("input#optionz").val(""); $("input#optionz").removeAttr("required");
    //for group 
    $("#option_switcher1").val("NO OPTIONS"); 
    $("input#optionz1").val(""); $("input#optionz1").attr("required","required");  
    $("input#options").val(""); $("input#options").removeAttr("required");
    $(".none_option1").show(); 
    $(".with_option1").hide(); 
}
//----------------------------option && non-option end
//location reset start
function clear_location() {
    $("#deal_locations").empty();     
    $deal_locations = $('#deal_locations').append(
    "<fieldset class=\"A1\">" +
    "   <label>Address 1</label>" +
    "   <input id=\"locations\" type=\"text\" name=\"addLocation1\" required=\"required\">" +
    "   <label>Map Link <font color=\"green\"> ( <a href=\"http://maps.google.com.ph/\" target=\"_new\" id=\"view_map\" title=\"Get the Map Link on the Google Map\"> Open Google Map </a> )</font></label>" +
    "   <textarea id=\"locations\" class=\"link\" name=\"addLink1\" required=\"required\"></textarea>" +
    "</fieldset>"
    );
    $("#nLOCATION").val(1);
}
//location reset end
//----------------------------solo
function discounted_solo() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event() }); }
    function onchange_event() { discount_solo(); original_solo(); }
}
//----------------------------
function add_more_selection_solo() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { selection_solo(); }
}
//----------------------------
function add_more_option_solo() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { options_solo(); }
}
//----------------------------
function add_more_highlights_solo() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { highlights_solo(); }
}
//----------------------------
function add_more_terms_solo() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { terms_solo(); }
}
//----------------------------
function add_more_location_solo() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { location_solo(); }
}
//----------------------------single
function discounted_single() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event() }); }
    function onchange_event() { discount_single(); original_single(); }
}
//----------------------------
function add_more_selection_single() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { selection_single(); }
}
function add_more_stock_single() {}
//----------------------------
function add_more_option_single() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { options_single(); }
}
//----------------------------
function add_more_highlights_single() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { highlights_single(); }
}
//----------------------------
function add_more_terms_single() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { terms_single(); }
}
//----------------------------
function add_more_photo_single() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { photo_single(); }
}
//----------------------------group
function discounted_group() {
    document_ready();
    function document_ready() { $(document).ready(function() { onchange_event() }); }
    function onchange_event() { discount_group(); original_group(); }
}
//----------------------------
function add_more_selection_group() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { selection_group(); }
}
//----------------------------
function add_more_option_group() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { options_group(); }
}    
//----------------------------
function add_more_highlights_group() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { highlights_group(); }
}
//----------------------------
function add_more_terms_group() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { terms_group(); }
}
 //----------------------------
function remove_O_group() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_option_group() 
    }); }                                                    
}
//----------------------------
function remove_H_group() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_highlight_group() 
    }); }                                                    
}
//----------------------------
function remove_T_group() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_terms_group() 
    }); }                                                    
}
//----------------------------
function add_more_location() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() { location_all(); }
}
//----------------------------
//----------------------------
function remove_H_solo() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_highlight_solo()                  
    }); }                                                    
}
//----------------------------
function remove_T_solo() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_terms_solo()                  
    }); }                                                    
}
//----------------------------
function remove_A_all() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_location_all() 
    }); }                                                    
} 
//----------------------------
function insert_deals() {
    $('#deal_header').append("<h3>Group Deal Cover</h3>");
    $('#deals_cover').append(
    "<fieldset>" +
    "   <label>Deal Cover</label>" +
    "   <input class=\"double_id\" type=\"file\" name=\"addMC1\" required=\"required\">" +
    "   <h4 class=\"alert_info\">Required Image: (690 x 242) to (750 x 263) pixels JPG/JPEG</h4>" +
    "</fieldset>"
    );
    insert_add();
}
function insert_amount() {
    $('#deals').append(
    "<fieldset>" +
    "   <label>Original Price</label>" +
    "   <input type=\"text\" name=\"addOP\">" +
    "   <label>Discount (%)</label>" +
    "   <input type=\"text\" name=\"addD\">" +
    "   <label>Discounted Price</label>" +
    "   <input type=\"text\"  name=\"addDP\">" +
    "</fieldset>"
    );
}
//----------------------------     
function add_more_deal() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() {
        $("#add_more_deal").click(function() {
            var count=Number($("#nDEAL").attr("value"))+1;
            $('#deals_group').append(
            "<div class=\"deal_"+count+"\">" +
            "   <br><hr>" +
            "   <article class=\"module width_full\">" + 
            "       <header><h3>Deal "+count+"</h3></header>" + 
            "       <div style=\"margin: 20px;\">" + 
            "           <fieldset>" +
            "               <label>Deal Title</label><input class=\"double_id\" type=\"text\" name=\"addDN"+count+"\">" +
            "               <label>Deal Statement</label><input class=\"double_id\" type=\"text\" name=\"addDS"+count+"\">" +
            "           </fieldset>" +
            "           <fieldset>" +
            "               <label>Original Price</label>" +
            "               <input class=\"double_id original_group"+count+"\" type=\"text\" name=\"addOP"+count+"\" autocomplete=\"off\" maxlength=\"6\" required=\"required\">" +
            "               <label>Discount (%)</label>" +
            "               <input class=\"double_id discount_group"+count+"\" type=\"text\" name=\"addD"+count+"\" autocomplete=\"off\" maxlength=\"6\" required=\"required\">" +
            "               <label>Discounted Price</label>" +
            "               <input class=\"double_id discounted_group"+count+"\" type=\"text\" disabled=\"disabled\" maxlength=\"6\" required=\"required\">" +
            "               <input class=\"discounted_group"+count+"\" type=\"hidden\" name=\"addDP"+count+"\">" +
            "           </fieldset>" +
            "           <article class=\"module width_full\">" + 
            "               <header>" +
            "                   <h3 class=\"tabs_involved\">" +
            "                       <div id=\"option_switcher\">" +
            "                           <select id=\"option_switcher"+count+"\" class=\"tabs\" name=\"Oswitcher"+count+"\">" +
            "                               <option value=\"1\">No options</option>" +
            "                               <option value=\"0\">With options</option>" +
            "                           </select>" +
            "                       </div>" +
            "               </header>" +
            "               <div style=\"margin: 20px;\">" + 
            "                   <div id=\"deal_selections_group"+count+"\">" +
            "                       <fieldset class=\"none_option"+count+"\">" +
            "                           <label>Stock</label>" +
            "                           <input id=\"optionz"+count+"\" class=\"double_id\" type=\"text\" name=\"addStock"+count+"\" value=\"\" required=\"required\">" +
            "                       </fieldset>" +
            "                       <fieldset class=\"with_option"+count+"\">" +
            "                           <label>Selection 1</label>" +
            "                           <input id=\"selectionz\" type=\"text\" name=\"addDselect_group"+count+"_1\">" +
            "                           <label id=\"options\">Options</label>" +
            "                           <div id=\"deal_options_group"+count+"_1\">" +
            "                               <input id=\"options\" class=\"options_group"+count+"_1_1 O"+count+"_1\" type=\"text\" name=\"addDoption_group"+count+"_1_1\" maxlength=\"20\" required=\"required\">" +
            "                               <label class=\"option_count Op"+count+"_1\">1</label>" +
            "                           </div>" +
            "                           <label id=\"options\">Stock</label>" +
            "                           <div id=\"deal_stock_group"+count+"_1\">" +
            "                               <input id=\"options\" class=\"options_group"+count+"_1_1 O"+count+"_1\" type=\"text\" name=\"addStock_group"+count+"_1_1\" maxlength=\"10\" required=\"required\">" +
            "                               <label class=\"option_count Op"+count+"_1\">1</label>" +
            "                           </div>" +
            "                           <label id=\"options\">" +
            "                               <a href=\"add_more_option_group"+count+"_1\" id=\"add_more_option_group"+count+"_1\">Add More Option(s) and Stock(s)</a>" +
            "                               <span id=\"icn_remove\" class=\"option_remove O"+count+" off\" count_o1=\"1\" title=\"Remove Last Line\"></span>" +
            "                           </label>" +
            "                           <input type=\"hidden\" name=\"nOPTION_group"+count+"_1\" id=\"nOPTION_group"+count+"_1\" value=\"1\">" + 
            "                       </fieldset>" +
            "                   </div>" +
            "                       <input type=\"hidden\" name=\"nSELECTION_group"+count+"\" id=\"nSELECTION_group"+count+"\" value=\"1\">" +
            "           </div>" +
            "           </article>" +
            "           <br>" +
            "           <fieldset>" +
            "               <label>Highlights</label>" +
            "               <div id=\"deal_highlights_group"+count+"\">" +
            "                   <input id=\"highlights\" class=\"double_id H"+count+"_1\" type=\"text\" name=\"addH_group"+count+"_1\" maxlength=\"255\" required=\"required\">" +
            "               </div>" +
            "               <label><a href=\"add_more_highlights_group"+count+"\" id=\"add_more_highlights_group"+count+"\">Add More Highlight(s)</a></label>" +
            "               <span id=\"icn_remove\" class=\"input_remove H"+count+" off\" count_h"+count+"=\"1\" title=\"Remove Last Line\"></span>" +
            "               <input type=\"hidden\" name=\"nH_group"+count+"\" id=\"nH_group"+count+"\" value=\"1\">" +
            "           </fieldset>" +
            "           <fieldset>" +
            "               <label>Terms</label>" +
            "               <div id=\"deal_terms_group"+count+"\">" +
            "                   <input id=\"terms\" class=\"double_id T"+count+"_1\" type=\"text\" name=\"addT_group"+count+"_1\" maxlength=\"255\" required=\"required\">" +
            "               </div>" +
            "               <label><a href=\"add_more_terms_group"+count+"\" id=\"add_more_terms_group"+count+"\">Add More Term(s)</a></label>" +
            "               <span id=\"icn_remove\" class=\"input_remove T"+count+" off\" count_t"+count+"=\"1\" title=\"Remove Last Line\"></span>" +
            "               <input type=\"hidden\" name=\"nT_group"+count+"\" id=\"nT_group"+count+"\" value=\"1\">" +
            "           </fieldset>" +
            "           <fieldset>" +
            "               <label>Content</label>" +
            "               <textarea id=\"content\" class=\"double_id\" name=\"addContent_group"+count+"\"></textarea> " +
            "           </fieldset>" +
            "           <div id=\"deals_cover\">" +
            "               <fieldset>" +
            "                   <label>Deal Cover</label>" +
            "                   <input class=\"double_id\" type=\"file\" name=\"addMC"+count+"\">" +
            "                   <h4 class=\"alert_info\">Required Image: (690 x 242) to (750 x 263) pixels JPG/JPEG</h4>" +
            "               </fieldset>" +
            "           </div>" +
            "           <fieldset>" +
            "               <label>Embeded Code ( <a href=\"http://www.youtube.com/\" target=\"_new\" title=\"Get YOU TUBE embeded code\">You Tube</a> )</label>" +
            "               <textarea id=\"locations\" class=\"link\" name=\"addDV_group"+count+"\"></textarea>" +
            "           </fieldset>" +  
            "       </div>" +
            "   </article>" +
            "</div>"
            );
            $(".with_option"+count).hide();
            $("#nDEAL").attr("value",count);
            $(".D").attr("count_d",count);
            terms_group();
            highlights_group();
            $("#option_switcher"+count).change(function() {
                if($("#option_switcher"+count).val() == "1") { 
                    $(".none_option"+count).show(); $('input#optionz'+count).attr('required','required'); 
                    $(".with_option"+count).hide(); $('input#selectionz').removeAttr('required'); $('input#options').removeAttr('required');
                }
                else { 
                    $(".none_option"+count).hide(); $('input#optionz'+count).removeAttr('required');
                    $(".with_option"+count).show(); $('input#selectionz').attr('required','required'); $('input#options').attr('required','required');
                }
            });
            options_group();
            selection_group();
            original_group();
            discount_group();
            remove_option_group();
            remove_highlight_group();
            remove_terms_group();
            block_d_group();
            return false;
        });
    }
}
//----------------------------
function delete_more_deal() {
    document_ready();
    function document_ready() { $(document).ready(function() { click_event() }); }
    function click_event() {
        $('.D').click(function(a) {
            var countx=Number($("#nDEAL").attr("value"))-1;
            $count = $(a.target).attr("count_d");
            $value = $("#nDEAL").val();
            if($("#nDEAL").val()==1) {
                none_d_group();
            }
            else {
                $(".deal_"+$value).remove(); 
                $("#nDEAL").attr("value",countx);
                $(".D").attr("count_d",countx);
            } 
        });
    }                   
}
//----------------------------
function remove_O_single() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_option_single() 
    }); }                                                    
}
//----------------------------
function remove_H_single() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_highlight_single() 
    }); }                                                    
}
//----------------------------
function remove_T_single() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_term_single() 
    }); }                                                    
}
//----------------------------
function remove_A_solo() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { 
        remove_location_solo() 
    }); }                                                    
}
//----------------------------solo
function discount_solo() {
    $('.discount_solo').keyup(function() {
        var w=100;
        var x=$('.original_solo').val();
        var y=($('.discount_solo').val()/w)*x;
        var z=x-y;
        $('.discounted_solo').val(z);
    });
}
//---------------------------- 
function original_solo() {
    $('.original_solo').keyup(function() {
        var w=100;
        var x=$('.original_solo').val();
        var y=($('.discount_solo').val()/w)*x;
        var z=x-y;
        $('.discounted_solo').val(z);
    });
}                                                         
//----------------------------
function selection_solo() {
    $("#add_more_selection_solo").click(function() {   
            var count1=Number($("#nSELECTION_solo").attr("value"))+1;
            $deal_selections = $('#deal_selections_solo').append(
            "<fieldset>" +
            "   <label>Selection "+count1+"</label>" +
            "   <input type=\"text\" name=\"editDselect_solo"+count1+"\">" +
            "   <input type=\"hidden\" name=\"editDselectNo"+count1+"\">" +
            "   <input type=\"hidden\" name=\"editDselect_hashA"+count1+"\">" +
            "   <input type=\"hidden\" name=\"editDselect_hashB"+count1+"\">" +
            "   <label>Selection Options</label>" +
            "   <div id=\"deal_options_solo"+count1+"\">" +
            "       <input id=\"options\" class=\"options_solo"+count1+"_1\" type=\"text\" name=\"editDoption_solo"+count1+"_1\" value=\"\" required=\"required\">" +
            "       <input type=\"hidden\" name=\"editDoptionNo"+count1+"_1\">" +
            "       <input type=\"hidden\" name=\"editDoption_hash"+count1+"_1\">" +
            "   </div>" +
            "   <label id=\"options\">Stock</label>" +
            "   <div id=\"deal_Ostock_solo"+count1+"\">" +
            "       <input id=\"options\" class=\"options_solo"+count1+"_1\" type=\"text\" name=\"editOStock_solo"+count1+"_1\" value=\"\" required=\"required\">" + 
            "   </div>" +
            "   <label id=\"options\"><a href=\"add_more_option_solo"+count1+"\" id=\"add_more_option_solo"+count1+"\">Add More Option(s) and Stock(s)</a></label>" +
            "   <input type=\"hidden\" name=\"mOPTION_solo"+count1+"\" id=\"mOPTION_solo"+count1+"\" value=\"0\">" +
            "   <input type=\"hidden\" name=\"nOPTION_solo"+count1+"\" id=\"nOPTION_solo"+count1+"\" value=\"1\">" + 
            "</fieldset>"
            );
            $("#nSELECTION_solo").attr("value",count1);
            options_solo();
            return false;
        });
}
//----------------------------
function options_solo() {
    var count1=Number($("#nSELECTION_solo").attr("value")); 
    $("#add_more_option_solo"+count1).click(function() {
        var count2=Number($("#nOPTION_solo"+count1).attr("value"))+1;
        $deal_options = $('#deal_options_solo'+count1).append(
        "<input id=\"options\" class=\"options_solo"+count1+"_"+count2+"\" type=\"text\" name=\"editDoption_solo"+count1+"_"+count2+"\" value=\"\" required=\"required\">" +
        "<input type=\"hidden\" name=\"editDoptionNo"+count1+"_"+count2+"\">" +
        "<input type=\"hidden\" name=\"editDoption_hash"+count1+"_"+count2+"\">"
        );
        $deal_options = $('#deal_Ostock_solo'+count1).append(
        "<input id=\"options\" class=\"options_solo"+count1+"_"+count2+"\" type=\"text\" name=\"editOStock_solo"+count1+"_"+count2+"\" value=\"\" required=\"required\">"
        );
        $deal_options = $('#deal_Cstock_solo'+count1).append(
        "<input id=\"options\" class=\"options_solo"+count1+"_"+count2+"\" type=\"text\" name=\"editCStock_solo"+count1+"_"+count2+"\" value=\"\" disabled=\"disabled\" required=\"required\">"
        );
        $("#nSELECTION_solo").attr("value",count1); 
        $("#nOPTION_solo"+count1).attr("value",count2);
        return false;
    });
}
//----------------------------
function highlights_solo() {
    $("#add_more_highlights_solo").click(function() {
        var count3=Number($("#nH_solo").attr("value"))+1;
        $deal_highlights = $('#deal_highlights_solo').append(
        "<input id=\"highlights\" class=\"solo_id H"+count3+"\" type=\"text\" name=\"editH_solo"+count3+"\" maxlength=\"255\" required=\"required\">" +
        "<input class=\"solo_id H"+count3+"\" type=\"hidden\" name=\"editHNo"+count3+"\">" +
        "<input class=\"solo_id H"+count3+"\" type=\"hidden\" name=\"editH_hash"+count3+"\">"
        );
        $("#nH_solo").attr("value",count3);
        $(".H").attr("count_h",count3);
        block_h_single();
        return false;
    });
}
//----------------------------
function terms_solo() {
    $("#add_more_terms_solo").click(function() {
        var count4=Number($("#nT_solo").attr("value"))+1;
        $deal_highlights = $('#deal_terms_solo').append(
        "<input id=\"terms\" class=\"solo_id T"+count4+"\" type=\"text\" name=\"editT_solo"+count4+"\"  maxlength=\"255\" required=\"required\">"+
        "<input class=\"solo_id T"+count4+"\" type=\"hidden\" name=\"editTNo<?php echo $term_count; ?>\" value=\"<?php echo $t_encrypt_count; ?>\">"+
        "<input class=\"solo_id T"+count4+"\" type=\"hidden\" name=\"editT_hash"+count4+"\" value=\""+count4+"\">"
        );
        $("#nT_solo").attr("value",count4);
        $(".T").attr("count_t",count4);
        block_t_single();
        return false;
    });
}
//----------------------------
function location_solo() {
    $("#add_more_location").click(function() {
        var countx=Number($("#nLOCATION").attr("value"))+1;
        $deal_locations = $('#deal_locations').append(
        "<fieldset class=\"A"+countx+"\">" +
        "   <label>Address "+countx+"</label>" +
        "   <input id=\"locations\" type=\"text\" name=\"editLocation"+countx+"\"  required=\"required\">" +
        "   <label>Map Link <font color=\"green\"> ( <a href=\"http://maps.google.com.ph/\" target=\"_new\" id=\"view_map\" title=\"Get the Map Link on the Google Map\"> Open Google Map </a> )</font></label>" +
        "   <textarea id=\"locations\"  class=\"link\" name=\"editLink"+countx+"\" required=\"required\"></textarea>" +
        "   <input type=\"hidden\" name=\"editLinkNo"+countx+"\">" + 
        "   <input type=\"hidden\" name=\"editHash"+countx+"\">" +
        "</fieldset>"
        );
        $("#nLOCATION").attr("value",countx);
        $(".A").attr("count_a",countx);
        block_a();
        return false;
    });
}
//----------------------------
function remove_location_solo() { 
    $('.A').click(function(a) {
        var countx=Number($("#nLOCATION").attr("value"))-1;
        $count = $(a.target).attr("count_a");
        $value = $("#nLOCATION").val();
        if($("#mLOCATION").val()==$("#nLOCATION").val()) {
            none_a();
        }
        else {
            $("fieldset.A"+$value).remove(); 
            $("#nLOCATION").attr("value",countx);
            $(".A").attr("count_a",countx);
        } 
    });                    
}
//----------------------------   
function remove_highlight_solo() { 
    $('.H').click(function(a) {     
        var count3=Number($("#nH_solo").attr("value"))-1;
        $count = $(a.target).attr("count_h");
        $solo_value = $("#nH_solo").val();
        if($("#nH_solo").val()==$("#mH_solo").val()) {
            none_h_single();
        }
        else {
            $(".H"+$solo_value).remove(); 
            $("#nH_solo").attr("value",count3);
            $(".H").attr("count_h",count3);
        } 
    });                    
}
//----------------------------   
function remove_terms_solo() { 
    $('.T').click(function(a) {     
        var count4=Number($("#nT_solo").attr("value"))-1;
        $count = $(a.target).attr("count_t");
        $solo_value = $("#nT_solo").val();
        if($("#nT_solo").val()==$("#mT_solo").val()) {
            none_t_single();
        }
        else {
            $(".T"+$solo_value).remove(); 
            $("#nT_solo").attr("value",count4);
            $(".T").attr("count_t",count4);
        } 
    });                    
}
function photo_single() {
    $("#add_more_photo_single").click(function() {
        var count_photo=Number($("#nPHOTO").attr("value"))+1;
        $deal_photo = $('#gallery_casing').append("<label>Photo "+count_photo+"</label><fieldset><input id=\"image_upload\" type=\"file\" name=\"addSDC"+count_photo+"\" value=\"\"></fieldset>");
        $("#nPHOTO").attr("value",count_photo);
        return false;
    });
}
//----------------------------single
function discount_single() {
    $('.discount_single').keyup(function() {
        var w=100;
        var x=$('.original_single').val();
        var y=($('.discount_single').val()/w)*x;
        var z=x-y;
        $('.discounted_single').val(z);
    });
}
//---------------------------- 
function original_single() {
    $('.original_single').keyup(function() {
        var w=100;
        var x=$('.original_single').val();
        var y=($('.discount_single').val()/w)*x;
        var z=x-y;
        $('.discounted_single').val(z);
    });
}                                                         
//----------------------------
function selection_single() {
    $("#add_more_selection_single").click(function() {   
        var count1=Number($("#nSELECTION_single").attr("value"))+1;
        $deal_selections = $('#deal_selections_single').append(
        "<fieldset>" +
        "   <label>Selection "+count1+"</label>" +
        "   <input type=\"text\" name=\"addDselect_single"+count1+"\">" +
        "   <label id=\"options\">Options</label>" +
        "   <div id=\"deal_options_single"+count1+"\">" +
        "       <input id=\"options\" class=\"options_single"+count1+"_1\" type=\"text\" name=\"addDoption_single"+count1+"_1\">" +
        "   </div>" +
        "   <label id=\"options\">Stock</label>" +
        "   <div id=\"deal_stock_single"+count1+"\">" +
        "       <input id=\"options\" class=\"options_stock"+count1+"_1\" type=\"text\" name=\"addStock_single"+count1+"_1\">" +
        "   </div>" +
        "   <label id=\"options\"><a href=\"add_more_option_single"+count1+"\" id=\"add_more_option_single"+count1+"\">Add More Option(s) and Stock(s)</a></label>" +
        "   <input type=\"hidden\" name=\"nOPTION_single"+count1+"\" id=\"nOPTION_single"+count1+"\" value=\"1\">" + 
        "</fieldset>"
        );
        $("#nSELECTION_single").attr("value",count1);
        options_single();
        return false;
    });
}
//----------------------------
function options_single() {
    var count1=Number($("#nSELECTION_single").attr("value")); 
    $("#add_more_option_single"+count1).click(function() {
        var count2=Number($("#nOPTION_single"+count1).attr("value"))+1;
        $deal_options = $('#deal_options_single'+count1).append(
        "<input id=\"options\" class=\"options_single"+count1+"_"+count2+" O"+count2+"\" type=\"text\" name=\"addDoption_single"+count1+"_"+count2+"\" maxlength=\"20\" required=\"required\">"+
        "<label class=\"option_count Op"+count2+"\">"+count2+"</label>"
        );
        $deal_options = $('#deal_stock_single'+count1).append(
        "<input id=\"options\" class=\"options_stock"+count1+"_"+count2+" O"+count2+"\" type=\"text\" name=\"addStock_single"+count1+"_"+count2+"\"maxlength=\"10\" required=\"required\">"+
        "<label class=\"option_count Op"+count2+"\">"+count2+"</label>"
        );
        $("#nSELECTION_single").attr("value",count1); 
        $("#nOPTION_single"+count1).attr("value",count2);
        $(".O").attr("count_o",count2);
        block_o_single();                                        
        return false;
    });
}
//-----------------------------------
function stock_option_single() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { onclick_event() }); }
    function onclick_event() {
        $("#option_switcher").change(function() { stock_option_single_condition(); }                    
    )};
}
function stock_option_single_condition() {
    if($('#option_switcher').val() == "1") {
        $('.none_option').show(); $('input#optionz').attr('required','required'); 
        $('.with_option').hide(); $('input#selectionz').removeAttr('required'); 
        $('input#options').removeAttr('required'); 
        $("input#options").attr("value","");
    }
    else {
        $('.none_option').hide(); $('input#optionz').removeAttr('required'); 
        $('.with_option').show(); $('input#selectionz').attr('required','required'); 
        $('input#options').attr('required','required'); 
        $("input#optionz").attr("value","");
        $("input#selectionz").attr("value","");
    }
}
//----------------------------
function highlights_single() { 
    $("#add_more_highlights_single").click(function() {
        var count3=Number($("#nH_single").attr("value"))+1;
        $deal_highlights = $('#deal_highlights_single').append("<input id=\"highlights\" class=\"single_id H"+count3+"\" type=\"text\" name=\"addH_single"+count3+"\" maxlength=\"255\" required=\"required\">");
        $("#nH_single").attr("value",count3);
        $(".H").attr("count_h",count3);
        block_h_single();
        return false;
    })
}
//----------------------------
function terms_single() {
    $("#add_more_terms_single").click(function() {
        var count4=Number($("#nT_single").attr("value"))+1;
        $deal_terms = $('#deal_terms_single').append("<input id=\"terms\" class=\"single_id T"+count4+"\" type=\"text\" name=\"addT_single"+count4+"\" maxlength=\"255\" required=\"required\">");
        $("#nT_single").attr("value",count4);
        $(".T").attr("count_t",count4);
        block_t_single();
        return false;
    })
}
//---------------------------- 
 function remove_option_single() {
    $('.O').click(function(a) {
        var count1=Number($("#nSELECTION_single").attr("value"));
        var count2=Number($("#nOPTION_single"+count1).attr("value"))-1; 
        $count = $(a.target).attr("count_o");
        $single_value = $("#nOPTION_single"+count1).val();
        if($("#nOPTION_single"+count1).val()==1) {
            none_o_single();
        }
        else {
            $(".O"+$single_value).remove(); 
            $(".Op"+$single_value).remove(); 
            $("#nOPTION_single"+count1).attr("value",count2);
            $(".O").attr("count_o",count2);
        } 
    }); 
 } 
//----------------------------   
function remove_highlight_single() { 
    $('.H').click(function(a) {     
        var count3=Number($("#nH_single").attr("value"))-1;
        $count = $(a.target).attr("count_h");
        $single_value = $("#nH_single").val();
        if($("#nH_single").val()==1) {
            none_h_single();
        }
        else {
            $(".H"+$single_value).remove(); 
            $("#nH_single").attr("value",count3);
            $(".H").attr("count_h",count3);
        } 
    });                    
}
//----------------------------
function remove_term_single() { 
    $('.T').click(function(a) {
        var count4=Number($("#nT_single").attr("value"))-1;
        $count = $(a.target).attr("count_t");
        $single_value = $("#nT_single").val();
        if($("#nT_single").val()==1) {
            none_t_single();
        }
        else {
            $(".T"+$single_value).remove(); 
            $("#nT_single").attr("value",count4);
            $(".T").attr("count_t",count4);
        } 
    });                    
}
//----------------------------group 
function discount_group() {
    var count=Number($("#nDEAL").attr("value"));
    $('.discount_group'+count).keyup(function() {
        var w=100;
        var x=$('.original_group'+count).val();
        var y=($('.discount_group'+count).val()/w)*x;
        var z=x-y;
        $('.discounted_group'+count).val(z);
    });
    $("#nDEAL").attr("value",count);
}
//----------------------------                          
function original_group() {
    var count=Number($("#nDEAL").attr("value"));
    $('.original_group'+count).keyup(function() {
        var w=100;
        var x=$('.original_group'+count).val();
        var y=($('.discount_group'+count).val()/w)*x;
        var z=x-y;
        $('.discounted_group'+count).val(z);
    });
    $("#nDEAL").attr("value",count);
}
//----------------------------
function selection_group() {
    var count=Number($("#nDEAL").attr("value"));
    $("#add_more_selection_group"+count).click(function() {   
            var count1=Number($("#nSELECTION_group"+count).attr("value"))+1;
            $deal_selections = $('#deal_selections_group'+count).append(
            "<fieldset class=\"with_option"+count+"\">" +
            "   <label>Selection "+count1+"</label>" +
            "   <input type=\"text\" name=\"addDselect_group"+count+"_"+count1+"\">" +
            "   <label id=\"options\">Options</label>" +
            "   <div id=\"deal_options_group"+count+"_"+count1+"\">" +
            "       <input id=\"options\" class=\"options_group"+count+"_"+count1+"_1\" type=\"text\" name=\"addDoption_group"+count+"_"+count1+"_1\">" +
            "   </div>" +
            "   <label id=\"options\">Stock</label>" +
            "   <div id=\"deal_stock_group"+count+"_"+count1+"\">" +
            "       <input id=\"options\" class=\"options_group"+count+"_"+count1+"_1\" type=\"text\" name=\"addStock_group"+count+"_"+count1+"_1\">" +
            "   </div>" +
            "   <label id=\"options\"><a href=\"add_more_option_group"+count+"_"+count1+"\" id=\"add_more_option_group"+count+"_"+count1+"\">Add More Option(s) and Stock(s)</a></label>" +
            "   <input type=\"hidden\" name=\"nOPTION_group"+count+"_"+count1+"\" id=\"nOPTION_group"+count+"_"+count1+"\" value=\"1\">" + 
            "</fieldset>"
            );
            $("#nDEAL").attr("value",count);
            $("#nSELECTION_group"+count).attr("value",count1);
            options_group();
            return false;
        });
}
//----------------------------
function options_group() {
    var count=Number($("#nDEAL").attr("value"));
    var count1=Number($("#nSELECTION_group"+count).attr("value")); 
    $("#add_more_option_group"+count+"_"+count1).click(function() {
        var count2=Number($("#nOPTION_group"+count+"_"+count1).attr("value"))+1;
        $deal_options = $('#deal_options_group'+count+"_"+count1).append(
        "<input id=\"options\" class=\"options_group"+count+"_"+count1+"_"+count2+" O"+count+"_"+count2+"\" type=\"text\" name=\"addDoption_group"+count+"_"+count1+"_"+count2+"\" maxlength=\"20\" required=\"required\">"+
        "<label class=\"option_count Op"+count+"_"+count2+"\">"+count2+"</label>"
        );
        $deal_options = $('#deal_stock_group'+count+"_"+count1).append(
        "<input id=\"options\" class=\"options_group"+count+"_"+count1+"_"+count2+" O"+count+"_"+count2+"\" type=\"text\" name=\"addStock_group"+count+"_"+count1+"_"+count2+"\" maxlength=\"10\" required=\"required\">"+
        "<label class=\"option_count Op"+count+"_"+count2+"\">"+count2+"</label>"
        );
        $("#nDEAL").attr("value",count);
        $("#nSELECTION_group"+count).attr("value",count1); 
        $("#nOPTION_group"+count+"_"+count1).attr("value",count2);
        $(".O"+count).attr("count_o"+count,count2);
        block_o_group();
        return false;
    });
}
//----------------------------------
function stock_option_group() {
    document_ready(); 
    function document_ready() { $(document).ready(function() { onclick_event() }); }
    function onclick_event() {
        var count=Number($("#nDEAL").attr("value")); 
        $("#option_switcher"+count).change(function() {
            if($("#option_switcher"+count).val() == "1") { 
                $(".none_option"+count).show(); $('input#optionz'+count).attr('required','required'); 
                $(".with_option"+count).hide(); $('input#selectionz').removeAttr('required'); $('input#options').removeAttr('required'); 
            }
            else { 
                $(".none_option"+count).hide(); $('input#optionz'+count).removeAttr('required'); 
                $(".with_option"+count).show(); $('input#selectionz').attr('required','required'); $('input#options').attr('required','required');
            }  
        });                    
    }
}
//----------------------------
function highlights_group() {
    var count=Number($("#nDEAL").attr("value"));
    $("#add_more_highlights_group"+count).click(function() {
        var count3=Number($("#nH_group"+count).attr("value"))+1;
        $deal_highlights = $('#deal_highlights_group'+count).append("<input id=\"highlights\" class=\"H"+count+"_"+count3+"\" type=\"text\" name=\"addH_group"+count+"_"+count3+"\" maxlength=\"255\" required=\"required\">");
        $("#nH_group"+count).attr("value",count3);
        $(".H"+count).attr("count_h"+count,count3);
        block_h_group();
        return false;
    })
}
//----------------------------
function terms_group() {
    var count=Number($("#nDEAL").attr("value"));
    $("#add_more_terms_group"+count).click(function() {
        var count4=Number($("#nT_group"+count).attr("value"))+1;
        $deal_terms = $('#deal_terms_group'+count).append("<input id=\"terms\" class=\"T"+count+"_"+count4+"\" type=\"text\" name=\"addT_group"+count+"_"+count4+"\" maxlength=\"255\" required=\"required\">");
        $("#nT_group"+count).attr("value",count4);
        $(".T"+count).attr("count_t"+count,count4);
        block_t_group();
        return false;
    })
}
//---------------------------- 
 function remove_option_group() {
    var count=Number($("#nDEAL").attr("value"));
    $('.O'+count).click(function(a) {
        var count1=Number($("#nSELECTION_group"+count).attr("value"));
        var count2=Number($("#nOPTION_group"+count+"_"+count1).attr("value"))-1; 
        $count = $(a.target).attr("count_o"+count);
        $group_value = $("#nOPTION_group"+count+"_"+count1).val();
        if($("#nOPTION_group"+count+"_"+count1).val()==1) {
            none_o_group();
        }
        else {                     
            $(".O"+count+"_"+$group_value).remove(); 
            $(".Op"+count+"_"+$group_value).remove(); 
            $("#nOPTION_group"+count+"_"+count1).attr("value",count2);
            $(".O"+count).attr("count_o"+count,count2);
        } 
    }); 
 } 
//----------------------------
function remove_highlight_group() {
    var countx=Number($("#nDEAL").attr("value")); 
    $('.H'+countx).click(function(a) {     
        var count3=Number($("#nH_group"+countx).attr("value"))-1;
        $count = $(a.target).attr("count_h"+countx);
        $group_value = $("#nH_group"+countx).val();
        if($("#nH_group"+countx).val()==1) {
            none_h_group();
        }
        else {
            $(".H"+countx+"_"+$group_value).remove(); 
            $("#nH_group"+countx).attr("value",count3);
            $(".H"+countx).attr("count_h"+countx,count3);
        } 
    });                    
}
//----------------------------
function remove_terms_group() {
    var countx=Number($("#nDEAL").attr("value")); 
    $('.T'+countx).click(function(a) {     
        var count4=Number($("#nT_group"+countx).attr("value"))-1;
        $count = $(a.target).attr("count_t"+countx);
        $group_value = $("#nT_group"+countx).val();
        if($("#nT_group"+countx).val()==1) {
            none_t_group();
        }
        else {
            $(".T"+countx+"_"+$group_value).remove(); 
            $("#nT_group"+countx).attr("value",count4);
            $(".T"+countx).attr("count_t"+countx,count4);
        } 
    });                    
}
//----------------------------
function location_all() {
    $("#add_more_location").click(function() {
        var countx=Number($("#nLOCATION").attr("value"))+1;
        $deal_locations = $('#deal_locations').append(
        "<fieldset class=\"A"+countx+"\">" +
        "<center><h3>Branch "+countx+"</h3></center>" +
        "<label>Branch Name</label>" +
        "<input id=\"locations\" type=\"text\" name=\"addName"+countx+"\" required=\"required\" >" +
        "<label>E-mail</label>" +
        "<input id=\"locations\" type=\"text\" name=\"addEmail"+countx+"\" maxlength=\"20\">" +
        "<label>Cel No.</label>" +
        "<input id=\"locations\" type=\"text\" name=\"addCel"+countx+"\" maxlength=\"20\">" +
        "<label>Tel No.</label>" +
        "<input id=\"locations\" type=\"text\" name=\"addTel"+countx+"\" maxlength=\"20\">" +
        "<label>Fax</label>" +
        "<input id=\"locations\" type=\"text\" name=\"addFax"+countx+"\" maxlength=\"20\">" +
        "<label>Address</label>" +
        "<input id=\"locations\" type=\"text\" name=\"addLocation"+countx+"\" required=\"required\" >" +
        "<label>Map Link <font color=\"green\"> ( <a href=\"http://maps.google.com.ph/\" target=\"_new\" id=\"view_map\" title=\"Get the Map Link on the Google Map\"> Open Google Map </a> )</font></label>" +
        "<textarea id=\"locations\" class=\"link\" name=\"addLink"+countx+"\" required=\"required\"></textarea>" +
        "</fieldset>"
        );
        $("#nLOCATION").attr("value",countx);
        $(".A").attr("count_a",countx);
        block_a();
        return false;
    });
}
//----------------------------
function remove_location_all() { 
    $('.A').click(function(a) {
        var countx=Number($("#nLOCATION").attr("value"))-1;
        $count = $(a.target).attr("count_a");
        $value = $("#nLOCATION").val();
        if($("#nLOCATION").val()==1) {
            none_a();
        }
        else {
            $("fieldset.A"+$value).remove(); 
            $("#nLOCATION").attr("value",countx);
            $(".A").attr("count_a",countx);
        } 
    });                    
}
//---------------------------- single
function block_o_single() { $(".O").removeClass("off"); $(".O").addClass("on"); }
function none_o_single() { $(".O").removeClass("on"); $(".O").addClass("off"); }
//---------------------------- 
function block_h_single() { $(".H").removeClass("off"); $(".H").addClass("on"); }
function none_h_single() { $(".H").removeClass("on"); $(".H").addClass("off"); }
//----------------------------
function block_t_single() { $(".T").removeClass("off"); $(".T").addClass("on"); }
function none_t_single() { $(".T").removeClass("on"); $(".T").addClass("off"); }
//----------------------------
function block_a() { $(".A").removeClass("off"); $(".A").addClass("on"); }
function none_a() { $(".A").removeClass("on"); $(".A").addClass("off"); }
//---------------------------- group
function block_d_group() { $(".D").removeClass("off"); $(".D").addClass("on"); }
function none_d_group() { $(".D").removeClass("on"); $(".D").addClass("off"); }
//----------------------------
function block_o_group() {
    var count=Number($("#nDEAL").attr("value"));
    $(".O"+count).removeClass("off"); 
    $(".O"+count).addClass("on"); 
}
function none_o_group() { 
    var count=Number($("#nDEAL").attr("value"));
    $(".O"+count).removeClass("on"); 
    $(".O"+count).addClass("off"); 
} 
//----------------------------- 
function block_h_group() {
    var count=Number($("#nDEAL").attr("value"));
    $(".H"+count).removeClass("off"); 
    $(".H"+count).addClass("on"); 
}
function none_h_group() { 
    var count=Number($("#nDEAL").attr("value"));
    $(".H"+count).removeClass("on"); 
    $(".H"+count).addClass("off"); 
}
//-----------------------------
function block_t_group() {
    var count=Number($("#nDEAL").attr("value"));
    $(".T"+count).removeClass("off"); 
    $(".T"+count).addClass("on"); 
}
function none_t_group() { 
    var count=Number($("#nDEAL").attr("value"));
    $(".T"+count).removeClass("on"); 
    $(".T"+count).addClass("off"); 
}
