<?php
$this->load->view('include/header');
    ?>

    <section class="adminpage">

        <?php
        $showMsg = false;
        if (count($this->session->flashdata()) > 0) {
            $showMsg = true;
            $key = $this->session->get_flash_keys()[0];
            $msg = $this->session->flashdata($this->session->get_flash_keys()[0]);
        } else if (validation_errors() != false) {
            $showMsg = true;
            $key = 'error_msg';
            $msg = validation_errors();
        }

        if ($showMsg) {
            echo "<div class='message'>";
            echo "<div class='" . $key . "'>";
            echo $msg;
            echo "</div></div>";
        }
        ?>


        <div class="row">
            <!-- Menu/Section  -->
            <div class="col-md-3" id="doc_pages">
                <?php $this->load->view('admin/inc_accordion_menu');?>
            </div>

            <!-- Page body -->
            <div class="col-md-9">
                <div style="background-color: #EBEFDD; border-radius: 4px; padding: 5px; min-height: 400px;">
                <?php $this->load->view($pagename); ?>
                </div>
            </div>
            
            <div class="clearfix"></div>
        </div>
        
    </section>
    <div class="clearfix"></div>
    
    <?php
$this->load->view('include/footer');
?>