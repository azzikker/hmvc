<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>

<script type="text/javascript"> 
    var add_ccontact = new add_ccontact();
    var delete_ccontact = new delete_ccontact();
</script>
<!--Select all script-->
<script type="text/javascript">
                            $(function(){
                                $(".selectall").click(function(){
                                    if(this.checked == true){
                                        $(".list_member").find(".checkbox_selector").attr("checked", '');
                                    }else{
                                        $(".list_member").find(".checkbox_selector").removeAttr("checked");
                                    }
                                });
                                
                                $(".checkbox_selector").click(function(){
                                    if($(".checkbox_selector:checked").length == $(".checkbox_selector").length){
                                        $(".selectall").attr("checked", '');
                                    }else{
                                        $(".selectall").removeAttr("checked");
                                    }
                                });
                                
                                $(".multi_trash_button").click(function(){
                                    $(".form_multi").attr("action" , "<?php echo base_url()?>admin/admin_companies/multi_trash_company").submit();
                                });
                                
                                $(".multi_restore_button").click(function(){
                                    $(".form_multi").attr("action" , "<?php echo base_url()?>admin/admin_companies/multi_restore_company").submit();
                                });
                            });
</script>
<!---->

<div class = "list_member" style="display: <?php if(isset($_GET['error']) == 1 || isset($_GET['error1']) == 1 || isset($_GET['error2']) == 1):?>none<?php else : ?>block<?php endif ?>;">  
    <article class="module width_full">
<?php if($page == "Current Companies") : ?>
        <header><h3>Companies - Active</h3>
<!--Added tabs-->                                                           
                <ul class="tabs">
                    <li><a href="#" onclick="return false">Active</a></li>
                    <li><a href="<?php base_url()?>admin/admin_companies/index/trashed">Deleted</a></li>
                </ul>

        </header>
<?php elseif ($page == "Trashed Companies") : ?>
        <header><h3>Companies - Deleted</h3>
                <ul class="tabs">
                    <li><a href="<?php base_url()?>admin/admin_companies/index/maintenance" >Active</a></li>
                    <li><a href="<?php base_url()?>admin/admin_companies/index/trashed">Deleted</a></li>
                </ul>
<!--end added tabs-->
        </header>   
<?php else : ?>
        <header><h3>Company Reports</h3></header>
<?php endif ?>
                <script>
                    $(function(){
                        $(".btn_search").click(function(){
                            if($(".search_item").val() == "")
                            {
                                return false;
                                
                            }else{
                                if($(".search_item").val() == "Company Name"){
                                    return false;
                                }else{
                                    $(".form_search").submit();    
                                }  
                            }
                        });
                    });
                </script>
        <header>
            <form class="search form_search" action="<?php echo base_url(); ?>admin/admin_companies/index/<?php echo $this->uri->segment(4); ?>/search" method="post" enctype="multipart/form-data">
                <input type="text" name="search_here" value="Company Name" onfocus="search_record(this.value='')" class="search_item">
                <input class="btn_search" type="submit" name="search" value="Search" onclick=""/>
            </form>
        </header>
<!--start form  tag selector-->
                <form method="POST" action="" id="form_multi" class="form_multi">
<!---->
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr align="left">
                    <th id = "table_spacing" align="center">COMPANY ID</th>
                    <th>COMPANY NAME</th>
                    <th align="center">NUMBER OF DEALS</th>
                    <th align="center">ACTIONS
<?php if($this->session->userdata('user_level') == 0 || $this->session->userdata('user_level') == 3) : ?>
<?php if($this->uri->segment(4) == "maintenance") : ?>
<!--select all-->
                        <input type="checkbox" class="selectall" title="Select All"/>
<!--end select all-->
<?php endif ?>  
<?php endif ?>
                    </th>
                </tr>
            </thead> 
<!--none breaking Faking fixer space for table alignment !do not remove-->
        &nbsp;
<!--end none breaking space-->
            <tbody id = 'info_grid'>

<?php foreach($sql as $row) : ?>
<?php $company_id_hash = $row->company_hash; ?>
<?php $company_title = shortenString(ucwords(xss_cleaner($row->company_name)), 35); ?>
<?php $table1 = "deal_view"; $table2 = "users"; //-----CUT HERE-----// ?>
<?php $deal_where['company_hash'] = htmlentities($row->company_hash); ?>
<?php $sql1 = $this->db->get_where($table1,$deal_where); ?>
<?php $sql3 = $this->db->get($table2)->result(); ?>
<?php $deals_count = $sql1->num_rows; ?>
                    <tr align="left" title="<?php echo ucwords($row->company_name); ?>">
                        <td id = "table_spacing" align="center"><span></span><?php echo str_replace("10", "", printf("%010s", htmlentities($row->company_id))); ?></td>
                        <td><span></span><?php echo $company_title[0];?></td>
                        <td align="center"><?php echo $deals_count; ?></td>
                        <td align="center">
<?php if($page != "Company Reports") : ?>
<?php if($page != "Trashed Companies"):?>
                            <a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $company_id_hash; ?>/profile"><img id="icn_view" src="assets/admin/images/icn_search.png" title="View Company Info"></a>
                            <a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $company_id_hash; ?>/branches"><img id="icn_view" src="assets/admin/images/icn_search.png" title="View Company Branches"></a>
<?php else: //display restore button?>
<?php endif?>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 2 || $this->session->userdata('user_level') == 0) : ?>
<?php if($page != "Trashed Companies"):?>          
                                <a href="<?php echo base_url(); ?>admin/admin_companies/editCompany/<?php echo $company_id_hash; ?>"><img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Company Profile"></a>
<?php else: //display restore button?>
<?php endif?>
<?php if($this->session->userdata('user_level') == 0) : ?>
<!--added filter for trashed tab to display restore button-->
<?php if($page != "Trashed Companies") ://display trash button?>
                <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_companies/trash_company/<?php echo $company_id_hash; ?>"><img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Company"></a>
<?php else: //display restore button?>
                <a onclick="return c_ask('Are you sure you want to restore the selected record?')" href="<?php echo base_url(); ?>admin/admin_companies/restore_company/<?php echo $company_id_hash; ?>"><img id="icn_restore" src="assets/admin/images/icn_renew.png" title="Restore Company"></a>
<?php endif?>
<!--end added filter-->
            
<!--multi selectors-->
                                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkbox[]" class="checkbox_selector" value="<?php echo $company_id_hash;?>">
<!--end multi selectors-->
        <?php endif ?>
        <?php endif ?>
    <?php else : ?>
                            <a href="<?php echo base_url(); ?>admin/admin_companies/reportCompany/<?php echo $company_id_hash; ?>"><img id="icn_view" src="assets/admin/images/icn_search.png" title="View Company Report"></a>
    <?php endif ?>
                        </td>
                    </tr>
<?php endforeach ?>
<!--end form tag selector-->
                </form>
<!----> 
            </tbody>
            
            <tfoot class="nav">
                <tr>
                    <td colspan=7>
                        <div class="pagination"></div>
                        <div class="paginationTitle">Page</div>
                        <div class="selectPerPage"></div>
                        <div class="status"></div>
                    </td>                                                               
                </tr>
            </tfoot>
        </table> 

<?php if($page != "Company Reports") : ?>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
<?php if($this->uri->segment(4) == "maintenance") : ?> 
            <div style="padding: 5px; text-align: right; margin: 2px;">
                
                <form action="" method="post">
                    <input type="button" value="Add" onclick="showAdd()"/>
<!--added filter for trashed tab to display multi restore button-->
<?php if($page != "Trashed Companies") ://display trash button?>
                    <input onclick="return c_ask('Are you sure you want to delete the selected records?')" type="button" value="Delete Selected" onclick="return false" class="multi_trash_button"/>
<?php else: //display restore button?>
                    <input onclick="return c_ask('Are you sure you want to restore the selected records?')" type="button" value="Restore Selected" onclick="return false" class="multi_restore_button"/>
<?php endif ?>
<!--end add filter for multi restore-->
                </form>
            </div>
<?php endif ?>  
<?php endif ?>  
<?php endif ?>  
    </article>
</div>
<?php if($page != "Company Reports") : ?>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
    <div class = "add_member" style="display: <?php if(isset($_GET['error']) == 1 || isset($_GET['error1']) == 1 || isset($_GET['error2']) == 1):?>block<?php else : ?>none<?php endif ?>;">
    <form action="<?php echo base_url(); ?>admin/admin_companies/saveCompany" name="register" method="post" onsubmit="return checkform();" enctype="multipart/form-data">
        <article class="module width_full">
            <header><h3>Add New Company</h3></header>
                <div id="deal_header"></div>
                <div style="margin: 20px;">
                    <div id="deal_type">
                        <fieldset>
<?php if(isset($_GET['error']) == 1):?><br><br><br><div><h4 class="alert_error">Company Name Already Exist!</h4></div><?php endif; ?>
                            <label>Company Name</label><input type="text" name="addCN" value="" maxlength="40" required="required">
                        </fieldset>
                        <fieldset>
                            <label>Company Logo</label><input id="image_upload" type="file" name="addCL" value="">
<?php if(isset($_GET['error1']) == 1):?>
                                <h4 class="alert_error">The image(s) didn't fit(s) the required size.</h4>
<?php endif; ?>
<?php if(isset($_GET['error2']) == 1):?>
                                <h4 class="alert_error">The image(s) didn't fit(s) the required filetype.</h4>
<?php endif; ?>
                            <h4 class="alert_info">Required Image: (350 to 550) pixels width JPG/JPEG</h4>
                        </fieldset>
                        <fieldset>
                            <label>Company Website</label><input type="text" name="addCW" value="" maxlength="40">
                            <label>Company E-mail</label><input type="text" name="addCE" value="" maxlength="40">
                            <label>Company Fax</label><input type="text" name="addCFN" value="" maxlength="20">
                        </fieldset>
                        <fieldset>
                            <label>Company Contact No.</label>
                            <div id="cc">
                                <input id="options" class="CN1 addCCN1" type="text" name="addCCN1" value="" maxlength="20">
                            </div>
                            <label><a href="add_more_ccontact" id="add_more_ccontact">Add More Contact(s)</a></label>
                            <span id="icn_remove" class="right_button input_remove CC off" count_cc="1" title="Remove Last Line"></span>
                            <input type="hidden" name="mCCONTACT" id="mCCONTACT" value="1">
                            <input type="hidden" name="nCCONTACT" id="nCCONTACT" value="1">
                        </fieldset>
                        <fieldset>
                            <label>Company Address</label><input type="text" name="addCA" value="" required="required">  
                        </fieldset>
                        <fieldset>
                            <label>Company Press Release</label><textarea id="content" name="addCPR" required="required"></textarea>
                        </fieldset>
                    </div>
                </div>
        </article>
        <article class="module width_full">
            <div style="text-align: right;">
                <div style="margin: 20px;">
                    <fieldset>
                        <input type="button" value="Back" onclick=" <?php if(isset($_GET['error']) == 1 || isset($_GET['error1']) == 1 || isset($_GET['error2']) == 1):?>window.history.back();<?php else : ?>showList()<?php endif ?>">
                        <input class="alt_btn" type="submit" name="save" value="Save"/>
                    </fieldset>
                </div>        
            </div>
        </article>
    </form>
    </div>
<?php endif ?>
<?php endif ?>