
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free yii themes, free web application theme">
    <meta name="author" content="Webapplicationthemes.com">
	<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
	  Yii::app()->clientScript->registerCoreScript('jquery');
//      Yii::app()->clientScript->registerCoreScript('jquery.ui');
//      Yii::app()->clientScript->registerCssFile(
//            Yii::app()->clientScript->getCoreScriptUrl().
//            '/jui/css/base/jquery-ui.css'
//        );
	?>
    <!-- Fav and Touch and touch icons -->
    <link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/favicon2.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<?php  
	  $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	  $cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	  $cs->registerCssFile($baseUrl.'/css/abound.css');
      $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/hackZingChart.css');
      $cs->registerCssFile('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
      $cs->registerCssFile(Yii::app()->request->baseUrl.'/js/pace/themes/pace-theme-corner-indicator.css');
	  //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
	  ?>
      <!-- styles for style switcher -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/loading.css" />
      	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-blue.css" />
	  <?php
      $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
      $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jqAlert/jquery.alerts.js', CClientScript::POS_END);
      $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/funciones.js', CClientScript::POS_END);
      $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/pace/pace.min.js');
	  //$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	  //$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	  //$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	  //$cs->registerScriptFile($baseUrl.'/js/charts.js');
	  //$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	  //$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	  //$cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
	?>
    <script type="text/javascript">
    $(function() {
        $( document ).tooltip({ track: true, });
    });
    </script>
  </head>

<body>

<section id="navigation-main">   
<!-- Require the navigation -->
<?php require_once('tpl_navigation.php')?>
</section><!-- /#navigation-main -->
    
<section class="main-body">
    <div class="container-fluid">
            <!-- Include content pages -->
            <?php echo $content; ?>
    </div>
</section>

<!-- Require the footer -->
<?php require_once('tpl_footer.php')?>

  </body>
</html>