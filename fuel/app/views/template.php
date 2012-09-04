<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php //echo $title; ?></title>
  <meta name="description" content="">

  <meta name="viewport" content="width=device-width">
  <?php
  /*
  foreach($css as $a_css_resource){
    echo $a_css_resource."\r\n";
  }
  foreach($script as $a_script_resource){
    echo $a_script_resource."\r\n";
  }*/
  ?>
  <!--[if lt IE 9]>
  <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
  <![endif]-->
</head>
<body>
  <div class="container ui-corner-bottom">
  <header>
      <h1>
        <?php //echo $logo_image; ?>
        <!--<span>Civicality</span>-->
      </h1>
      <div id="topmenu">
        <?php //echo $menu_content; ?>
      </div>
      <div id="welcome">
        <?php //echo $welcome_text; ?>
      </div>
      <br class="clear" />
  </header>
  <div role="main" id="main">
    <?php echo $content; ?>
  </div>
  <footer>
    <div id="copyright">&copy; <?php echo $year; ?> Civicality</div>
  </footer>
</div>
</body>
</html>