<section class="homepage">


    <div>
        <?php
        if (isset($alert_lists) && is_array($alert_lists)) {
            ?>
        
        <h3 class="table-caption">Current Issues</h3>

            <table class="table table-condensed"> 
                
                <thead> 
                    <tr> 
                        <th>#</th> 
                        <th>Title</th> 
                        <th>URL</th> 
                        <th>Risk</th> 
                        <th>Flag</th>
                        <th>Description</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <?php foreach($alert_lists as $alert) { ?>
                    <tr> 
                        <th scope="row"><?php echo $alert->id; ?></th> 
                        <td><a href="<?php echo base_url().'index.php/admin/alert_detail/'.$alert->id;?>" class="alert-title"><span class="fa fa-eye"></span> <?php echo $alert->classification;?></a></td> 
                        <td><?php echo $alert->resource;?></td> 
                        <td><?php echo $alert->risk;?> </td>
                        <td><?php echo $alert->flag;?> </td>
                        <td><?php echo $alert->description;?> </td>
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

</section>