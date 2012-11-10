<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid_min.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script> 
<!--END OF JS-->

<div class = "profile_member">
<?php $message_count = 1; ?>
<?php $m = "m"; $d = "d"; $y = "Y"; ?>
<?php foreach($sql as $row) : ?>
<?php /*tables*/ $table1 = "invite"; ?>
<?php /*invite variables*/ $invite_where["customer_hash"] = htmlentities($row->customer_hash); ?>
<?php $sql1 = $this->Invite_Model->displaySelected($table1, $invite_where); ?>
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Profile - <?php echo $row->customer_firstname . " " . $row->customer_lastname; ?></h3>
        </header>
        <div>
            <div>
                <img id="pic_profile" src="<?php echo htmlentities($row->customer_photo);?>">
            </div>
        </div> 
        <div style="margin: 20px;">
            <div align="right">
                <fieldset id="customer_fieldset">
                    <b>CUSTOMER INFORMATION</b>
                    <p><br></p>
                    <div id="customer_li"><b>Email</b></div>
                    <div class = "customer_li"><?php echo htmlentities($row->customer_email); ?><br></div>
                    <div id="customer_li"><b>First Name</b></div>
                    <div class = "customer_li"><?php echo $row->customer_firstname; ?><br></div>
                    <div id="customer_li"><b>Last Name</b></div>
                    <div class = "customer_li"><?php echo $row->customer_lastname; ?><br></div>
                    <div id="customer_li"><b>Gender</b></div>
                    <div class = "customer_li"><?php echo ucfirst(htmlentities($row->gender_name)); ?><br></div>
                    <div id="customer_li"><b>Contact No.</b></div>
                    <div class = "customer_li"><?php echo htmlentities($row->customer_no); ?><br></div>
                    <div id="customer_li"><b>Zip Postal Code</b></div>
                    <div class = "customer_li"><?php echo htmlentities($row->customer_zipcode); ?><br></div>
                    <div id="customer_li"><b>Address</b></div>
                    <div class = "customer_li"><?php echo ucfirst(htmlentities($row->customer_address)); ?><br></div>
                    <div id="customer_li"><b>City</b></div>
                    <div class = "customer_li"><?php echo ucfirst(htmlentities($row->customer_city)); ?><br></div>
                    <div id="customer_li"><b>Province</b></div>
                    <div class = "customer_li"><?php echo ucfirst(htmlentities($row->customer_province)); ?><br></div>
                </fieldset>
                <fieldset id="customer_fieldset">
                    <b>INVITED FRIENDS</b>
                    <p><br></p>
                    <table style="font-size: 11px" id="datagrid_min" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th align="left">#</th>
                                <th id = "table_spacing" align="left">Email</th>
                                <th align="left">Name</th>
                                <th align="left">Date</th>
                                <th align="left">Invited Via</th>
                                <th align="left">Status</th>
                            </tr>
                        </thead>
                        <tbody id = 'info_grid'>
<?php foreach($sql1 as $row1) : ?>
                            <tr>
                                <td><?php echo $message_count; ?></td>
                                <td id = "table_spacing"><?php echo htmlentities($row1->invited_email); ?></td>
                                <td><?php echo ucfirst($row1->invited_fname . " " . $row1->invited_lname); ?></td>
                                <td><?php echo date($m . "/" . $d . "/" . $y, htmlentities($row1->invited_date)); ?></td>
                                <td><?php echo ucfirst(htmlentities($row1->invited_via)); ?></td>
<?php $message_count=$message_count+1; ?>
<?php if(htmlentities($row1->invited_registered) == 1) : ?>
                                <td>Accepted</td>
<?php else : ?>
                                <td>Pending</td>
<?php endif ?>
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
                </fieldset>
                <fieldset id="customer_fieldset">
                    <b>CUSTOMER CREDITS</b>
                    <p><br></p>
                    <div id="customer_li"><b>Reward From Deals</b></div>
                    <div class = "customer_li"><?php echo number_format(htmlentities($row->dummygold)); ?><br></div>
                    <div id="customer_li"><b>Other Golds</b></div>
                    <div class = "customer_li"><?php echo $other_gold=0; ?></div>
                    <div id="customer_li"><b></b></div>
                    <div class = "customer_li"><hr></div>
                    <div id="customer_li" class="green"><b>Total Golds</b></div>
                    <div id="green" class = "customer_li"><?php echo number_format(htmlentities($row->dummygold+$other_gold)); ?></div>
                </fieldset>
            </div>
            <fieldset>
                <div style="padding: 5px; text-align: right; margin: 2px;">
                    <input type="button" value="Back" onclick="window.history.back();">
                </div>
            </fieldset>
        </div>
    </article>
<?php endforeach ?>
</div>