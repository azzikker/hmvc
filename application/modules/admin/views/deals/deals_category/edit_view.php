<div class = "edit_member">
<?php foreach($sql as $row): ?>
<form action="<?php echo base_url(); ?>admin/admin_deals_category/update_category/<?php echo $this->uri->segment(4); ?>" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <header><h3>Edit Category</h3></header>
            <div style="margin: 20px;">
                <fieldset>
                    <label>Deal Category Name</label>
                    <input type="text" name="editDCN" value="<?php echo htmlentities($row->category_name); ?>" maxlength="20" required="required">
                </fieldset>
                <div style="text-align: right;">        
                    <input type="button" value="Back" onclick="window.history.back();">
                    <input class="alt_btn" type="submit" name="update" value="Update"/>
                </div>
            </div>
    </article>
</form>
<?php endforeach ?>
</div>