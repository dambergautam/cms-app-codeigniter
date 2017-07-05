<?php
/**
 * Link/menu highlight
 */
$seg1 = ($this->uri->segment(1) != FALSE)? strtolower($this->uri->segment(1)): '';
$seg2 = ($this->uri->segment(2) != FALSE)? strtolower($this->uri->segment(2)): '';
$seg3 = ($this->uri->segment(3) != FALSE)? strtolower($this->uri->segment(3)): '';

//Dashboard
$seg_dashboard = ($seg1 == 'admin' && ($seg2 == '' || $seg2 == 'index'))? true : false;

//Documentation
$seg_docs = ($seg1 == 'docs' && ($seg2 == '' || $seg2 == 'index'))? true : false;
$seg_addeditpage = ($seg1 == 'docs' && $seg2 == 'addeditpage')? true : false;
$seg_pagecategory = ($seg1 == 'docs' && $seg2 == 'pagecategory')? true : false;
$seg_imagegallery = ($seg1 == 'docs' && $seg2 == 'imagegallery')? true : false;

//Alerts

$seg_alerts = ($seg1 == 'admin' && $seg2 == 'alerts')? true : false;
$seg_alert_addedit = ($seg1 == 'admin' && ($seg2 == 'alert_add' || $seg2 == 'alert_edit'))? true : false;

//Upload image
$seg_uploadimage = ($seg1 == 'admin' && $seg2 == 'uploadimage')? true : false;

//Backup
$seg_backup = ($seg1 == 'admin' && $seg2 == 'backup')? true : false;
?>

<aside class="sidebar">
    <div id="leftside-navigation" class="nano">
        <ul class="nano-content">
            <li class="<?php echo ($seg_dashboard)?'active':''; ?>" >
                
                <a href="<?php echo base_url();?>index.php/admin/"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            
            <li class="sub-menu <?php echo ($seg1 == 'docs')?'active':''; ?>">
                <a href="javascript:void(0);"><i class="fa fa-file-text-o"></i><span>Documentation</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>

                    <li class="<?php echo ($seg_docs)?'active':''; ?>" >
                        <a href="<?php echo base_url();?>index.php/docs">Pages</a>
                    </li>
                    <li class="<?php echo ($seg_addeditpage)?'active':''; ?>">
                        <a href="<?php echo base_url();?>index.php/docs/addEditPage">Add New Page</a>
                    </li>
                    <li class="<?php echo ($seg_pagecategory)?'active':'';?>">
                        <a href="<?php echo base_url();?>index.php/docs/pageCategory">Manage Category</a>
                    </li>
                    <li class="<?php echo ($seg_imagegallery)?'active':'';?>">
                        <a href="<?php echo base_url();?>index.php/docs/imageGallery">Manage Gallery</a>
                    </li>

                </ul>
            </li>
            <li class="sub-menu <?php echo ($seg_alerts || $seg_alert_addedit)? 'active' : '';?>">
                <a href="javascript:void(0);"><i class="fa fa-warning"></i><span>Security Vulnerabilities</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li class="<?php echo ($seg_alerts)?'active':''; ?>">
                        <a href="<?php echo base_url();?>index.php/admin/alerts">Current Issues</a>
                    </li>

                    <li class="<?php echo ($seg_alert_addedit)?'active':''; ?>">
                        <a href="<?php echo base_url();?>index.php/admin/alert_add">Add New Issue</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($seg_uploadimage)? 'active' : ''; ?>" >
                <a href="<?php echo base_url();?>index.php/admin/uploadImage"><i class="fa fa fa-image"></i><span>Upload Mockups (Landing)</span></a>
            </li>

            <li class="<?php echo ($seg_backup)? 'active' : '';?>">
                <a href="<?php echo base_url();?>index.php/admin/backup"><i class="fa fa-database"></i><span>Backup Database</span></a>
            </li>

        </ul>
    </div>
</aside>