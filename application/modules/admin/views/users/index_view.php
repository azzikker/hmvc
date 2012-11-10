<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>

<!--script for multi select-->
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
<!--end script for multi select-->

<div class = "list_member" style="/*display: none;*/">  
    <article class="module width_full">
        <header><h3>Users</h3></header>
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Whole Name</th>
                    <th>User Level</th>
                    <th>Actions
<!--added multi select checkbox-->
                    <input type="checkbox" class="selectall"/>
<!--end added box-->
                    </th> 
                </tr>
            </thead>  
            <tbody id = 'info_grid'>
<?php foreach($sql1 as $row1) : ?>
<?php $u_encrypt = ((htmlentities($row1->user_id))*8)+8; ?>
<?php $u_decrypt = (($u_encrypt)-8)/8; ?>
<?php $u_encrypt_count = strlen($u_encrypt); ?>
<?php $user_id_hash = md5(time() . "" . $u_encrypt . "" . time() . "" . $u_decrypt) . "" . time() . "" . $u_encrypt; ?>
<?php if($this->session->userdata("user_id") == 27) : ?>
                <tr align="center">
<?php if($this->session->userdata("user_id") == $u_decrypt) : ?>               
                    <td><font color="green"><b><?php echo htmlentities($row1->user_name); ?></b></font></td>
                    <td><font color="green"><b><?php echo ucwords(htmlentities($row1->user_lastname) . ", " . htmlentities($row1->user_firstname) . " " . htmlentities($row1->user_middlename)); ?></b></font></td>
                    <td><?php echo ucwords($row1->level_name); ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/admin_users/accountUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>"><img id="icn_view" src="assets/admin/images/icn_search.png" title="Manage Your Profile"></a>
                        <img id="icn_none" src="assets/admin/images/icn_none.png">
                        <img id="icn_none" src="assets/admin/images/icn_none.png">
                    </td>
<?php else : ?>
                    <td><?php echo $row1->user_name; ?></td>
                    <td><?php echo ucwords(htmlentities($row1->user_lastname) . ", " . htmlentities($row1->user_firstname) . " " . htmlentities($row1->user_middlename)); ?></td>
                    <td><?php echo ucwords($row1->level_name); ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/admin_users/editUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>"><img id="icn_view" src="assets/admin/images/icn_search.png" title="Manage User Profile"></a>
                        <a onclick="return c_ask('Are you sure you want to ban the selected record?')" href="<?php echo base_url(); ?>admin/admin_users/banUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>">
                            <img id="icn_ban" src="assets/admin/images/icn_ban.png" title="Ban User Profile"/></a>
                        <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_users/deleteUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete User Profile"/>
                        </a>
                       
                    </td>
<?php endif ?>
                </tr>
<?php else : ?>
<?php if($row1->user_level==0) : ?>
<?php else : ?>                
                <tr align="center">
<?php if($this->session->userdata("user_id") == $u_decrypt) : ?>               
                    <td><font color="green"><b><?php echo htmlentities($row1->user_name); ?></b></font></td>
                    <td><font color="green"><b><?php echo ucwords(htmlentities($row1->user_lastname) . ", " . htmlentities($row1->user_firstname) . " " . htmlentities($row1->user_middlename)); ?></b></font></td>
                    <td><?php echo ucwords($row1->level_name); ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/admin_users/accountUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>"><img id="icn_view" src="assets/admin/images/icn_search.png" title="Manage Your Profile"></a>
                        <img id="icn_none" src="assets/admin/images/icn_none.png">
                        <img id="icn_none" src="assets/admin/images/icn_none.png">
                    </td>
<?php else : ?>
                    <td><?php echo $row1->user_name; ?></td>
                    <td><?php echo ucwords(htmlentities($row1->user_lastname) . ", " . htmlentities($row1->user_firstname) . " " . htmlentities($row1->user_middlename)); ?></td>
                    <td><?php echo ucwords($row1->level_name); ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/admin_users/editUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>"><img id="icn_view" src="assets/admin/images/icn_search.png" title="Manage User Profile"></a>
                        <a onclick="return c_ask('Are you sure you want to ban the selected record?')" href="<?php echo base_url(); ?>admin/admin_users/banUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>"><img id="icn_ban" src="assets/admin/images/icn_ban.png" title="Ban User Profile"></a>
<!--changed delete to trash button -->                         
                        <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_users/trashUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete User Profile"/>
                        </a>
<!--added selector-->
                         <input type="checkbox" name="checkbox" class="checkbox_selector"/>
<!--end added selector-->
<!--end changed trash-->                        
                    </td>
<?php endif ?>
                </tr>
<?php endif ?>                
<?php endif ?>                
<?php endforeach ?>                   
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
        <div style="padding: 5px; text-align: right; margin: 2px;">
            <form action="" method="post">
            <input type="button" value="Add" onclick="showAdd()"/>
<!--added multi trash button-->
            <input type="button" value="Trash Selected" onclick="return false"/>
<!--end added trash-->
            </form>
        </div>  
    </article>
</div>
<div class = "add_member" style="display: none;">
<form action="<?php echo base_url(); ?>admin/admin_users/saveUser" name="register" method="post" onsubmit="return checkform();">
    <article class="module width_full">
        <header><h3>Add New User</h3></header>
            <div id="deal_header"></div>
            <div style="margin: 20px;">
                <div id="deal_type">
                    <fieldset>
                        <label>First Name</label><input type="text" name="txtFN" value="" required="required">
                        <label>Middle Name</label><input type="text" name="txtMN" value="" required="required">
                        <label>Last Name</label><input type="text" name="txtLN" value="" required="required">
                    </fieldset>
                    <fieldset>
                        <?php if(isset($_GET['error']) == 1):?><h4 class="alert_error">Username Already Exist!</h4><?php endif; ?>
                        <label>Username</label><input type="text" name="txtUN" value="" required="required">
                        <label>Password</label><input type="password" name="txtPW" value="" required="required">
                        <label>Confirm Password</label><input type="password" name="txtCPW" value="" required="required">
                    </fieldset>
                    <fieldset>
                        <label>User Level</label>
                        <select name="txtUL" required="required">
<?php foreach($sqlx as $rowx) : ?>
<?php if($rowx->level_id==0) : ?>
                            <option value="" selected="selected">--choose--</option>
<?php elseif($rowx->level_id==2) : ?>
<?php else : ?>
                            <option value="<?php echo $rowx->level_id; ?>"><?php echo $rowx->level_name; ?></option>
<?php endif ?>
<?php endforeach ?>
<?php if($this->session->userdata("user_id") == 27) : ?>
                            <option value="0">master admin</option>
<?php endif ?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <label>E-mail</label><input type="text" name="txtEA" value="" required="required">
                        <label>Contact No.</label><input type="text" name="txtCN" value="" required="required">
                        <input type="hidden" name="txtMSG" value="Saved by VigDeals Admin!">
                    </fieldset>
                </div>
            </div>
    </article>
    <article class="module width_full">
        <div style="text-align: right;">
            <div style="margin: 20px;">
                <fieldset>
                    <input type="button" value="Back" onclick="showList()">
                    <input class="alt_btn" type="submit" name="cmdlogin" value="Save"/>
                </fieldset>
            </div>        
        </div>
    </article>
</form>
</div>