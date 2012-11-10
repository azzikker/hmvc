<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>

<div id = "list_member" style="/*display: none;*/">  
    <article class="module width_full">
        <header><h3>Users Banned</h3></header>
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Whole Name</th>
                    <th>Actions</th> 
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
                        <a onclick="return c_ask('Are you sure you want to unban the selected record?')" href="<?php echo base_url(); ?>admin/admin_users/unbanUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>"><img id="icn_unban" src="assets/admin/images/icn_unban.png" title="Unban User Account"></a>
                        <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url(); ?>admin/admin_users/deleteUser/<?php echo $u_encrypt_count; ?>/<?php echo $user_id_hash; ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete User Account">
                        </a>
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
    </article>
</div>