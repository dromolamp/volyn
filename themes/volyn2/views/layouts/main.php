<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>Alpha by HTML5 UP</title>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.dropotron.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.scrollgress.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/skel.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/skel-layers.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/skel.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style-wide.css" />
    </noscript>
    <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie/v8.css" /><![endif]-->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fixes.css" />

</head>
<body <?php if (Yii::app()->controller->action->id == 'main'){ echo 'class="landing"';}?>>

<!-- Header -->
<header <?php if (Yii::app()->controller->action->id == 'main'){ echo 'class="alt"';}?> id="header">
    <a href="/"><img width="25" src="/themes/volyn/images/logo_min.jpeg" id="logo"/></a>
    <h1><a href="/">Волинь <sup>тм</sup></a> ПП Мельник С.М.</h1>

    <nav id="nav">
        <?php $this->position('top_menu');?>
    </nav>

    <?php echo $this->position('language');?>
</header>
<?php if (Yii::app()->controller->action->id == 'main'){?>
<!-- Banner -->
<section id="banner">
    <h2>Волинь <sup>тм</sup></h2>
    <p>для тих, хто звик до хорошої якості</p>
    <ul class="actions">
        <li><a href="/volyn/production/index" class="button special">Наша продукція</a></li>
        <li><a href="/<?php echo Yii::app()->language; ?>/o_nas" class="button">Про нас</a></li>
    </ul>
</section>
    <script type="text/javascript">
        $(document).ready(function(){
            //$('#banner').css('background-image', 'url("/themes/volyn/css/images/overlay.png"), url("/themes/volyn/images/banner.jpg")');
            var i = 1;

            setTimeout(function(){
                $('#banner').css('background-image', 'url("/themes/volyn/css/images/overlay.png"), url("/themes/volyn/slider/'+i+'.jpg")');
                i++;
                //if (i==5) i=1;
            },2000);
            //alert(1);
        });
    </script>

<?php }?>

<!-- Main -->
<section id="main" class="container">
    <?php echo $content; ?>
</section>

<!-- Footer -->
<footer id="footer">
    <ul class="copyright">
        <li>&copy; Волинь <sup>тм</sup>. Всі права захищено.</li>
    </ul>
</footer>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#nav ul li').live('mouseover',function(){
            if ($(this).attr('class')!=' active') {
            $(this).attr('class','active');
                $(this).live('mouseout',function(){
                    $(this).attr('class',' ');
                });
            }
        });
    });
</script>
</body>
</html>