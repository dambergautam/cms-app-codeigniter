
<div class="">
    <h2 class="table-caption">Fellowship Documentation</h2>

    <!-- <div> <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/docs/addEditPage"> <span class="fa fa-plus-circle"></span> Add New Page</a></div> --> 
    <table class="table table-condensed"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th>Title</th> 
                <th>Category</th> 
                <th>Target</th>
                <th>Order</th> 
                <th>Status</th>
                <th></th>
            </tr> 
        </thead> 
        <tbody> 
            <?php
            if (!empty($page_lists)) {
                foreach ($page_lists as $page) {
                    ?> 
                    <tr>    
                        <td><?php echo $page->id; ?></td>
                        <td><a href="<?php echo base_url() . 'index.php/home/docs/page/' . $page->id; ?>"><?php echo $page->page_title; ?></a></td>
                        <td><?php echo $page->category_title; ?></td>
                        <td><?php echo implode(', ', json_decode($page->target)); ?></td>
                        <td><?php echo $page->page_order; ?></td>
                        <td><?php echo $page->page_status; ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>index.php/docs/addEditPage/<?php echo $page->id; ?>"><span class="fa fa-edit"></span> </a> &nbsp;
                            <a href="<?php echo base_url(); ?>index.php/docs/deletePage/<?php echo $page->id; ?>" onclick="return confirm_delete();"><span class="fa fa-trash"></span> </a>
                        </td>
                    </tr>
                <?php }
            } else {
                echo '<tr><td colspan="6">No record found!</td></tr>';
            }
            ?>
        </tbody>
    </table>

</div>


