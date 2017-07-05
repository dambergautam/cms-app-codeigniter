<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Fellowship System -<?php echo $title;?></title>
        
        <link rel="shortcut icon" href="<?php echo base_url().'images/favicon.ico';?>">

        <!-- Bootstrap minified CSS -->
        <?php echo link_tag('assets/css/bootstrap.min.css'); ?>

        <!-- Custom CSS -->
        <?php echo link_tag('assets/css/style.css'); ?>
        
        <!-- fontawesome -->
        <?php echo link_tag('assets/css/font-awesome.min.css'); ?>

        <!-- Select2 -->
        <?php echo link_tag('assets/plugin/select2/select2.min.css'); ?>
        
        <!-- Optional bootstrap theme -->
        <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/css/bootstrap-theme.min.css" crossorigin="anonymous34"> -->

        <script src="<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>
        
        <!-- Accordion menu -->
        <?php echo link_tag('assets/plugin/accordion_menu/css/style.css'); ?>
        

    </head>
    <body>

        <div class="container">

            <header class="nav">
                <h3 class="head-title">Fellowship System</h3>
                <nav>
                    <ul>
                        <li class="<?php echo (($this->uri->segment(1) == "home" && $this->uri->segment(2) == "" ) || $this->uri->segment(1) == "" )? "active":""; ?>"><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="<?php echo ($this->uri->segment(2) == "vulnerabilities")? "active":""; ?>"><a href="<?php echo base_url();?>index.php/home/vulnerabilities">Security Vulnerabilities</a></li>
                        <li class="<?php echo ($this->uri->segment(2) == "docs")? "active":""; ?>"><a href="<?php echo base_url();?>index.php/home/docs">Documentation</a></li>
                        <?php
                        if($logged_in == true){ ?>
                        
                            <li class="<?php echo ($this->uri->segment(1) == "admin")? "active":""; ?>"><a href="<?php echo base_url();?>index.php/admin/">Admin</a></li>
                        
                            <li><a href="<?php echo base_url();?>index.php/login/logout">Logout</a></li>
                        
                        <?php }else{ ?>
                            <li class="<?php echo ($this->uri->segment(1) == "login")? "active":""; ?>"><a href="<?php echo base_url();?>index.php/login/">Login</a></li>
                        
                        <?php } ?>

                    </ul>
                </nav>
            </header>
            
            <?php
            /*
                // add breadcrumbs
                if(isset($this->session->userdata['logged_in'])){
                $this->breadcrumbs->push('Add Alert', '/admin/alert_add');
                $this->breadcrumbs->push('Docs', '/docs');
                $this->breadcrumbs->push('Image Gallery', '/docs/imageGallery');
                $this->breadcrumbs->push('Add New Page', '/docs/addEditPage');
                $this->breadcrumbs->push('Admin', '/admin');
                
                // unshift crumb
                // $this->breadcrumbs->unshift('Home', '/');

                // output
                echo $this->breadcrumbs->show();
                }
             * */
            ?>
            