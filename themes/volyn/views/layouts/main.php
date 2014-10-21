<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no">
    <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" type="image/x-icon">

    <link href='<?php echo Yii::app()->theme->baseUrl; ?>/css/googleFonts.css' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/camera.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fixes.css">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>


    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-migrate-1.1.1.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.easing.1.3.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/superfish.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.mobilemenu.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/camera.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.ui.totop.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/script.js"></script>

    <script>
        $(document).ready(function(){
            $('#slider').camera({
                height: '28%',
                loader: true,
                minHeight: '200px',
                navigation: false,
                navigationHover: false,
                pagination:true,
                playPause: false,
                thumbnails: false
            });
        });
    </script>
    <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.mobile.customized.min.js"></script>
    <!--<![endif]-->
    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.">
        </a>
    </div>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/html5shiv.js"></script>
    <link rel="stylesheet" media="screen" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css">
    <![endif]-->
</head>
<body <?php if (!(Yii::app()->controller->id=='page' && Yii::app()->controller->action->id == 'main')) echo 'id="index2"'?>>
<!--======================== header ============================-->
<header>
    <div class="container">
        <?php echo $this->position('language');?>
    </div>
    <div class="container">
        <div class="row">
            <div class="grid_12">
                <!--======================== logo ============================-->
                <?php $this->position('logo');?>
            </div>
        </div>
    </div>
    <div class="nav_box">
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    <nav>
                        <?php $this->position('top_menu');?>
                        <form id="search" action="" method="GET" accept-charset="utf-8" class="search_form">
                            <input type="text" name="s">
                            <a onClick="document.getElementById('search').submit()" href="#">
                                <span class="fa-search"></span>
                            </a>
                        </form>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php if (Yii::app()->controller->id=='page' && Yii::app()->controller->action->id == 'main') {?>
    <!--=================== slider ==================-->
    <div class="camera_wrap" id="slider">
        <div data-src="<?php echo Yii::app()->theme->baseUrl; ?>/images/slide1.jpg" data-thumb="images/slide1.jpg">
            <div class="camera_caption">
                <span class="span2 m_0">Вітаємо на сайті тм Волинь</span>
                <ul class="caption_list2">
                    <li>Ми є виробником туалетного паперу із 2009 року</li>
                    <li>Наше виробництво знаходять в прекрасному місті Луцьк</li>
                    <li>тм Волинь для тих, хто цінує якість</li>
                </ul>
            </div>
        </div>
        <!--<div data-src="<?php /*echo Yii::app()->theme->baseUrl; */?>/images/slide2.jpeg" data-thumb="images/slide2.jpeg">
            <div class="camera_caption">
                <span class="span2">Accept Credit Cards On <br>Your Smartphone Today!</span>
                <ul class="caption_list2">
                    <li>Lorem ipsum dolor sit amet conse ctetur adipisicing</li>
                </ul>
                <a href="#" class="caption_banner_link"><img src="<?php /*echo Yii::app()->theme->baseUrl; */?>/images/caption_img1.png" alt=""></a>
                <a href="#" class="caption_banner_link"><img src="<?php /*echo Yii::app()->theme->baseUrl; */?>/images/caption_img2.png" alt=""></a>
            </div>
        </div>-->
        <div data-src="<?php echo Yii::app()->theme->baseUrl; ?>/images/slide3.jpg" data-thumb="images/slide3.jpg">
            <div class="camera_caption">
                <span class="span1">Самый популярный продукт тм Волинь - <br> <span>Туалетная бумага 64м </span></span>
                <ul class="caption_list1">
                    <li>из неокрашенной бумаги макулатуры</li>
                    <li>в рулончиках без гильзы</li>
                    <li>есть на складе</li>
                </ul>
            </div>
        </div>
    </div>
    <?php }?>
</header>
<?php echo $content;?>
<!--======================== footer ============================-->
<footer>
    <div class="container">
        <div class="row">

            <div class="grid_4">
                <h4 class="contact_title">Юридический адрес</h4>
                <span class="contact">43008 Украина, Волынская обл.,
г. Луцк, ул. Писаревского 9/40</span>
                <h4 class="contact_title">Адрес производства</h4>
                <span class="contact">45632 Украина, Волынская обл.,
Луцкий р-н, с. Змиинец, ул. Лискова, 20</span>


            </div>
            <div class="grid_4">
                <h4 class="phone_title">Телефони:</h4>

					<span class="phone_span">
						+38 (066) 207 07 30
					</span>

					<span class="phone_span">
						+38 (098) 709 79 76
					</span>
                <span class="contact">Мельник Сергей Николаевич</span>
            </div>
            <div class="grid_4">
                <a class="logo_img" href="index.html" id="footer_logo">
                    <!--<img src="<?php /*echo Yii::app()->theme->baseUrl; */?>/images/footer_logo.png" alt="">-->
                    <sup>тм</sup> Волинь <br/>
                    <span>ЧП Мельник Сергей Николаевич</span>
                </a>
                <div class="copyright">тм Волинь &copy; <span id="copyright-year"></span> | <a href="#">Зроблено в Луцьку</a></div>
                <div class="footer-link"></div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>