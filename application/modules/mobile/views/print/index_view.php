<div id="vouch-c" style="width: 652px;">
    <style>
/* new vouchers */
#vouch
{
    width: 700px;
    height: 990px;
    padding: 5px;
    overflow: hidden;
    position: relative;
}
#vouch-c
{
    background: white;
    margin-top: 20px;
    border: 1px solid #e4e4e4; 
    overflow: auto;
}
.vouch-cont
{
    width: 325px;
    float: left;
    min-height: 800px;
    color: #d5d5d5;
    font-family: arial;
    font-size: 10px;
    font-weight: bold;
    position: relative;
}
.vouch-cont div
{
    padding: 5px;
    overflow: auto;
}
.vouch-cont span
{
    color: black;
    font-size: 12px;
}
.vouch-cont.tl,.vouch-cont.bl
{
    border-right: 1px dashed gray;
}
#vouch-help span
{
    font-size: 10px;
}
.vouch-cont.bl span
{
    font-weight: normal;
}
.vouch-cont.bl li
{
    list-style-type: square;
}
#vouch-print
{
    position: absolute;
    top:0px;
    left: 0px;
    right: 0px;
    text-align: right;
    background: rgba(0, 0, 0, 0.4);
    margin-top: 20px;
    overflow: hidden;
    height: 0px;
}
/* new vouchers */
</style>
    <!--TOP LEFT-->
    <div class="vouch-cont tl">
        <img src = "<?php echo base_url(); ?>assets/vigattin_deals/images/voucher-h.png" alt = "" style="margin-left: 17px; margin-top: 18px; margin-bottom: 10px;">
        <div style="text-align: center; margin-bottom: 15px;">
            <img src="<?php echo base_url(); ?>assets/general/images/deals_gallery/customize/<?php echo $print->gallery_filename ?>" alt="" width="275px">
        </div>
        <div style="padding-left: 15px; padding-right: 15px;">
        Fine Print<br />
        <span>
<?php $fp = $this->deals_model->get_where(array("deal_id"=>$print->deal_id))->row("deal_subhash") ?>
<?php $fp = $this->deals_term_model->get_where(array("deal_subhash"=>$fp))->result(); ?>
<?php foreach($fp as $fp): ?>
        <li><?php echo $fp->fineprint_content ?></li>
<?php endforeach; ?>
        </span>
        </div>
        <div style="padding-left: 15px; padding-right: 15px;">
            Terms & Conditions<br />
            <span>
            <li>Voucher is transferrable and may be given as gift.</li>
            <li>Price is inclusive of service charge and VAT.</li>
            <li>All paid transactions are non-refundable. Voucher cannot be used in conjunction with senior citizen card, and any discount card or promotion.</li>
            <li>Voucher is valid as a discount coupon.</li>
            <li>Merchant requires voucher holders to make reservations at least 1 day prior to redemption.</li>
            <li>Cancellation of pick-up must be made at least a day prior to set appointment.</li>
            <li>Failure to cancel reservations/redeem vouchers within validity period will render the voucher invalid.</li>
            <li>Promo Hours: Monday to Saturday, 10:00AM to 5:00PM</li>
            <li>Voucher is not valid on holidays or other special occasions.</li>
            </span>
        </div>
    </div>
    <!--TOP LEFT-->
    <!--TOP RIGHT-->
    <div class="vouch-cont tr"  style="padding-left: 10px;padding-right: 10px; width: 305px;">
        <div style="text-align: center; margin-top: 10px;">
<?php $num = md5("$print->voucher_no"); ?>
<?php $bc = new $this->bc($num); ?>
<?php $bc->barcode_text_size = 1; ?>
<?php $bc->barcode_bar_thick = 1; ?>
<?php $bc->barcode_bar_thin = 0.5; ?>
<?php $bc->draw("assets/general/images/orders/$num.gif"); ?>
            <img src="<?php echo base_url(); ?>assets/general/images/orders/<?php echo "$num" ?>.gif" alt="">
        </div>
        <div style="margin-top: 10px; margin-bottom: 15px;">
            DEAL TITLE<br />
            <span style="font-size: 16px;"><?php echo $print->deal_title ?></span>
        </div>
        <div style="margin-bottom: 15px;">
            COMPANY<br />
            <span style="font-size: 16px;"><?php echo $print->company_name ?></span>
        </div>
        <div>
            PURCHASED BY<br />
            <span style="font-size: 16px;"><?php echo $this->session->userdata("vigdeals_login_name") ?></span>
        </div>
        <div>
            CUSTOMER ID<br />
            <span style="font-size: 16px;"><?php echo $this->session->userdata("vigattin_id") ?></span>
        </div>
        <div>
            VOUCHER ID<br />
            <span style="font-size: 16px;"><?php echo $print->voucher_no ?></span>
        </div>
        <div style="clear: both;"></div>
        <div>
            VALID FROM<br />
            <span style="font-size: 16px;"><?php echo date("M. d, Y", $print->order_date) ?>  &nbsp;&nbsp;to&nbsp;&nbsp; <?php echo date("M. d, Y", $print->order_date+2160000) ?></span>
        </div>
        <div>
            LOCATION<br />
<?php $loc = $this->deals_location_model->get_where(array("location_id"=>$print->location_id))->row("location_address"); ?>
            <span style="font-size: 16px;"><?php echo $loc ?></span>
        </div>
        <div>
            <div id="vouch-help">
                How to use this:
                <br>
                <span>1. Print Voucher</span>
                <br>
                <span>2. Please provide your voucher numbers upon reservation and present your VigDeals voucher upon arrival at the establishment.</span>
                <br>
                <span>3. Enjoy!</span>
            </div>
        </div>
        <div style="color: black;font-size: 12px;border: 1px solid gray;width: 290px;border:solid 1px gray;-moz-border-radius-topleft: 5px;-moz-border-radius-topright:5px;-moz-border-radius-bottomleft:5px;-moz-border-radius-bottomright:5px;-webkit-border-top-left-radius:5px;-webkit-border-top-right-radius:5px;-webkit-border-bottom-left-radius:5px;-webkit-border-bottom-right-radius:5px;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;">
            Need Assistance?<br />
            Call: 09272121212 | Email: support@vigattin.org
        </div>
    </div>
    <!--TOP RIGHT-->
    </div>
    <div id="vouch-print">
    <img src="assets/vigattin_deals/images/print.png" style="width: 45px;margin-right: 10px;margin-top: 4px;" id="printimg">
    <a href="order"><img src="assets/vigattin_deals/images/back.png" style="position: absolute; left: 10px; top: 15px; width: 40px;" id="backimg"></a>
    </div>
</div>