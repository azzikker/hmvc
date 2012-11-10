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

<!--select all script-->
                            <script type="text/javascript">
                                $(function(){
                                    $(".checkbox_select_all").click(function(){
                                        switch(this.checked)
                                        {
                                            case true:
                                                $(".multi_delete_form").find(".checkbox_selector").attr("checked", "");
                                                break;
                                            case false:
                                                $(".multi_delete_form").find(".checkbox_selector").removeAttr("checked");
                                                break;
                                            default:
                                                return false;
                                        }
                                    });
                                    
                                    $(".checkbox_selector").click(function(){
                                        if($(".checkbox_selector:checked").length == $(".checkbox_selector").length){
                                            $(".checkbox_select_all").attr("checked", '');
                                        }
                                        else
                                        {
                                            $(".checkbox_select_all").removeAttr("checked");
                                        }
                                    });
                                });
                            </script>
<!--end all script-->

<div class = "list_member">  
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Deals Category</h3>


<!--additional tabs-->
            <ul class="tabs">
                <li><a href="admin/admin_deals_category">Current Category</a></li>
                <li><a href="admin/admin_deals_category/trashed_category_view">Trashed Category</a></li>
            </ul>
<!--end additional tabs-->


        </header>
<!--added form tag for multi delete submission-->
            <form method="POST" action="" id="multi_delete_form" class ="multi_delete_form">
<!--end added form tag-->       
        <table style="font-size: 11px" id="datagrid" style="border: 1px solid #ccc;" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Deals Category Name</th>
                    <th>
                        Actions
                        
<!---add checkbox for select all-->
                            <input type="checkbox" name="checkbox_select_all" class="checkbox_select_all" value=""/>
<!---->
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
                        <a onclick="return c_ask('Are you sure you want to delete the selected record?')" href="<?php echo base_url() . "admin/admin_deals_category/trash_deals_category/" . htmlentities($row->category_id); ?>">
                            <img id="icn_trash" src="assets/admin/images/icn_trash.png" title="Delete <?php echo htmlentities($row->category_name); ?>">
                        </a>


<!---add checkbox for individual select-->
                            &nbsp;&nbsp;&nbsp;<input type="checkbox" class="checkbox_selector" id="checkbox_selector" name="checkbox[]" value="<?php echo htmlentities($row->category_id); ?>"/>
<!---->
                    

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
<!--end form tag added-->
            </form>
<!--end of end form tag added--> 
        <div style="padding: 5px; text-align: right; margin: 2px;">
            <form action="" method="post">

<!--added button for multiple delete-->                
                <input type="button" value="Trash Selected" id="multi_delete_btn" onclick="return false">
<!--end added button-->             
                <input type="button" value="Add" onclick="showAdd()">
            </form>

<!--multi_delete_btn script-->   
        <script type="text/javascript">
            $(function(){
                $("#multi_delete_btn").click(function(){
                    $(".multi_delete_form").attr("action", "<?php echo base_url()?>admin/admin_deals_category/multi_trash_deals_category").submit();
                });
            });
        </script>
<!---->
    
   
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