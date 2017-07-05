
<div class="">
    

    <div id="upload">

        <?php echo form_open_multipart('admin/do_upload'); ?>
        <h2 class="table-caption">Upload Images</h2>
        <div class="row">
            <div class="col-md-6">
                <label for="file-upload" class="custom-file-upload">
                    <i class="fa"></i> <span id="selected_filename">Browse your file...</span>
                </label>

                <input type="file" id="file-upload" required name="userfile" size="20" />
                &nbsp; &nbsp;
                <button name="btn" type="submit" class="btn btn-primary"> <i class="fa fa-cloud-upload"></i> Upload</button>
            </div>
            <div class="col-md-6" style="border-left: 1px solid #838383;">
                <?php
                $imgArry = getAllImages();
                $imgNumb = 1;
                foreach ($imgArry as $img) {
                    echo $imgNumb . ") " . $img['title'] . " <a href='deleteImg/" . urlencode(base64_encode($img['path'])) . "' class='fa fa-trash' onclick='return confirm_delete();'></a><br />";
                    $imgNumb++;
                }
                ?>

            </div>
        </div>

        <?php echo "</form>"; ?>
    </div>
    <br />

</div>
