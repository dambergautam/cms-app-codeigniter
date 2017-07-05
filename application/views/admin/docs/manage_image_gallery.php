
<div id="upload">

    <form class="form-add-gallery" name="frm_add_img" method="post" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/docs/processAddGallery">

        <h2 class="table-caption">Upload Images</h2>
        <div class="row">

            <div class="col-md-4 col-sm-12">                    
                <label for="file-upload" class="custom-file-upload form-control">
                    <i class="fa"></i> <span id="selected_filename"><u>Browse your file...</u></span>
                </label>
                <input type="file" id="file-upload" class="form-control" required name="userfile" size="20" />
            </div>

            <div class="col-md-4 col-sm-12">
                <input type="text" name="txt_title" value="" placeholder="Title" class="form-control">
            </div>

            <div class="col-md-4 col-sm-12">
                <button name="btn" type="submit" class="btn btn-primary form-control"> <i class="fa fa-cloud-upload"></i> Upload</button>
            </div>

        </div>
    </form>
</div>

<br />
<div id="listgallery">
    <h2 class="table-caption">Image Gallery</h2>

    <?php
    if (isset($allImages) && is_array($allImages)) {
        foreach ($allImages as $img) {
            ?>
            <div class="gallery">
                <div style="position: relative;">
                    <a target="_blank" href="<?php echo $img->fullpath; ?>" data-toggle="tooltip" title="<?php echo $img->img_title; ?>">
                        <img src="<?php echo $img->fullpath; ?>" width="180" height="180">
                    </a>

                    <div class="desc"><?php echo $img->title_trimmed; ?></div>
                    <div class="image_delete"><a onclick="return confirm_delete();" href="<?php echo base_url(); ?>index.php/docs/deleteGallery/<?php echo $img->id; ?>"><span class="fa fa-trash-o"></span></a></div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No record found!";
    }
    ?>

    <div style="clear: both;"></div>


</div>
