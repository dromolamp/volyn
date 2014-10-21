<?php $this->beginContent('//layouts/main');?>
    <!--======================== content ===========================-->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="grid_8 m_31">
                    <?php echo $content; ?>
                </div>
                <div class="grid_4 m_31">
                    <?php $this->position('searchANewDilers');?>
                    <?php if (!(Yii::app()->controller->id=='production')) {?>
                        <hr class="m_53">
                    <?php $this->position('randProduction'); }?>
                </div>
            </div>
            <?php $this->position('ourAdvantages');?>
        </div>
    </div>
<?php $this->endContent(); ?>