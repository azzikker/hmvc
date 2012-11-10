<!--START OF CSS-->
<link rel="stylesheet" type="text/css" href="assets/general/set/jtps/jtps.css">
<link rel="stylesheet" type="text/css" href="assets/admin/set/HoverLightbox/css/horizontal.css">
<!--END OF CSS-->
<!--START OF JS-->
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/general/set/jtps/jtps.js"></script>
<script type="text/javascript" src="assets/admin/js/datagrid.js"></script>
<script type="text/javascript" src="assets/admin/set/HoverLightbox/js/lightbox.js"></script>
<!--END OF JS-->

<!--multi button functions-->        
            <script type="text/javascript">

    		$(function(){
    			$("#submit_restore_trash").click(function(){
    			     $("#multi_restore_form").attr("action", "<?php echo base_url()?>admin/admin_deals_category/multi_restore_deals_category")
   				     $("#multi_restore_form").submit();
    			});
                $("#submit_multi_perma_delete_trash").click(function(){
                    $("#multi_restore_form").attr("action", "<?php echo base_url()?>admin/admin_deals_category/multi_delete_category")
                    $("#multi_restore_form").submit();
                });
    		});
    	   </script>
<!--end multi button functions-->
          
<!--select all script-->
           <script>
                $(function(){
                    $(".checkbox_select_all").click(function(){
                        switch(this.checked)
                                        {
                                            case true:
                                                $(".multi_restore_form").find(".checkbox_selector").attr("checked", "");
                                                break;
                                            case false:
                                                $(".multi_restore_form").find(".checkbox_selector").removeAttr("checked");
                                                break;
                                            default:
                                                return false;
                                        }
                    });
                    
                    $(".checkbox_selector").click(function(){
                                    if($(".checkbox_selector:checked").length == $(".checkbox_selector").length){
                                        $(".checkbox_select_all").attr("checked", '');
                                    }else{
                                        $(".checkbox_select_all").removeAttr("checked");
                                    }
                                });
                    
                });
           </script>
<!--end select all script-->

<div class = "list_member">  
    <article class="module width_full">
    <!--yown oh
        <header>
            <h3 class="tabs_involved">Deals - <?php //echo  ucwords($this->uri->segment(4)); ?></h3>
            <ul class="tabs">
                <li><a href="admin/admin_deals/index/current">Current Deals</a></li>
                <li><a href="admin/admin_deals/index/future">Future Deals</a></li>
                <li><a href="admin/admin_deals/index/past">Past Deals</a></li>
            </ul>
        </header>
    yown oh-->
        <!--<header><h3>Deals Category</h3></header>-->
        <header>
            <h3 class="tabs_involved">Deals Category - Trashed</h3>
                <ul class="tabs">
                    <li><a href="admin/admin_deals_category">Current Category</a></li>
                    <li><a href="admin/admin_deals_category/trashed_category_view">Trashed Category</a></li>
                </ul>
        </header>
        
<!--form selector-->
        <form method="post" action="" id="multi_restore_form" class="multi_restore_form">
<!--end form selector-->

        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Deals Category Name</th>
                    <th>Actions
<!--add checkbox for select all-->
                    <input type="checkbox" name="checkbox_select_all" class="checkbox_select_all" value=""/>
<!--end add checkbox-->                       
                    </th>
                </tr>
            </thead>  
            <tbody id = 'info_grid'>
    
        <?php foreach($sql as $row): ?>
                    <tr align="center" title="<?php echo htmlentities($row->category_name); ?>">
                        <td><?php echo htmlentities($row->category_name); ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>admin/admin_deals_category/edit_category/<?php echo htmlentities($row->category_id); ?>">
                                <img id="icn_edit" src="assets/admin/images/icn_edit.png" title="Edit <?php echo htmlentities($row->category_name); ?>">
                            </a>
                            <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url() . "admin/admin_deals_category/delete_category/" . htmlentities($row->category_id); ?>">
                                <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete <?php echo htmlentities($row->category_name); ?>">
                            </a>
                            <a onclick="return c_ask('Are you sure you want to restore the selected record?')" href="<?php echo base_url() . "admin/admin_deals_category/restore_deals_category/" . htmlentities($row->category_id); ?>">
                                <img id="icn_restore" src="assets/admin/images/icn_renew.png" title="Restore <?php echo htmlentities($row->category_name); ?>">
                            </a>
                            &nbsp;&nbsp;&nbsp;<input type="checkbox" class="checkbox_selector" name="checkbox[]" value="<?php echo htmlentities($row->category_id); ?>"/>
                        </td>
                    </tr>
        <?php endforeach ?>  
             
            </tbody>
            <tfoot class="nav">
                <tr>
                    <td colspan="7">
                        <div class="pagination"></div>
                        <div class="paginationTitle">Page</div>
                        <div class="selectPerPage"></div>
                        <div class="status"></div>
                    </td>
                </tr>
            </tfoot>
        </table>
<!--end form selector-->
        </form>
<!--end of end form selector-->

        <div style="padding: 5px; text-align: right; margin: 2px;">
            <!--removed add button from trashed tab
            <form action="" method="post"><input type="button" value="Add" onclick="showAdd()"></form>
            -->
        </div> 
        <div style="padding: 5px; text-align: right; margin: 2px;">

            <input type="button" value="Restore Selected" id="submit_restore_trash" onclick="return false"/>
            <!--removed permanent delete
                <input type="button" value="PermaDelete Selected" id="submit_multi_perma_delete_trash" onclick="return false">
            end removed permanent delete-->
        </div>  
    </article>
</div>
<div class = "add_member" style="display: none;">
<form action="<?php echo base_url(); ?>admin/admin_deals_category/save_category" method="post"  enctype="multipart/form-data">
    <article class="module width_full">
        <header><h3>Add Category</h3></header>
            <div style="margin: 20px;">
                <fieldset>
                    <label>Category Name</label>
                    <input type="text" name="addDCN" value="" maxlength="20">
                </fieldset>
                <div style="text-align: right;">        
                    <input type="button" value="Back" onclick="showList()">
                    <input class="alt_btn" type="submit" name="save" value="Save"/>
                </div>
            </div>
    </article>
</form>
</div>