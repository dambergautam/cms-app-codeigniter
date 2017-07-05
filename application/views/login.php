<section>
    <?php    
    $showMsg =false;
    if (count($this->session->flashdata()) > 0){
        $showMsg = true;
        $key =$this->session->get_flash_keys()[0];
        $msg = $this->session->flashdata($this->session->get_flash_keys()[0]);
        
    }else if(validation_errors() != false){
        $showMsg = true;
        $key = 'error_msg';
        $msg = validation_errors();
    }

    if ($showMsg){ 
        echo "<div class='message'>";
        echo "<div class='".$key."'>";
        echo $msg;
        echo "</div></div>";
    }
    ?>
    
    <form class="form-signin" name="frm_login" method="post" action="<?php echo base_url(); ?>index.php/login/user_login_process">
        
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</section>