
<div class="">

    <div>
        <?php
        if (isset($alert_lists) && is_array($alert_lists)) {
            ?>
            <h3 class="table-caption">Current Issues</h3>
            <!-- <div> <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/admin/alert_add"> <span class="fa fa-plus-circle"></span> Add Alert</a></div>   -->
            <table class="table table-condensed"> 
                <thead> 
                    <tr> 
                        <th>#</th> 
                        <th>Title</th> 
                        <th>URL</th> 
                        <th>Risk</th> 
                        <th>Flag</th>
                        
                        <th></th>
                    </tr> 
                </thead> 
                <tbody> 
                    <?php foreach ($alert_lists as $alert) { ?>
                        <tr> 
                            <th scope="row"><?php echo $alert->id; ?></th> 
                            <td><a href="<?php echo base_url() . 'index.php/admin/alert_detail/' . $alert->id; ?>" class="alert-title"><span class="fa fa-eye"></span> <?php echo $alert->classification; ?></a></td> 
                            <td><?php echo $alert->resource; ?></td> 
                            <td><?php echo $alert->risk; ?> </td>
                            <td><?php echo $alert->flag; ?> </td>
                            
                            <td style="width: 50px;">
                                <a href="<?php echo base_url() . 'index.php/admin/alert_edit/' . $alert->id; ?>"><span class="fa fa-edit"></span> </a> &nbsp;
                                <a href="<?php echo base_url() . 'index.php/admin/alert_delete/' . $alert->id; ?>" onclick="return confirm_delete();"><span class="fa fa-trash"></span> </a>
                            </td>
                        </tr> 
                    <?php } ?>
                </tbody> 
            </table> 

            <?php
        } else {

            echo "<div style='text-align:center;'>No record found!</div>";
        }
        ?>
    </div>

</div>
