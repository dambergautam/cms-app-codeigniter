<section class="homepage">


    <div id="listgallery">


        <h3 class="table-caption">List of mockups</h3>

        <?php
        if (isset($images) && is_array($images)) {
        foreach ($images as $img) {
        ?>
            <div class="gallery">
                <a target="_blank" href="<?php echo $img['path']; ?>" data-toggle="tooltip" title="<?php echo $img['title']; ?>">
                    <img src="<?php echo $img['path']; ?>" width="180" height="180">
                </a>
                <div class="desc"><?php echo $img['title_trimmed']; ?></div>
            </div>
        <?php
        }
        }else{
            echo "No record found!";
        }
        ?>

        <div style="clear: both;"></div>
    </div>

</section>