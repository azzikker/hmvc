<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<!--added script selector and form send multi restore-->
<script>
    $(function(){
        $(".selectall").click(function(){
                        if(this.checked == true){
                            $("#list_member").find(".checkbox_selector").attr("checked", '');
                        }else{
                            $("#list_member").find(".checkbox_selector").removeAttr("checked");
                        }
                        });
                        
                        $(".checkbox_selector").click(function(){
                        if($(".checkbox_selector:checked").length == $(".checkbox_selector").length){
                            $(".selectall").attr("checked", '');
                        }else{
                            $(".selectall").removeAttr("checked");
                        }
                        });
                        
                        $(".multi_restore").click(function(){
                            $(".multi_restore_form").attr("action", "<?php echo base_url()?>admin/admin_users/multi_restoreUser").submit();
                        });
    });
</script>   
<!--end added script-->
<div id = "list_member" style="/*display: none;*/">  
    <article class="module width_full">
        <header><h3>Users Trashed</h3></header>
<!--added form tag for multi restore function-->
        <form method="post" action="" class="multi_restore_form">
<!--end form begin tag-->    
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Whole Name</th>
                    <th>Actions
<!--added select all checkbox-->
                    <input type="checkbox" class="selectall"/>
<!--end added checkbox-->
                    </th> 
                </tr>
            </thead>  
            <tbody id = 'info_grid'>
<?php foreach($sql1 as $row1) : ?>
<?php $u_encrypt = ((htmlentities($row1->user_id))*8)+8; ?>
<?php $u_decrypt = (($u_encrypt)-8)/8; ?>
<?php $u_encrypt_count = strlen($u_encrypt); ?>
<?php $user_id_hash = md5(time() . "" . $u_encrypt . "" . time() . "" . $u_decrypt) . "" . time() . "" . $u_encrypt; ?>
                <tr align="center">               
                    <td><?php echo htmlentities($row1->user_name); ?></td>
                    <td><?php echo ucwords(htmlentities($row1->user_lastname) . ", " . htmlentities($row1->user_firstname) . " " . htmlentities($row1->user_middlename)); ?></td>
                    <td>
                        <a onclick="return c_ask('Are you sure you want to restore the selected record?')" href="<?php echo base_url(); ?>admin/admin_users/restoreUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>"><img id="icn_restore" src="assets/admin/images/icn_renew.png" title="Restore User Account"></a>
<!--added checkbox selector for each table element-->
                        <input type="checkbox" name="checkbox[]" class="checkbox_selector" value="<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>"/>
<!--end added checkbox selector-->                        
                        <!--<a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_users/deleteUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete User Account">
                        </a>-->
                    </td>
                </tr>
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
<!--added form end tab-->
        </form>
<!--end added tag-->
<!--added button-->        
        <div style="padding: 5px; text-align: right; margin: 2px;">
                <input type="button" value="Restore Selected" onclick="return false" class="multi_restore"/>
        </div> 
<!--end added button--> 
    </article>
</div>