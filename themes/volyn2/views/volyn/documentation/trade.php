<header>
    <h2>Торгова марка</h2>
</header>

<div class="box">
    <div class="row">
        <div class="6u">
            <img style="width:inherit" src="/themes/volyn/images/trade_1.jpg" href="/themes/volyn/images/trade_1.jpg" class="gallery">
        </div>
        <div class="6u">
            <img style="width:inherit" src="/themes/volyn/images/trade_2.jpg" href="/themes/volyn/images/trade_2.jpg" class="gallery">
        </div>
    </div>
</div>

<?php
$this->widget('application.modules.volyn.extensions.fancybox.EFancyBox', array(
        'target'=>'.gallery',
        'config'=>array(),
    )
);
?>