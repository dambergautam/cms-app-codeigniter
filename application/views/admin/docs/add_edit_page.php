<h3 class="table-caption"><?php echo ucfirst($page_action); ?> Page</h3>

<form class="form-add-alerts legend-left" name="frm_add_new_page" method="post" action="<?php echo base_url(); ?>index.php/docs/processAddEditPage">

    <!-- Page category -->
    <div class="row">
        <div class="col-md-3">Page Category <label>*</label></div>
        <div class="col-md-9">
            <select class="form-control select2" id="page_category" name="cat_id" required autofocus>
                <option value="" disabled="" selected=""> -- Select -- </option>
                <?php foreach ($page_categories as $category) { ?>
                    <option value="<?php echo $category->id; ?>" <?php echo (isset($page_details->cat_id) && ($page_details->cat_id == $category->id)) ? 'selected' : set_select('cat_id', $category->id); ?>><?php echo $category->category_title; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col-md-2">Sub-Category</div>
        <div class="col-md-9">
            <select class="form-control select2" name="page_sub_category" id="page_sub_category" required>
                
    <!-- 
    <?php // foreach($page_sub_categories as $subcategory) { ?>
    <option value="<?php // echo $subcategory->id; ?>" <?php //echo set_select('page_sub_category', $subcategory->id);  ?>><?php //echo $subcategory->subcategory_title; ?></option>
    <?php // } ?>
    
</select>
</div>
</div>
    -->

    <!-- Page Title -->
    <div class="row">
        <div class="col-md-3">Page Title <label>*</label></div>
        <div class="col-md-9">
            <input type="text" id="page_title" name="page_title" 
                   value="<?php echo set_value('page_title', isset($page_details->page_title) ? $page_details->page_title : set_value('page_title')); ?>" 
                   class="form-control" placeholder="Page Title" required>
        </div>
    </div>

    <!-- Target -->
    <div class="row">
        <div class="col-md-3">Target <label>*</label></div>
        <div class="col-md-9">
            <select class="form-control select2" name="target[]" multiple="multiple" required>                    
                <?php
                foreach ($targets as $t_value => $t_text) {

                    $multiselect = isset($page_details->target) && in_array($t_value, json_decode($page_details->target)) ? 'selected' : set_select('target[]', $t_value);

                    echo "<option value='" . $t_value . "' " . $multiselect . " >" . $t_text . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- Status -->
    <div class="row">
        <div class="col-md-3">Status <label>*</label></div>
        <div class="col-md-9">
            <select class="form-control select2" name="page_status" required>
                <option selected value="active">Active</option>
                <option value="hold" <?php echo (isset($page_details->page_status) && $page_details->page_status == "hold") ? 'selected' : set_select('page_status', 'hold'); ?>>Hold</option>
            </select>
        </div>
    </div>

    <!-- Tags -->
    <div class="row">
        <div class="col-md-3">Tag</div>
        <div class="col-md-9"><input type="text" id="tag" name="tag" value="<?php echo set_value('tag', isset($page_details->tag) ? $page_details->tag : set_value('tag')); ?>" class="form-control" placeholder="Tag"></div>
    </div>


    <!-- Page order -->
    <div class="row">
        <div class="col-md-3">Page Order</div>
        <div class="col-md-9"><input type="text" id="page_order" name="page_order" value="<?php echo set_value('page_order', isset($page_details->page_order) ? $page_details->page_order : set_value('page_order')); ?>" class="form-control" placeholder="Page Order"></div>
    </div>

    <!-- Page content -->
    <div class="row">
        <!-- <div class="col-md-3">Page Content <label>*</label></div> -->
        <div class="col-md-12" style="padding-right: 15px;"> <textarea name="content" required id="editor_page_content" rows="7" class="form-control"><?php echo (isset($page_details->content)) ? $page_details->content : set_value('content'); ?></textarea></div>
    </div>

    <!-- Buttons and hidden fields -->
    <div class="row">

        <div class="col-md-6">
            <input type="hidden" value="<?php echo $page_action; ?>" name="hdn_page_action">
            <input type="hidden" value="<?php echo (isset($page_details->id)) ? $page_details->id : ''; ?>" name="hdn_page_id">
            <button style="width: 48%; float: right; margin-top: 5px;" class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
            <a style="width: 50%; float: left;" class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>index.php/docs">Cancel</a>
        </div>
    </div>


</form>
