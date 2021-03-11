<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<!-- main --> 
<link rel="stylesheet" href="libs/css/style.css" />
<script src="libs/js/sweetalert.min.js"></script>

  <div class="main-agileinfo slider ">
    <div class="items-group">
      <div class="item agileits-w3layouts">
        <div class="block text main-agileits">  
          <span class="circleLight"></span>  
          <!-- login form -->
          <div class="login-form loginw3-agile"> 
            <div class="agile-row">
              <div class="logo"><img src="libs/images/logo.png" alt=" " class="img-responsive"></div>
              <div class="login-agileits-top">  
                <?php 
                  echo display_msg($msg);                   
                ?>
                <form method="post" action="auth.php" class="clearfix"> 
                  <p><label for="username" class="control-label">Usuario</label></p>                  
                  <input type="text" class="name" name="username" required=""/>
                  <p><label for="Password" class="control-label">Contraseña</label></p>                 
                  <input type="password" class="password" name="password" required=""/>  
                  <label class="anim">                    
                    <span></span> 
                  </label>    
                  <button type="submit">Entrar</button> 
                </form>   
              </div> 
            </div>  
          </div>   
        </div>      
      </div>   
    </div>
  </div> 

<?php include_once('layouts/footer.php'); ?>
