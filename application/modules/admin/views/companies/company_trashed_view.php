<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>

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
                            });
</script>
<!---->

<div class = "list_member" style="display: <?php if(isset($_GET['error']) == 1 || isset($_GET['error1']) == 1 || isset($_GET['error2']) == 1):?>none<?php else : ?>block<?php endif ?>;">  
    <article class="module width_full">
<?php if($page != "Company Reports") : ?>
        <header><h3>Companies</h3>
<!--Added tabs-->
                <ul class="tabs">
                    <li><a href="#" onclick="return false">Current Company</a></li>
                    <li><a href="#" onclick="return false">Trashed Company</a></li>
                </ul>
<!---->
        </header>
<?php else : ?>
        <header><h3>Company Reports</h3></header>
<?php endif ?>
        <header>
            <form class="search" action="<?php echo base_url(); ?>admin/admin_companies/index/<?php echo $this->uri->segment(4); ?>/search" method="post" enctype="multipart/form-data">
                <input type="text" name="search_here" value="Company Name" onfocus="search_record(this.value='')">
                <input class="btn_search" type="submit" name="search" value="Search">
            </form>
        </header>
<!--start form  tag selector-->
                <form method="POST" action="" id="form_multi" class="form_multi">
<!---->
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr align="left">
                    <th id = "table_spacing" align="center">Company ID</th>
                    <th>Company Name</th>
                    <th>Merchant</th>
                    <th align="center">Number of Deals</th>
                    <th align="center">Actions
<!--select all-->
                        <input type="checkbox" class="selectall" title="Select All"/>
<!--end select all-->  
                    </th>
                    
                </tr>
            </thead> 
<!--none breaking Faking fixer space for table alignment !do not remove-->
        &nbsp;
<!---->
            <tbody id = 'info_grid'>

<?php foreach($sql as $row) : ?>
<?php $c_encrypt = ((htmlentities($row->company_id))*8)+8; ?>
<?php $c_decrypt = (($c_encrypt)-8)/8; ?>
<?php $c_encrypt_count = strlen($c_encrypt); ?>
<?php $company_id_hash = md5(time() . "" . $c_encrypt . "" . time() . "" . $c_decrypt) . "" . time() . "" . $c_encrypt; ?>
<?php $company_title = shortenString(ucwords(xss_cleaner($row->company_name)), 35); ?>
<?php $table1 = "deal_view"; $table2 = "users"; //-----CUT HERE-----// ?>
<?php $deal_where['company_id'] = htmlentities($row->company_id); $user_where['user_id'] = $row->user_id ?>
<?php $sql1 = $this->db->get_where($table1,$deal_where); ?>
<?php $sql3 = $this->db->get_where($table2,$user_where)->result(); ?>
<?php $deals_count = $sql1->num_rows; ?>
                <tr align="left" title="<?php echo ucwords($row->company_name); ?>">
                    <td id = "table_spacing" align="center"><span></span><?php echo str_replace("10", "", printf("%010s", htmlentities($row->company_id))); ?></td>
                    <td><span></span><?php echo $company_title[0];?></td>
                    <td>
<?php if($row->user_id == 0) : ?>
                        <span></span> 
<?php else : ?>
<?php foreach($sql3 as $row3) : ?>
                        <span></span><?php echo $row3->user_lastname . ", " . $row3->user_firstname . " " . $row3->user_middlename; ?>
<?php endforeach ?>
<?php endif ?>
                    </td>
                    <td align="center"><?php echo $deals_count; ?></td>
                    <td align="center">
<?php if($page != "Company Reports") : ?>
                        <a href="<?php echo base_url(); ?>admin/admin_companies/profileCompany/<?php echo $c_encrypt_count; ?>/<?php echo $company_id_hash; ?>/current"><img id="icn_view" src="assets/admin/images/icn_search.png" title="View Company Profile"></a>
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 2 || $this->session->userdata('user_level') == 0) : ?>
                        <a href="<?php echo base_url(); ?>admin/admin_companies/editCompany/<?php echo $c_encrypt_count; ?>/<?php echo $company_id_hash; ?>"><img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Company Profile"></a>
<?php if($this->session->userdata('user_level') == 0) : ?>
                        <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_companies/trash_company/<?php echo $c_encrypt_count; ?>/<?php echo $company_id_hash; ?>"><img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete Company"></a>
<!--multi selectors-->
                        &nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkbox[]" class="checkbox_selector" value="<?php echo $c_encrypt_count; ?>/<?php echo $company_id_hash;?>">
<!-- end-->
<?php endif ?>
<?php endif ?>
<?php else : ?>
                        <a href="<?php echo base_url(); ?>admin/admin_companies/reportCompany/<?php echo $c_encrypt_count; ?>/<?php echo $company_id_hash; ?>"><img id="icn_view" src="assets/admin/images/icn_search.png" title="View Company Report"></a>
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
        <div style="padding: 5px; text-align: right; margin: 2px;">
            <form action="" method="post"><input type="button" value="Add" onclick="showAdd()"></form>
        </div>
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
<?php if($this->session->userdata('user_level') == 3 || $this->session->userdata('user_level') == 0) : ?>
                        <label>Profile User</label>
                        <select name="addU" required="required">
                            <option selected="selected"></option>
<?php foreach($sql2 as $row2) : ?>
                            <option value="<?php echo htmlentities($row2->user_id); ?>"><?php echo ucwords($row2->user_lastname . ", " . $row2->user_firstname . " " . $row2->user_middlename); ?></option>
<?php endforeach ?>
                        </select>
<?php endif ?>
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
                        <label>Company Website</label><input type="text" name="addCW" value="" maxlength="40" required="required">
                        <label>Company E-mail</label><input type="text" name="addCE" value="" maxlength="40" required="required">
                        <label>Company Contact No.</label><input type="text" name="addCCN" value="" maxlength="20" required="required">
                        <label>Company Contact Person</label><input type="text" name="addCPN" value="" maxlength="40" required="required">
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
                    <input class="alt_btn" type="submit" name="cmdlogin" value="Save"/>
                </fieldset>
            </div>        
        </div>
    </article>
</form>
</div>
<?php endif ?>
<?php endif ?>