<?php // Vigattin Header ?> 
<div class="vigattin_vauth_header">
    <div class="branding">
        <img class="header_logo" src="<?php echo $base_url.'/index.php/'.$module_name.'/assets/img/header_logo.png'; ?>" />
        <div class="user_info"><img class="fb_picture" src="<?php echo $picture; ?>" /><a class="user_name"><?php echo $name; ?></a> <a target="_parent" href="<?php echo $logout_link; ?>" class="on_butt"><img src="<?php echo $base_url.'/index.php/'.$module_name.'/assets/img/onbutton.png'; ?>" /></a></div>
    </div>
    <div class="vigattin_vauth_navigator"><?php echo $main_navigation; ?> 
    </div>
</div>
<iframe class="vigattin_vauth_iframe" frameborder="0" scrolling="no"></iframe>