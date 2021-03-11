<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html>
    <head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Bosques de Chapultepec";?>
    </title>
    <link rel="shortcut icon" href="libs/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="BOSQUES DE CHAPULTEPEC">    
   <link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="libs/css/simple-line-icons.css">
   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="libs/css/animate.min.css">
   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="libs/css/whirl.css">
   
   
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="libs/css/main.css" id="maincss">
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="libs/css/bootstrap.css" id="bscss">
   <!-- DATATABLES-->
   <link rel="stylesheet" href="libs/css/dataTables/dataTables.colVis.css">
   <link rel="stylesheet" href="libs/css/dataTables/dataTables.bootstrap.css">
   <link rel="stylesheet" href="libs/css/dataTables/index.css">
   <!-- =============== MODAL ===============-->
   
   <!-- =============== ALERT ===============-->
   <link rel="stylesheet" href="libs/css/sweetalert.css">
   <!-- =============== SPINNER ===============-->
   <link rel="stylesheet" href="libs/css/spinkit.css">
    <!-- =============== DATETIMEPICKER ===============-->
   <link rel="stylesheet" href="libs/css/datetimepicker/bootstrap-datetimepicker.min.css">
   <!-- SELECT2-->
   <link rel="stylesheet" href="libs/css/select2.css">
   <link rel="stylesheet" href="libs/css/select2-bootstrap.css">

   <!-- ALERTAS-->
   <script src="libs/js/sweetalert.min.js"></script>
   <!-- JQUERY-->
   <script src="libs/js/jquery.js"></script>
   <!-- MODERNIZR-->
   <script src="libs/js/modernizr.custom.js"></script>
   <!-- MATCHMEDIA POLYFILL-->
   <script src="libs/js/matchMedia.js"></script>
   
   <!-- BOOTSTRAP-->
   <script src="libs/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="libs/js/jquery.storageapi.js"></script>
   <!-- JQUERY EASING-->
   <script src="libs/js/jquery.easing.js"></script>
   <!-- ANIMO-->
   <script src="libs/js/animo.js"></script>
   <!-- SLIMSCROLL-->
   <script src="libs/js/jquery.slimscroll.min.js"></script>
   <!-- SCREENFULL-->
   <script src="libs/js/screenfull.js"></script>
   <!-- LOCALIZE-->
   <script src="libs/js/jquery.localize.js"></script>
   <!-- RTL demo-->
   <script src="libs/js/demo-rtl.js"></script>
   <!-- Modal -->
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 id="myModalLabel" class="modal-title">Detalle</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>               
            </div>
         </div>
      </div>
   </div>

   <!-- =============== APP SCRIPTS ===============-->
   <script src="libs/js/app.js"></script>
   <!-- SPARKLINE-->
   <script src="libs/js/index.js"></script>
   <!-- DATATABLES-->
   <script src="libs/js/dataTables/jquery.dataTables.min.js"></script>
   <script src="libs/js/dataTables/dataTables.colVis.js"></script>
   <script src="libs/js/dataTables/dataTables.bootstrap.js"></script>
   <script src="libs/js/dataTables/dataTables.buttons.js"></script>
   <script src="libs/js/dataTables/buttons.bootstrap.js"></script>
   <script src="libs/js/dataTables/buttons.colVis.js"></script>
   <script src="libs/js/dataTables/buttons.flash.js"></script>
   <script src="libs/js/dataTables/buttons.html5.js"></script>
   <script src="libs/js/dataTables/buttons.print.js"></script>
   <script src="libs/js/dataTables/dataTables.responsive.js"></script>
   <script src="libs/js/dataTables/responsive.bootstrap.js"></script>
   <script src="libs/js/dataTables/demo-datatable.js"></script>
   <!-- MOMENT JS-->
   <script src="libs/js/moment-with-locales.min.js"></script>
   <!-- DATETIMEPICKER-->
   <script src="libs/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
  
    <!-- FILESTYLE-->
   <script src="libs/js/bootstrap-filestyle.js"></script>
   <!-- TAGS INPUT-->
   <script src="libs/js/bootstrap-tagsinput.min.js"></script>
   <!-- CHOSEN-->
   <script src="libs/js/chosen.jquery.min.js"></script>
    <!-- SELECT2-->
   <script src="libs/js/select2.js"></script>
    <script src="libs/js/sidebar_menu.js"></script>
    <script src="libs/js/jquery.validate.js"></script>
    <script src="libs/js/jquery.steps.js"></script>
  </head>
    
  <body>
  <?php  if ($session->isUserLoggedIn(true)): ?>
   <div class="wrapper">
     <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav role="navigation" class="navbar topnavbar" style="margin-bottom: 0;">
            <!-- START navbar header-->
            <div class="navbar-header">
               <a href="home.php" class="navbar-brand">
                 <!--
                  <div class="brand-logo"><img src="libs/images/logo-int.png" class="img-responsive"></div>
                  <div class="brand-logo-collapsed"><img src="libs/images/logo-min.png" class="img-responsive"></div>
                  -->
               </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
               <!-- START Left navbar-->
               <ul class="nav navbar-nav">
                  <li>
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                     <a href="#" data-trigger-resize="" data-toggle-state="aside-collapsed" class="hidden-xs">
                        <em class="fa fa-navicon"></em>
                     </a>
                     <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                     <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                        <em class="fa fa-navicon"></em>
                     </a>
                  </li>
                  <!-- START User avatar toggle-->
                  <li>
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                     <a id="user-block-toggle" href="#user-block" data-toggle="collapse">
                        <em class="fa fa-fw fa-user"></em>
                     </a>
                  </li>
                  <!-- END User avatar toggle-->
                  <!-- START lock Alert menu-->
                  <li>
                     <a href="edit_account.php" title="Perfil">
                        <em class="fa fa-fw fa-gear"></em>
                     </a>                     
                  </li>
                  <!-- END Alert menu-->
                  <!-- END lock screen-->
                  <!-- START exit screen-->
                  <li>                    
                     <a href="logout.php" title="Salir">
                        <em class="icon-power"></em>
                     </a>
                  </li>
                  <!-- END exit screen-->
               </ul>
               <!-- END Left navbar-->
            </div>
            <!-- END Nav wrapper-->
         </nav>
         <!-- END Top Navbar-->
      </header>
 <!-- sidebar-->
      <aside class="aside" style="z-index: 116; bottom:0">
         <!-- START Sidebar (left)-->
         <div class="aside-inner">
            <nav data-sidebar-anyclick-close="" class="sidebar">
               <!-- START sidebar nav-->
               <ul class="nav">
                  <!-- START user info-->
                  <li class="has-user-block">
                     <div id="user-block" class="collapse">
                        <div class="item user-block">
                           <!-- User picture-->
                           <div class="user-block-picture">
                              <div class="user-block-status">
                                 <img src="uploads/users/<?php echo $user['image'];?>" width="40" height="auto" class="img-thumbnail img-circle">
                                 <div class="circle circle-success circle-lg"></div>
                              </div>
                           </div>
                           <!-- Name and Job-->
                           <div class="user-block-info">
                              <span class="user-block-name"><?php echo remove_junk(ucfirst($user['name'])); ?></span>
                              <span class="user-block-role">Usuario</span>
                           </div>
                        </div>
                     </div>
                  </li>
                  <!-- END user info-->

                  <!-- Menú items-->

                  <?php if($user['user_level'] === '1'): ?>
                  <!-- admin menu -->
                  <?php include_once('admin_menu.php');?>

                  <?php elseif($user['user_level'] === '2'): ?>
                  <!-- Special user -->
                  <?php include_once('conta_menu.php');?>

                  <?php elseif($user['user_level'] === '3'): ?>
                  <!-- User menu -->
                  <?php include_once('comite_menu.php');?>

                  <?php elseif($user['user_level'] === '4'): ?>
                  <!-- User menu -->
                  <?php include_once('user_menu.php');?>                  

                 <?php endif;?>             
             
                 <?php endif;?>  
                  <!-- FIN Menú items-->
               </ul>
               <!-- END sidebar nav-->
            </nav>
         </div>
         <!-- END Sidebar (left)-->
      </aside>

<!-- Main section-->
      <section>
         <!-- Page content-->
         <div class="content-wrapper">
           