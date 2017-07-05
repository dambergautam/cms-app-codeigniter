<div id="manage_category">

    <form class="form-add-category" name="frm_add_category" method="post" action="<?php echo base_url(); ?>index.php/docs/processCategory">

        <h2 class="table-caption"><?php echo ucfirst($category_action);?> Category</h2>
        
        <div class="row">
            <div class="col-md-4 col-sm-12">Category Title <label>*</label></div>
            <div class="col-md-4 col-sm-12">
                <input type="text" name="txt_title" placeholder="Category Title" class="form-control" 
                       value="<?php echo set_value('txt_title', isset($category_detail->category_title) ? 
                                    $category_detail->category_title : set_value('category_title')); ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 col-sm-12">Category Description</div>
            <div class="col-md-4 col-sm-12">
                <input type="text" name="txt_desc" placeholder="Category Description" class="form-control"
                    value="<?php echo set_value('txt_desc', isset($category_detail->description) ? 
                                 $category_detail->description : set_value('txt_desc')); ?>">
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-md-4 col-md-offset-4 col-xs-12">
                <input type="hidden" value="<?php echo $category_action; ?>" name="hdn_category_action">
                <input type="hidden" value="<?php echo (isset($category_detail->id)) ? $category_detail->id : ''; ?>" name="hdn_category_id">
            
                <button name="btn" type="submit" class="btn btn-primary form-control"> <?php echo ucfirst($category_action);?> </button>
            </div>

        </div>
    </form>
</div>

<br />
<div>
    <h2 class="table-caption">List of Category</h2>

    <table class="table table-condensed"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th>Title</th> 
                <th>Description</th> 
                <th></th>
            </tr> 
        </thead> 
        <tbody> 
            <?php
            if (!empty($category_lists)) {
                foreach ($category_lists as $category) {
                    ?> 
                    <tr>    
                        <td><?php echo $category->id; ?></td>
                        <td><?php echo $category->category_title; ?></td>
                        <td><?php echo $category->description; ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>index.php/docs/pageCategory/<?php echo $category->id; ?>"><span class="fa fa-edit"></span> </a> &nbsp;
                            <a href="<?php echo base_url(); ?>index.php/docs/categoryDelete/<?php echo $category->id; ?>" onclick="return confirm_delete();"><span class="fa fa-trash"></span> </a>
                        </td>
                    </tr>
                <?php }
            } else {
                echo '<tr><td colspan="6">No record found!</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div style="clear: both;"></div>


</div>
