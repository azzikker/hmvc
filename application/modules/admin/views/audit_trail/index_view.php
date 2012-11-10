<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>

<link rel="stylesheet" type="text/css" href="assets/general/set/datepicker/themes/base/jquery.ui.all.css">
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="assets/general/set/datepicker/ui/jquery.ui.datepicker.js"></script>

<script type="text/javascript">
    $(function() { $( "#datepicker1" ).datepicker({ changeMonth: true, changeYear: true}); });
</script>
<!--END OF JS-->

<?php $m = "F"; $d = "d"; $y = "Y"; $h = "g"; $M = "i"; $s = "s"; $A = "A"; ?>
<div class = "list_member" style="/*display: none;*/">  
    <article class="module width_full">
        <header><h3>Audit Trail</h3></header>
        <header>
            <form class="search" action="<?php echo base_url(); ?>admin/admin_audit" method="post" enctype="multipart/form-data">
                <input id="datepicker1" type="text" name="search_here" value="<?php echo $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6); ?>" onchange="seach_audit(this.value)">
            </form>
        </header>
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr align="left">
                    <th id = "table_spacing" align="left">Date</th>
                    <th id = "table_spacing" align="left">Form</th>
                    <th id = "table_spacing" align="left">Sub Form</th>
                    <th id = "table_spacing" align="left">Record</th>
                    <th id = "table_spacing" align="left">Action</th>
                    <th id = "table_spacing" align="left">User</th>
                </tr>
            </thead>  
            <tbody id = 'info_grid'>
<?php foreach($sqlA as $rowA) : $level["level_id"] = $rowA->user_level; ?>
<?php $sql0 = $this->db->get_where("user_level", $level); ?>
<?php foreach($sql0->result() as $row0) : $user_level = ucwords($row0->level_name); endforeach ?>
                <tr align="left">
                    <td id = "table_spacing" align="left"><?php echo date("m/" . $d . "/" . $y . " - " . $h . " : " . $M . " : " . $s ." " . $A, xss_cleaner($rowA->audit_date)); ?></td>
                    <td id = "table_spacing" align="left"><?php echo xss_cleaner($rowA->audit_form); ?></td>
                    <td id = "table_spacing" align="left"><?php echo xss_cleaner($rowA->audit_subform); ?></td>
<?php if($rowA->audit_form == "Payment Due"): ?>
<?php $sql = $this->Audit_Trail_Model->displaySelectedPayment("deal_view", xss_cleaner($rowA->audit_record)) ?>
<?php if($sql->num_rows()==0) : ?>
                    <td id = "table_spacing" align="left"><span id="red">The record has been deleted</span></td>
<?php else : ?>
<?php foreach($sql->result() as $row) : $record_name = shortenString(xss_cleaner($row->company_name), 30); ?>
                    <td id = "table_spacing" align="left">
                        <span><?php echo $record_name[0]; ?></span>
<?php if($this->session->userdata('user_level') == 1 || $this->session->userdata('user_level') == 0) : ?>
                        <span><a id="green" onclick="return c_view('<?php echo payment_summary_view(xss_cleaner($row->company_name), xss_cleaner($row->deal_view_title), date("m/" . $d . "/" . $y, strtotime(date("m/" . $d . "/" . $y, htmlentities($row->deal_view_due)))), date("m/" . $d . "/" . $y, strtotime(date("m/" . $d . "/" . $y, htmlentities($row->date_paid)))), htmlentities($row->receipt_no), $row->account_no, htmlentities($row->bank_name)); ?>')">view more</a></span>
<?php endif ?>
                    </td>
<?php endforeach ?>
<?php endif ?>
<?php elseif($rowA->audit_form == "Companies Maintenance"): ?>
                    <td id = "table_spacing" align="left"><span><?php echo $rowA->audit_record; ?></span></td>
<?php elseif($rowA->audit_form == "Deals Maintenance" || $rowA->audit_form == "Deals Category Maintenance" || $rowA->audit_form == "User Maintenance" || $rowA->audit_form == "Users Unconfirmed" || $rowA->audit_form == "Users Banned"): ?>
<?php $record_name = shortenString($rowA->audit_record, 30); ?>
<?php if($rowA->audit_subform == "Add New Sub Deal" || $rowA->audit_subform == "Update Sub Deal" || $rowA->audit_subform == "Delete Sub Deal"): ?> 
                    <td id = "table_spacing" align="left"><span><?php echo $rowA->audit_record; ?></span></td>
<?php else : ?>
                    <td id = "table_spacing" align="left"><span><?php echo $record_name[0]; ?></span></td>
<?php endif ?>
<?php elseif($rowA->audit_form == "Vouchers/Orders Maintenance" || $rowA->audit_form == "Deals Category Maintenance"): ?>
                    <td id = "table_spacing" align="left"><span>Order ID [ <span id="blue"><?php echo str_replace("10", "", printf("%010s", $rowA->audit_record)); ?></span> ]</span></td>
<?php elseif($rowA->audit_form == "Web Settings") : ?>
                    <td id = "table_spacing" align="left"><span><?php echo $rowA->audit_record; ?></span></td>
<?php else : ?>
                    <td id = "table_spacing" align="left">none</td>
<?php endif ?>
                    <td id = "table_spacing" align="left"><span><?php echo xss_cleaner($rowA->audit_action); ?></span></td>
                    <td id = "table_spacing" align="left"><span><a id="green" onclick="return c_view('<?php echo profile_summary_view($rowA->user_name, $user_level, $rowA->user_lastname, $rowA->user_firstname, $rowA->user_middlename, $rowA->user_email, $rowA->user_no, $rowA->user_member_date); ?>')"><?php echo $rowA->user_name; ?></a></span></td>
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
