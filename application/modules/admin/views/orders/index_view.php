<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<link rel="stylesheet" type="text/css" href="assets/general/set/datepicker/themes/base/jquery.ui.all.css">
<link rel="stylesheet" type="text/css" href="SpryAssets/SpryMenuBarHorizontal.css" />
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.datepicker.js"></script>
<!--END OF JS-->

<div class = "list_member" style="/*display: none;*/">  
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Orders - <?php echo $this->uri->segment(4); ?> - <?php echo $this->uri->segment(5); ?></h3>
            <ul class="tabs">
                <li><a href="admin/admin_orders/index/active/<?php echo $this->uri->segment(5); ?>">Active</a></li>
                <li><a href="admin/admin_orders/index/removed/<?php echo $this->uri->segment(5); ?>">Removed</a></li>
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
                        if($(".search_item").val() == "Voucher No."){
                            return false;
                        }else{
                            $(".form_search").submit();    
                        }  
                    }
                });
            });
        </script>
            <form class="search" action="<?php echo base_url(); ?>admin/admin_orders/index/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/search" method="post" enctype="multipart/form-data">
                <input type="text" name="search_here" value="Voucher No." onfocus="search_record(this.value='')" class="search_item">
                <input class="btn_search" type="submit" name="search" value="Search">
            </form>
            <ul class="tabs">
                <li><a href="admin/admin_orders/index/<?php echo $this->uri->segment(4); ?>/all">All</a></li>
                <li><a href="admin/admin_orders/index/<?php echo $this->uri->segment(4); ?>/pending">Pending</a></li>
                <li><a href="admin/admin_orders/index/<?php echo $this->uri->segment(4); ?>/used">Used</a></li>
                <li><a href="admin/admin_orders/index/<?php echo $this->uri->segment(4); ?>/available">Available</a></li>
                <li><a href="admin/admin_orders/index/<?php echo $this->uri->segment(4); ?>/expired">Expired</a></li>
            </ul>
        </header>
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th id = "table_spacing" align="left">Voucher No.</th>
                    <th id = "table_spacing" align="left">Order ID</th>
                    <th align="left">Customer Name</th>
                    <th align="left">Purchase Date</th>
                    <th align="left">Expiration Date</th>
                    <th align="left">Order Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id = 'info_grid'>
<?php $m = "m"; $d = "d"; $y = "Y"; ?> 
<?php foreach($sql as $row) : ?>
                <tr>
                    <td id = "table_spacing"><?php echo $row->voucher_no; ?></td>
                    <td id = "table_spacing"><?php echo strtoupper(substr($row->order_txn, 0, 10)); ?></td>
                    <td><?php echo $row->customer_lastname . ", " . $row->customer_firstname; ?></td>
                    <td><?php echo date($m . "/" . $d . "/" . $y, strtotime(date($m . "/" . $d . "/" . $y, $row->order_date) . " - 2 days")); ?></td>
                    <td><?php echo date($m . "/" . $d . "/" . xss_cleaner($y, $row->order_date)); ?></td>
                    <td><?php echo ucfirst($row->order_status); ?></td>
                    <td align="center">
                        <a href="admin/admin_orders/information/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $row->order_id; ?>"><img id="icn_view" src="assets/admin/images/icn_search.png" title="View Information"></a>
                        <a href="admin/admin_orders/manage/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $row->order_id; ?>"><img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Manage Order"></a>
<?php if($this->uri->segment(4) != "removed") : ?>
                        <a onclick="return c_ask('Are you sure you want to remove the selected record?')" href="admin/admin_orders/remove/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $row->order_id; ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Remove Order">
                        </a>
<?php else : ?>
                        <a onclick="return c_ask('Are you sure you want to restore the selected record?')" href="admin/admin_orders/restore/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $row->order_id; ?>">
                            <img id="icn_renew" src="assets/admin/images/icn_renew.png" title="Restore Order">
                        </a>
<?php endif ?>
                    </td>
                </tr>
<?php endforeach ?>
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
    </article>
</div> 