<section class="homepage">


    <div id="doc_pages">


        <h3 class="table-caption">Project Documentation</h3>

        <!-- No content -->
        <?php
        if (empty($categories)) {
            echo "<div class='no_docs_content'> <span class='fa fa-frown-o'></span> <br /> There is no content to show!</div>";
        } else {
            ?>

        

            <div class="row">
                <!-- Menu/Section  -->
                <div class="col-md-3 page_category">
                    
                    <aside class="sidebar">
                        <div id="leftside-navigation" class="nano">
                            <?php echo $accordion_menu; ?>
                            
                        </div>
                    </aside>
                </div>

                <!-- Body -->
                <div class="col-md-9">
                    
                    <?php if(!empty($page_data)){ ?>
                        <div class="row page-breadcrumb">
                            <div class="col-md-8">
                                <?php echo $page_data->breadcrumb; ?>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="txt_search_docs" placeholder="Search docs">
                            </div>
                        </div>
                    <?php } ?>
                    
                    <div class="page_content">

                        <?php if(!empty($page_data)){ ?>
                        
                        <h1 class="page-heading"><?php echo $page_data->title; ?></h1>
                        
                        <div class="page-body">
                            <?php echo $page_data->content;?>
                        </div>
                        
                        <?php if(!empty($page_data->last_update)) { ?>
                        <div class="page-footer">
                            <?php echo $page_data->last_update;?>
                        </div>
                        <?php } ?>
                        
                        <?php }else { echo '<h1 style="text-align:center;">No page selected!</h1>'; }?>

                    </div>
                </div>
            </div>
        <?php } ?>

        <div style="clear: both;"></div>
    </div>

</section>