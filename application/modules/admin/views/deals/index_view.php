<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<style>
    .hide {
        display: none;
    }
    
    .preview_wrap {width: 750px;height: 263px;border: 1px solid black;overflow: hidden;}
</style>
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>

<link rel="stylesheet" type="text/css" href="assets/general/set/datepicker/themes/base/jquery.ui.all.css"/>

<!--time picker plugin-->
<script type="text/javascript" src="assets/general/set/jquery_ui_full/jquery-ui.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/timepicker/timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="assets/general/set/datepicker/timepicker/timepicker_css.css"/>

<script type="text/javascript">
    $(function(){
        //hook timedatepicker
        $("#date1").datetimepicker({
            minDate          : new Date(),//default minimum date is now as in now!
			showAnim         : "fadeIn", //effect
			numberOfMonths   : 2,//number of months to be displayed for selection of date
			onClose          : setMin //call setMin fn
        });
        
        //hook timedatepicker
        $("#date2").datetimepicker({
            minDate          : new Date(),//default minimum date is now as in now!
            numberOfMonths   : 2,//number of months to be displayed for selection of date
			showAnim         : "fadeIn", //effect
			onClose          : setMax //call setMax fn
        });
        
        
        function setMin()//set minimum date for end date
		{
			x = new Date($("#date1").val());
			y = new Date($("#date1").val());
			d = new Date(x.setDate(y.getDate()+1));
			$( "#date2" ).datetimepicker("option", "minDate", d);
		}
        
        
		function setMax()//set maximun date for star date
		{
			x = new Date($("#date2").val());
			y = new Date($("#date2").val());
			d = new Date(x.setDate(y.getDate()-1));
			$( "#date1" ).datetimepicker("option", "maxDate", d);
		}
    });
</script>
<script type="text/javascript"> 
    var discounted_single = new discounted_single();
    var discounted_group = new discounted_group(); 
    var add_more_deal = new add_more_deal();
    var delete_more_deal = new delete_more_deal();
    var add_more_selection_single = new add_more_selection_single();
    var add_more_option_single = new add_more_option_single();
    var add_more_highlights_single = new add_more_highlights_single();
    var add_more_terms_single = new add_more_terms_single();
    var stock_option_single = new stock_option_single();
    var remove_O_single = new remove_O_single();
    var remove_H_single = new remove_H_single();
    var remove_T_single = new remove_T_single();
    var add_more_selection_group = new add_more_selection_group();
    var add_more_option_group = new add_more_option_group();
    var add_more_highlights_group = new add_more_highlights_group();
    var add_more_terms_group = new add_more_terms_group();
    var stock_option_group = new stock_option_group();
    var remove_O_group = new remove_O_group();
    var remove_H_group = new remove_H_group();
    var remove_T_group = new remove_T_group(); 
</script>
<!--END OF JS-->

<div class = "list_member" style="display: <?php if(isset($_GET['error1']) == 1 || isset($_GET['error2']) == 1 || isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1 || isset($_GET['error5']) == 1):?>none<?php else : ?>block<?php endif ?>;">  
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Deals - <?php echo  ucwords($this->uri->segment(4)); ?></h3>
            <ul class="tabs">
                <li><a href="admin/admin_deals/index/current">Current Deals</a></li>
                <li><a href="admin/admin_deals/index/future">Future Deals</a></li>
                <li><a href="admin/admin_deals/index/past">Past Deals</a></li>
            </ul>
        </header>
        <header>
        <script>
            $(function(){
                $(".btn_search").click(function(){
                    if($(".search_item").val() == "")
                    {
                        return false;
                        
                    }else{
                        if($(".search_item").val() == "Deal Title"){
                            return false;
                        }else{
                            $(".form_search").submit();    
                        }  
                    }
                });
            });
        </script>
            <form class="search" action="<?php echo base_url(); ?>admin/admin_deals/index/<?php echo $this->uri->segment(4); ?>/search" method="post" enctype="multipart/form-data">
                <input type="text" name="search_here" value="Deal Title" onfocus="search_record(this.value='')" class="search_item">
                <input class="btn_search" type="submit" name="search" value="Search">
            </form>
        </header>
<!--Begin Table class datagrid-->  
        <table style="font-size: 11px" id="datagrid" class="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr align="left">
                    <th id = "table_spacing">Deal Company</th> 
                    <th title="Transaction Reference No." style="width: 12% !important;">TR No.</th>
                    <th>Deal Title</th>
                    <th>Deal Category</th>
                    <th>Deal Type</th>
<?php if($this->uri->segment(4) != "future") : ?>
                    <th align="right">Sold</th>
                    <th align="right">Returns</th>           
<?php endif ?>      
                    <th align="right">Stock</th>
                    <th align="center">Actions
                        <!--select all-->
                        <span class="select_all_wrap"><input type="checkbox" class="selectall" title="Select All"></span>
                        <script type="text/javascript">
                            $(function(){
                                $(".selectall").click(function(){
                                    if(this.checked == true){
                                        $(".list_member").find(".checkbox_selector").attr("checked", '');
                                    }else{
                                        $(".list_member").find(".checkbox_selector").removeAttr("checked");
                                    }
                                });
                            });
                        </script>
                        <!--end select all-->
                    </th>
                </tr>
            </thead>  
<!--additional start <form> tag for multi function-->
<form method="post" action="" id="form_multi" class="form_multi">
<!---->
            <tbody id = 'info_grid'>
<?php foreach($sql2 as $row2): ?>
<?php $table0 = "deal_category" ?>
<?php $where0['category_id'] = htmlentities($row2->category_id); ?>
<?php $sql0 = $this->db->get_where($table0,$where0); ?> 
<?php $table1 = "deals"; ?>
<?php $where1['deal_hash'] = htmlentities($row2->deal_hash); ?>
<?php $this->db->select_sum('deal_original_stock'); ?>
<?php $this->db->select_sum('deal_current_stock'); ?>
<?php $this->db->select_sum('deal_returned'); ?>
<?php $this->db->where($where1); ?> 
<?php $sql1 = $this->db->get_where($table1); ?>
<?php $table6 = "deal_option"; ?>
<?php $this->db->select_sum('deal_original_stock'); ?>
<?php $this->db->select_sum('deal_current_stock'); ?>
<?php $this->db->select_sum('deal_returned'); ?>
<?php $sql6 = $this->db->get_where($table6, $where1); ?>
<?php $table9a = "companies"; ?>
<?php $where9a['company_hash'] = htmlentities($row2->company_hash); ?>
<?php $sql9a = $this->db->get_where($table9a, $where9a); ?>
<?php $deal_title = shortenString(xss_cleaner($row2->deal_view_title), 25); ?>
                <tr align="left" title="<?php echo xss_cleaner($row2->deal_view_title); ?>">
<?php if($row2->company_hash == "") : ?>
                    <td id = "table_spacing">--</td>
<?php else : ?>                                               
<?php foreach($sql9a->result() as $row9a) : ?>
<?php $company_name = shortenString(xss_cleaner($row9a->company_name), 40); ?>
                    <td style="padding-left: 15px;"><?php echo $company_name[0]; ?></td> 
<?php endforeach ?>
<?php endif ?>        
                    <td><?php echo str_replace("10", "", printf("%010s", htmlentities($row2->deal_view_id))); ?></td>
                    <td><?php echo $deal_title[0]; ?></td>         
<?php foreach($sql0->result() as $row0): ?>
                    <td><?php echo htmlentities($row0->category_name); ?></td>
<?php endforeach ?>
                    <td><?php echo htmlentities($row2->deal_view_type); ?></td>


<?php if($this->uri->segment(4) != "future") : ?>
                    <td align="right">
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_view_type) == "Single Deal") : ?>
<?php if(htmlentities($row2->deal_option) == 1) : ?> 
<?php if(htmlentities($row2->deal_current_stock) == 0) : ?>
                        <?php echo number_format(htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock)); ?>
<?php else : ?>
<?php if(htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock) == 0) : ?>
                        NONE
<?php else : ?>
                        <?php echo number_format(htmlentities($row2->deal_original_stock) - htmlentities($row2->deal_current_stock)); ?>
<?php endif ?> 
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row6->deal_current_stock) == 0) : ?>
                        <?php echo number_format(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock)); ?>
<?php else : ?>
<?php if(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock) == 0) : ?>
                        NONE
<?php else : ?>
                        <?php echo number_format(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock)); ?>
<?php endif ?> 
<?php endif ?>
<?php endif ?>
<?php else : ?>
<?php foreach($sql1->result() as $row1) : ?>
<?php if($row2->deal_option == 0) : ?>
<?php if($row6->deal_current_stock == 0) : ?>
                        <?php echo number_format(htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock)); ?>
<?php else : ?>
<?php if(htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock) == 0) : ?>
                        NONE
<?php else : ?>
                        <?php echo number_format(htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock)); ?>
<?php endif ?>
<?php endif ?>
<?php else : //if the deal is group deal ?>
<?php if(htmlentities($row2->deal_current_stock) == 0) : ?>
                        <?php echo number_format((htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock))+(htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock))); ?>
<?php else : ?>
<?php if(htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock) == 0) : ?>
                        NONE
<?php else : ?>
                        <?php echo number_format((htmlentities($row6->deal_original_stock) - htmlentities($row6->deal_current_stock))+(htmlentities($row1->deal_original_stock) - htmlentities($row1->deal_current_stock))); ?>
<?php endif ?>
<?php endif ?>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
<?php endforeach ?>
                    </td>
<?php foreach($sql1->result() as $row1) : ?>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_option) == 1) : ?>
<?php if(htmlentities($row1->deal_returned) == 0) : ?>
                    <td align="right">NONE</td>
<?php else : ?>
                    <td align="right"><?php echo number_format(htmlentities($row1->deal_returned)+htmlentities($row6->deal_returned)); ?></td>
<?php endif ?>
<?php else : ?>
<?php if(htmlentities($row6->deal_returned) == 0) : ?>
                    <td align="right">NONE</td>
<?php else : ?>
                    <td align="right"><?php echo number_format(htmlentities($row1->deal_returned)+htmlentities($row6->deal_returned)); ?></td>
<?php endif ?>
<?php endif ?>                    
<?php endforeach ?>
<?php endforeach ?> 
<?php endif ?>
<?php if(htmlentities($row2->deal_view_type) == "Single Deal") : ?>
<?php foreach($sql1->result() as $row1) : ?>
<?php foreach($sql6->result() as $row6) : ?>
<?php if(htmlentities($row2->deal_option) == 1) : ?>
<?php if(htmlentities($row2->deal_current_stock) == 0) : ?>
                    <td align="right"><b><font color="green">SOLD!</font></b></td>
<?php else : ?>
                    <td align="right"><?php echo number_format(htmlentities($row2->deal_current_stock)+htmlentities($row6->deal_current_stock)); ?></td>
<?php endif ?>
<?php else : ?>
<?php if($row6->deal_current_stock == 0) : ?>
                    <td align="right"><b><font color="green">SOLD!</font></b></td>
<?php else : ?>
                    <td align="right"><?php echo number_format(htmlentities($row2->deal_current_stock)+htmlentities($row6->deal_current_stock)); ?></td>
<?php endif ?>
<?php endif ?>
<?php endforeach ?>
<?php endforeach ?>
<?php else : ?>
<?php foreach($sql1->result() as $row1) : ?>
<?php foreach($sql6->result() as $row6) : ?>
<?php if($row1->deal_current_stock == 0) : ?>
                    <td align="right"><b><font color="green">SOLD!</font></b></td>
<?php else : ?>
                    <td align="right"><?php echo number_format($row1->deal_current_stock+$row6->deal_current_stock); ?></td>
<?php endif ?>
<?php endforeach ?>
<?php endforeach ?>
<?php endif ?>
                    <td align="center">
<?php if($row2->deal_view_type=="Single Deal") : ?>
<?php if($this->uri->segment(4) == "past") : ?>
<?php if($row2->deal_renewed == 1) : ?>
                        <a href="<?php echo base_url() . "admin/admin_deals/profile_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Single Deal Profile"></a>
<?php else : ?>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>                          
                        <a href="<?php echo base_url() . "admin/admin_deals/renew_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_renew" src="assets/admin/images/icn_renew.png" title="Renew Single Deal"></a>
<?php else : ?>
                        <a href="<?php echo base_url() . "admin/admin_deals/profile_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Single Deal Profile"></a>
<?php endif ?>
<?php endif ?>
<?php else : ?>
                        <a href="<?php echo base_url() . "admin/admin_deals_gallery/edit_gallery_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_gallery" src="assets/admin/images/icn_photo.png" title="<?php if($this->session->userdata('user_level') == 3) : ?>Manage<?php else : ?>View<?php endif ?> Single Deal Gallery"></a>
<?php if($this->session->userdata('user_level') <> 3) : ?>
                        <a href="<?php echo base_url() . "admin/admin_deals/profile_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Single Deal Profile"></a>
<?php endif ?>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                        <a href="<?php echo base_url() . "admin/admin_deals/edit_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Single Deal Info"></a>
<?php endif ?>
<?php endif ?>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                        <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url() . "admin/admin_deals/delete_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Single Deal">
                        </a>
                        <!--multi selectors-->
                        &nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkbox[]" class="checkbox_selector" value="<?php echo htmlentities($row2->deal_hash)?>">
                        <!-- end-->

<?php endif ?>
<?php else : ?>
<?php if($this->uri->segment(4) == "past") : ?>
    <?php if(htmlentities($row2->deal_renewed) == 1) : ?>
                            <a href="<?php echo base_url() . "admin/admin_deals/profile_group_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Group Deal Profile"></a>
    <?php else : ?>
        <?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                                <a href="<?php echo base_url() . "admin/admin_deals/renew_group_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_renew" src="assets/admin/images/icn_renew.png" title="Renew Group Deal"></a>
        <?php else : ?>
                                <a href="<?php echo base_url() . "admin/admin_deals/profile_group_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Group Deal Profile"></a>
        <?php endif ?>
    <?php endif ?>
    
    <?php else : ?>
                            <a href="<?php echo base_url() . "admin/admin_deals_gallery/edit_gallery_group_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_gallery" src="assets/admin/images/icn_photo.png" title="<?php if($this->session->userdata('user_level') == 3) : ?>Manage<?php else : ?>View<?php endif ?> Group Deal Gallery"></a>
        <?php if($this->session->userdata('user_level') <> 3) : ?>
                                <a href="<?php echo base_url() . "admin/admin_deals/profile_group_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_search" src="assets/admin/images/icn_search.png" title="View Group Deal Profile"></a>
        <?php endif ?>
        <?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>                     
                                <a href="<?php echo base_url() . "admin/admin_deals/edit_group_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>"><img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Group Deal Info"></a>
        <?php endif ?>
        <?php endif ?>
        <?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>                        
                                <a onclick="return c_ask('Are you sure you want to delete the selected records?')" href="<?php echo base_url() . "admin/admin_deals/delete_single_deal/" . htmlentities($row2->deal_view_type) . "/" . htmlentities($row2->deal_hash); ?>">
                                    <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Group Deal">
                                </a>
                                <!--multi selectors-->
                                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkbox[]" class="checkbox_selector" value="<?php echo htmlentities($row2->deal_hash)?>">
                                <!-- end-->
        <?php endif ?>
<?php endif ?>
                    </td>
                </tr>
<?php endforeach ?> 
<!--End table class data_grid-->
</form>
<!--additional end form tag-->                  
            </tbody>            
            <tfoot class="nav">
                <tr>
                    <td colspan=100>
                        <div class="pagination"></div>
                        <div class="paginationTitle">Page</div>
                        <div class="selectPerPage"></div>
                        <div class="status"></div>
                    </td>
                </tr>
            </tfoot>
        </table> 
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
        <div style="padding: 5px; text-align: right; margin: 2px;">
            <form action="" method="post">
                <input type="button" value="Add" onclick="showAdd()">
                <!--multi delete-->
                <input onclick="return c_ask('Are you sure you want to delete the selected records?')" type="button" value="Delete Selected" id="multi_delete" onclick="return false">
                <!--end multi delete-->
            </form>
            <!--multi delete script-->
            <script type="text/javascript">
                $(function(){
                    $("#multi_delete").click(function(){
                        $("#form_multi").attr("action", "<?php echo base_url()?>/admin/admin_deals/multi_delete_single_deal").submit();
                    });
                });
            </script>
            <!--end multi delete script-->
        </div>
<?php endif ?>  
    </article>
</div>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
<div class = "add_member" style="display: <?php if(isset($_GET['error1']) == 1 || isset($_GET['error2']) == 1 || isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1 || isset($_GET['error5']) == 1):?>block<?php else : ?>none<?php endif ?>;">
<form class="form" onsubmit="" action="<?php echo base_url(); ?>admin/admin_deals/save_single_deal/<?php echo $this->uri->segment(4); ?>" faction="<?php echo base_url(); ?>admin/admin_deals/save_single_deal/<?php echo $this->uri->segment(4); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header><h3>Add New Deal</h3></header>
            <div id="deal_header"><?php if(isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1):?><h3>Group Deal Cover</h3><?php endif ?></div>
            <div style="margin: 20px;">
                <div id="deal_type">
                    <fieldset>
                        <label>Deal Company</label>
                        <select name="addDCO" required="required">
                            <option value="" selected="selected">-choose-</option>                      
<?php foreach($sql9 as $row9): ?>
                            <option value="<?php echo htmlentities($row9->company_hash); ?>"><?php echo xss_cleaner($row9->company_name); ?></option>
<?php endforeach ?>     
                        </select>
                        <label>Deal Category</label>
                        <select name="addDC" value="" required="required">
                            <option selected="selected">-choose-</option>
<?php foreach($sqlx as $rowx): ?>
                            <option value="<?php echo htmlentities($rowx->category_id); ?>"><?php echo xss_cleaner($rowx->category_name); ?></option>
<?php endforeach ?>
                        </select>
                        <label>Deal Type</label>
                        <select id="type" name="addDT" onchange="deal_type()">
                            <option value="Single Deal">Single Deal</option>
                            <option <?php if(isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1):?>selected="selected"<?php endif ?> value="Group Deal">Group Deal</option>
                        </select>
                    </fieldset>
                </div>
                <fieldset>
                    <label id="main_title"><?php if(isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1):?>Main<?php else : ?>Deal<?php endif ?> Title</label>
                    <input type="text" name="addMDN" value="" maxlength="60" required="required">
                    <label id="main_statement"><?php if(isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1):?>Main<?php else : ?>Deal<?php endif ?> Statement</label>
                    <input type="text" name="addMDS" value="" maxlength="100" required="required">
                </fieldset>
<?php $m = "m"; $d = "d"; $y = "Y"; ?>
                <fieldset>
                    <label>Start of Deal</label>
                    <input id="date1" onkeydown="reurn false" type="text" name="addSOD" value="<?php echo date($m . "/" . $d . "/" . $y, time()); ?>">
                    <label>End of Deal</label>
                    <input id="date2" onkeydown="reurn false" type="text" name="addEOD" value="<?php echo date($m . "/" . $d . "/" . $y, strtotime(date($y, time()) . "+ 1 month")); ?>">
                </fieldset>
                <fieldset>
                    <label>Main Cover</label>
                    <!--<input id="image_upload" type="file" name="addMMC" value="" accept="image/*">-->
<!--added upload function
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->                 <!--<script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/img_manipulation/jquery.min.js"></script>-->
                	<script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/img_manipulation/ajaxfileupload.js"></script>
                	<script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/img_manipulation/jquery.Jcrop.js"></script>
                	<script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/img_manipulation/jquery.color.js"></script>
                
                	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/img_manipulation/jquery.Jcrop.css">
                    <script>
                        $(function() {
                            var jcrop_api, boundx, boundy;
                            
                            $("#crop_save_button, #change_img_button, .image_wrapper").hide();
                            
                            $('#submit_upload').click(function() {
                                
                                    if($("#userfile").val() == ""){
                                        $(".saved_image_wrapper").html("<h4 class='alert_error'>No .jpg file is selected</h4>").show().fadeOut(7000);
                                        return false;
                                    }
                    		      $.ajaxFileUpload({
                    		         url         	:'<?php echo base_url()?>admin/admin_deals/upload_temp_image',
                    		         secureuri      : false,
                    		         fileElementId  :'userfile',
                    		         dataType    	: 'json',
                    		         data        	: {
                    		            'title' : 'upload'
                    		         },
                    		         success  : function (data, status)
                    		         {
                                          //crop view
                                          if(data.error == "")
                                          {
                                                $("#target, #preview").attr("src", data.path);
                                                $("#file_name").val(data.file_name);
                                                
                                                $(".upload_file_wrapper").hide();
                                                $("#change_img_button, .image_wrapper, #crop_save_button").show();
                                                initJcrop();
                                          }else{
                                            $(".saved_image_wrapper").html("<h4 class='alert_error'>" + data.error + "</h4>").show().fadeOut(7000);
                                            //alert(data.error);
                                          }
                                          
                    		         },
                                     handleError : function(data, status, e){
                                        //alert(e);
                                     }
                    		      });
                                  $("#userfile").val("");
                    		      return false;
                    		   });
                  		
                                $("#crop_save_button").click(function(){
                                    $.post('<?php echo base_url()?>admin/admin_deals/submit_crop',
                                            {
                                                x :  $('.x').val(),
                                                y :  $('.y').val(),
                                                h :  $('.h').val(),
                                                w :  $('.w').val(),
                                                th : $('.th').val(),
                                                tw : $('.tw').val(),
                                                file_name : $("#file_name").val()
                                            },function(data){
                                                jcrop_api.destroy();
                                                var cropped_img = "<img src='" + data.path + "' class='new_image_cropped'>";
                                                $(".image_wrapper ,#crop_save_button").hide();
                                                $(".saved_image_wrapper").show().html(cropped_img);
                                                $("#main_form_image_name_out").val(data.file_name);
                                            },"json"
                                    );
                                });
                                
                                //jcrop functions
                                function initJcrop(){
                                    $("#target").Jcrop({
                    				        onChange: updatePreview,
                    				        onSelect: updatePreview,
                                            addClass: "jcrop-dark",
                    				        aspectRatio: 750/263
                    				      },
                                          
                                          function()
                    				      {
                    				        var bounds = this.getBounds();
                    				        boundx = bounds[0];
                    				        boundy = bounds[1];
                    				        jcrop_api = this;
                    				      });
                                };
                                
                                function updatePreview(c)
                                {
                                    if (parseInt(c.w) > 0)
                                    {
                                          var rx = 750 / c.w;
                                          var ry = 263 / c.h;
                                        
                                          $('#preview').css({
                                            width: Math.round(rx * boundx) + "px",
                                            height: Math.round(ry * boundy) + "px",
                                            marginLeft: "-" + Math.round(rx * c.x) + "px",
                                            marginTop: "-" + Math.round(ry * c.y) + "px"
                                          });
                                           $(".x").val(c.x);
                                           $(".y").val(c.y);
                                           $(".w").val(c.w);
                                           $(".h").val(c.h);
                                           $(".th").val("263");
                                           $(".tw").val("750");
                                    }
                                };
                                          
                                $("#change_img_button").click(function(){
                                    jcrop_api.destroy();
                                    $.post("<?php echo base_url()?>admin/admin_deals/change_image",
                                        {
                                            file_name : $("#file_name").val()
                                        }
                                    );
                                    $("#target, #preview").attr("src", "").css({
                                        width : "",
                                        height : ""
                                        });
                                    $(".upload_file_wrapper").show();
                                    $(".image_wrapper, .saved_image_wrapper").hide();
                                    $("#change_img_button, #crop_save_button").hide();
                                });
                                
                            $("#url_image_getter_btn").click(function(){
                                //validation
//                                      ___
//                                    //- -\\
//                                    \\,_,//

//                                //post
                                $.post("<?php echo base_url()?>admin/admin_deals/upload_from_url",
                                    {
                                        urlfile : $("#urlfile").val()
                                    },
                                    function(data)
                                    {
                                        //if no error
                                        if(data.error == ""){
                                            $("#target, #preview").attr("src", data.path);
                                            $("#file_name").val(data.file_name);
                                            
                                            $(".upload_file_wrapper").hide();
                                            $("#change_img_button, .image_wrapper, #crop_save_button").show();
                                            initJcrop();
                                        }else{
                                        //data.error is not null
                                            $(".saved_image_wrapper").html("<h4 class='alert_error'>" + data.error + "</h4>").show().fadeOut(7000);
                                        }
                                    },
                                    "json"
                                );
                            });          
                        });//end main function
                    </script>
                        <!--uploader-->
                        <div class="upload_file_wrapper">
                            <!--upload from local-->
                            <br />
                            <h4 class="alert_info">Upload local file</h4>
                            <br />
                            <div style="text-align: center;">
                                <input type="file" name="userfile" id="userfile"/>&nbsp;&nbsp;&nbsp;
                                <input class="alt_btn" type="submit" value="Upload" id="submit_upload" onclick="return false"/>
                            </div>
                            
                            <!---->
                            <!--upload from url-->
                            <br /><br />
                            <h4 class="alert_info">Image from url</h4>
                            <br />
                            <input type="text" name="urlfile" id="urlfile" size="25" style="width: 86% !important;"/>
                            <input class="alt_btn" type="submit" value="Get Image" id="url_image_getter_btn" onclick="return false"/>
                            <!---->
                        </div>
            			
                        <!--images container-->
                        <div class="image_wrapper" style="text-align: center;">
                            <span class="target_wrap">
                    			<img src="" id="target"/>
                    		</span>
                    		
                    		<br/>
                    		<div class="preview_wrap">
                    			<img src="" id="preview"/>
                    		</div>
                            
                            <input type="hidden" name="x" class="x"/>
                    		<input type="hidden" name="y" class="y"/>
                    		<input type="hidden" name="h" class="h"/>
                    		<input type="hidden" name="w" class="w"/>
                    		<input type="hidden" name="th" class="th"/>
                    		<input type="hidden" name="tw" class="tw"/>
                    
                    		<input type="hidden" name="file_name" id="file_name" value=""/>
                            
                            
                        </div>
                        
                        <!--saved image container-->
                        <div class="saved_image_wrapper">
                        
                        </div>
                        <br />
                        <br />
                            <input type="button" value="Save" id="crop_save_button"/>
                            <input type="button" value="Change Image" id="change_img_button"/>
                        
                        <!--main form image out-->
                            <input type="hidden" name="crop_image" id="main_form_image_name_out" value=""/>
                        <!---->
<!--
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->
<?php if(isset($_GET['error1']) == 1):?>
                    <h4 class="alert_error">The image(s) didn't fit(s) the required size.</h4>
<?php endif; ?>
<?php if(isset($_GET['error2']) == 1):?>
                    <h4 class="alert_error">The image(s) didn't fit(s) the required filetype.</h4>
<?php endif; ?>
                    <!--<h4 class="alert_info">Required Image: (690 x 242) to (750 x 263) pixels JPG/JPEG</h4>-->
                </fieldset>
                <div id="deals_single" style="display: <?php if($this->uri->segment(5) == "" || isset($_GET['error']) == 1 || isset($_GET['error1']) == 1 || isset($_GET['error2']) == 1):?>block<?php elseif(isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1) : ?>none<?php else : ?>none<?php endif ?>;">
                    <fieldset>
                        <label>Embeded Code ( <a href="http://www.youtube.com/" target="_new" title="Get YOU TUBE embeded code">You Tube</a> )</label>
                        <textarea id="locations" class="link vid" name="addDV_single"></textarea>
<?php if(isset($_GET['error5']) == 1):?>
                        <br><br><br><br><br><br><br>
                        <h4 class="alert_error">The embeded YouTube video is invalid. The format must be like this :<br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;iframe width="560" height="315" src="http://www.youtube.com/embed/videocode" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;</h4>
<?php endif; ?>
                    </fieldset>
                    <fieldset>
                        <label>Remittance</label>
                        <input type="text" name="addR" autocomplete="off" value="" maxlength="3" required="required">
                    </fieldset>
                    <fieldset>
                        <label>Original Price</label>
                        <input class="single_id original_single" type="text" name="addOP" autocomplete="off" value="" maxlength="6" required="required">
                        <label>Discount (%)</label>
                        <input class="single_id discount_single" type="text" name="addD" autocomplete="off" value="" maxlength="6" required="required">
                        <label>Discounted Price</label>
                        <input class="single_id discounted_single" type="text" maxlength="6" disabled="disabled">
                        <input class="discounted_single" type="hidden" name="addDP">
                    </fieldset>
                    <article class="module width_full"> 
                        <header>
                            <h3 class="tabs_involved">
                            <select id="option_switcher" class="tabs" name="Oswitcher">
                                <option value="1">No options</option>
                                <option value="0">With options</option>
                            </select>
                        </header>
                        <div style="margin: 20px;">
                            <div id="deal_selections_single">
                                <fieldset class="none_option">
                                    <label>Stock</label>
                                    <input id="optionz" type="text" name="addStock" value=""  maxlength="10">
                                </fieldset>
                                <fieldset class="with_option">
                                    <label>Selection</label>
                                    <input id="selectionz" type="text" name="addDselect_single1" value=""  maxlength="20">
                                    <label id="options">Options</label>
                                    <div id="deal_options_single1">
                                        <input id="options" class="options_single1_1 O1" type="text" name="addDoption_single1_1" value="" maxlength="20" >
                                        <label class="option_count Op1">1</label>
                                    </div>
                                    <label id="options">Stock</label>
                                    <div id="deal_stock_single1">
                                        <input id="options" class="options_stock1_1 O1" type="text" name="addStock_single1_1" value="" maxlength="10" >
                                        <label class="option_count Op1">1</label>
                                    </div>
                                    <label id="options">
                                        <a href="add_more_option_single1" id="add_more_option_single1">Add More Option(s) and Stock(s)</a>
                                        <span id="icn_remove" class="single_id option_remove O off" count_o="1" title="Remove Last Line"></span>
                                    </label>
                                    <input type="hidden" name="nOPTION_single1" id="nOPTION_single1" value="1"> 
                                </fieldset>
                            </div>
<?php if($this->session->userdata('user_level') == 99) : ?>
                            <fieldset class="with_option">
                               <label><a href="add_more_selection_single" id="add_more_selection_single">Add More Selection(s)</a></label>
<?php endif ?> 
                               <input type="hidden" name="nSELECTION_single" id="nSELECTION_single" value="1">
<?php if($this->session->userdata('user_level') == 99) : ?> 
                            </fieldset>
<?php endif ?>
                        </div>
                    </article>
                    <br>
                    <fieldset>
                        <label>Highlights</label>
                        <div id="deal_highlights_single">
                            <input id="highlights" class="single_id H1" type="text" name="addH_single1" maxlength="255" required="required">
                        </div>
                        <label><a href="add_more_highlights_single" id="add_more_highlights_single">Add More Highlight(s)</a></label>
                        <span id="icn_remove" class="input_remove H off" count_h="1" title="Remove Last Line"></span>
                        <input type="hidden" name="nH_single" id="nH_single" value="1">
                    </fieldset>
                    <fieldset>
                        <label>Terms</label>
                        <div id="deal_terms_single">
                            <input id="terms" class="single_id T1" type="text" name="addT_single1" maxlength="255" required="required">
                        </div>
                        <label><a href="add_more_terms_single" id="add_more_terms_single">Add More Term(s)</a></label>
                        <span id="icn_remove" class="input_remove T off" count_t="1" title="Remove Last Line"></span>
                        <input type="hidden" name="nT_single" id="nT_single" value="1">
                    </fieldset>
                    <fieldset>
                        <label>Content</label>
                        <textarea id="content" class="single_id" name="addContent_single" required="required"></textarea>
                    </fieldset>
                </div>
                <div id="deals_group" <?php if(isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1):?>style="display: block;"<?php else : ?>style="display: none;"<?php endif ?>>
                    <div class="deal_1">
                        <br><hr>
                        <article class="module width_full">
                            <header><h3>Deal 1</h3></header>
                            <div style="margin: 20px;">
                                <fieldset>
                                   <label>Deal Title</label><input class="double_id" type="text" name="addDN1" value="" maxlength="60" >
                                   <label>Deal Statement</label><input class="double_id" type="text" name="addDS1" value="" maxlength="100" >
                                </fieldset>
                                <fieldset>
                                    <label>Original Price</label>
                                    <input class="double_id original_group1" type="text" name="addOP1" autocomplete="off" value="" maxlength="6" >
                                    <label>Discount (%)</label>
                                    <input class="double_id discount_group1" type="text" name="addD1" autocomplete="off" value="" maxlength="6" >
                                    <label>Discounted Price</label>
                                    <input class="double_id discounted_group1" type="text" maxlength="6" disabled="disabled">
                                    <input class="discounted_group1" type="hidden" name="addDP1">
                                </fieldset>
                                <article class="module width_full">
                                    <header>
                                        <h3 class="tabs_involved">
                                        <div id="option_switcher">
                                        <select id="option_switcher1" class="tabs" name="Oswitcher1">
                                            <option value="1">No options</option>
                                            <option value="0">With options</option>
                                        </select>
                                        </div>
                                    </header>
                                    <div style="margin: 20px;">
                                        <div id="deal_selections_group1">
                                            <fieldset class="none_option1">
                                                <label>Stock</label>
                                                <input id="optionz1" class="double_id" type="text" name="addStock1" value="" maxlength="10">
                                            </fieldset>
                                            <fieldset class="with_option1" style="display: <?php if(isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1):?>none<?php else : ?>block<?php endif ?>;">
                                                <label>Selection</label>
                                                <input id="selectionz" type="text" name="addDselect_group1_1" value="" maxlength="20">
                                                <label  id="options">Options</label>
                                                <div id="deal_options_group1_1">
                                                    <input id="options" class="options_group1_1_1 O1_1" type="text" name="addDoption_group1_1_1" maxlength="20">
                                                    <label class="option_count Op1_1">1</label>
                                                </div>
                                                <label id="options">Stock</label>
                                                <div id="deal_stock_group1_1">
                                                    <input id="options" class="options_group1_1_1 O1_1" type="text" name="addStock_group1_1_1" maxlength="10">
                                                    <label class="option_count Op1_1">1</label>
                                                </div>
                                                <label id="options">
                                                    <a href="add_more_option_group1_1" id="add_more_option_group1_1">Add More Option(s) and Stock(s)</a>
                                                    <span id="icn_remove" class="option_remove O1 off" count_o1="1" title="Remove Last Line"></span>
                                                </label>
                                                <input type="hidden" name="nOPTION_group1_1" id="nOPTION_group1_1" value="1">
                                            </fieldset>
                                        </div>
<?php if($this->session->userdata('user_level') == 99) : ?>
                                        <fieldset class="with_option1">
                                            <label><a href="add_more_selection_group1" id="add_more_selection_group1">Add More Selection(s)</a></label>
<?php endif ?>
                                            <input type="hidden" name="nSELECTION_group1" id="nSELECTION_group1" value="1">
<?php if($this->session->userdata('user_level') == 99) : ?>
                                        </fieldset>
<?php endif ?>
                                    </div>
                                </article>
                                <br>
                                <fieldset>
                                    <label>Highlights</label>
                                    <div id="deal_highlights_group1">
                                        <input id="highlights" class="double_id H1_1" type="text" name="addH_group1_1" maxlength="255">
                                    </div>
                                    <label><a href="add_more_highlights_group1" id="add_more_highlights_group1">Add More Highlight(s)</a></label>
                                    <span id="icn_remove" class="input_remove H1 off" count_h1="1" title="Remove Last Line"></span>
                                    <input type="hidden" name="nH_group1" id="nH_group1" value="1">
                                </fieldset>
                                <fieldset>
                                    <label>Terms</label>
                                    <div id="deal_terms_group1">
                                        <input id="terms" class="double_id T1_1" type="text" name="addT_group1_1" maxlength="255">
                                    </div>
                                    <label><a href="add_more_terms_group1" id="add_more_terms_group1">Add More Term(s)</a></label>
                                    <span id="icn_remove" class="input_remove T1 off" count_t1="1" title="Remove Last Line"></span>
                                    <input type="hidden" name="nT_group1" id="nT_group1" value="1">
                                </fieldset>
                                <fieldset>
                                    <label>Content</label>
                                    <textarea id="content" class="double_id" name="addContent_group1"></textarea>
                                </fieldset>
                                <div id="deals_cover">
<?php if(isset($_GET['error3']) == 1):?>
                                    <fieldset>
                                        <label>Deal Cover</label>
                                        <input class="double_id" type="file" required="required" name="addMC1" value="">
                                        <h4 class="alert_error">The image(s) didn't fit(s) the required size.</h4>
                                        <h4 class="alert_info">Required Image: (690 x 242) to (750 x 263) pixels JPG/JPEG</h4>
                                    </fieldset>
<?php endif; ?>
<?php if(isset($_GET['error4']) == 1):?>
                                    <fieldset>
                                        <label>Deal Cover</label>
                                        <input class="double_id" type="file" required="required" name="addMC1" value="">
                                        <h4 class="alert_error">The image(s) didn't fit(s) the required filetype.</h4>
                                        <h4 class="alert_info">Required Image: (690 x 242) to (750 x 263) pixels JPG/JPEG</h4>
                                    </fieldset>
<?php endif; ?>
                                </div>
                                <fieldset>
                                    <label>Embeded Code ( <a href="http://www.youtube.com/" target="_new" title="Get YOU TUBE embeded code">You Tube</a> )</label>
                                    <textarea id="locations" class="link" name="addDV_group1"></textarea>
                                </fieldset>
                            </div>
                        </article>
                    </div>
                </div>
                <div id="add_more" style="display: <?php if(isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1):?>block<?php else : ?>none<?php endif ?>;">
                    <fieldset>
                       <label><a href="add_more_deal" id="add_more_deal">Add More Deal(s)</a></label>
                       <span id="icn_remove" class="input_remove D off" count_d="1" title="Remove Last Line"></span>
                       <input type="hidden" name="nDEAL" id="nDEAL" value="1">
                    </fieldset>
                </div>
            </div>
    </article>
    <article class="module width_full">
        <div style="text-align: right;">
            <div style="margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick=" <?php if(isset($_GET['error1']) == 1 || isset($_GET['error2']) == 1 || isset($_GET['error3']) == 1 || isset($_GET['error4']) == 1):?>window.history.back();<?php else : ?>showList()<?php endif ?>">
                    <input class="alt_btn" type="submit" name="save" value="Save" />
                    <input class="blt_btn" type="button" name="save" value="Save"/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />    
                </fieldset>
            </div>        
        </div>
    </article>
</form>
</div>
<?php endif ?>
