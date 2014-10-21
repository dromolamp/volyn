<?php $this->beginContent('//layouts/main');?>

    <!--======================== content ===========================-->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="grid_8 m_31">
                    <?php $this->position('mainPageProduction');?>
                    <hr class="m_60">
                    <?php $this->position('mainPageArticle');?>

                </div>
                <div class="grid_4 m_31">
                    <?php $this->position('searchANewDilers');?>
                </div>
            </div>
            <?php $this->position('ourAdvantages');?>

        </div>
    </div>
<?php $this->endContent(); ?>