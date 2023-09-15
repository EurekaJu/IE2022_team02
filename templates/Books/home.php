<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>
<!doctype html>
<html class="no-js" lang="en">
<style>
iframe {
  /* override other styles to make responsive */
  width: 100%    !important;
  height: auto   !important;
}
</style>

<head>
   <title> Margalya Press -  Jewish texts Publisher  </title>
   <meta name="description" content="Margalya Press is a business that produces innovative and quality Jewish texts, translated into English. The texts are religious and sacred texts. The first publication is set to be released at the end of 2022 called the TIQQUNEI HA-ZOHAR. Jewish literutrue.">
</head>

<body>
    <div class="slider-area">
        <div class="slider-active owl-carousel" >
            <div class="single-slider single-slider-book1 bg-img" style="background-image: url('<?= $this->Url->build($banner1Img)?>')">
            <div class="container">
                    <div class="slider-animation slider-content-book fadeinup-animated">
                        <h1 style="color:#008080" class="animated" style="font-size: "><span style="color:#008080" ><?= $banner1['heading'] ?></span></h1>
                        <h2 class="animated" style="font-size: "><?= $banner1['subheading'] ?></h2>
                        <p class="animated" ><?= $banner1['body'] ?></p>
                        <a style="background-color:#008080" href="<?= $this->Url->build($banner1['button_link']) ?>"><?= $banner1['button_text'] ?></a>
                    </div>
                </div>
            </div>
            <div class="single-slider single-slider-book1 bg-img" style="background-image: url('<?= $this->Url->build($banner2Img)?>')">
                <div class="container">
                    <div class="slider-animation slider-content-book fadeinup-animated">
                        <h1 style="color:#008080"  class="animated" style="font-size: "><span style="color:#008080" ><?= $banner2['heading'] ?></span> </h1>
                        <h2 class="animated" style="font-size: "><?= $banner2['subheading'] ?></h2>
                        <p class="animated" ><?= $banner2['body'] ?></p>
                        <a style="background-color:#008080" href="<?= $this->Url->build($banner2['button_link']) ?>"><?= $banner2['button_text'] ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- best product area start -->
    <div class="best-product-area pt-100 pb-15">
        <div class="pl-100 pr-100">
            <div class="container-fluid">
                <div class="section-title-3 text-center mb-40">
                    <h2>Books</h2><br>
                    <h6>Click the below genres to view the books </h6>
                </div>
                <!-- genres -->
                <!-- display ALL books -->
                <div class="best-product-style">
                    <div class="product-tab-list2 text-center mb-95 nav product-menu-mrg" role="tablist">
                        <a class="active" href="#ALL" data-bs-toggle="tab" role="tab">
                            <h4>ALL </h4>
                        </a>
                        <?php foreach($uniqueGenres as $a) { ?>
                        <a href="#<?= $a ?>" data-bs-toggle="tab" role="tab">
                            <h4><?= $a ?> </h4>
                        </a>
                        <?php } ?>

                    </div>
                    <!-- display all UNIQUE genres -->
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="ALL" role="tabpanel">
                            <div class="custom-row" style="justify-content: center;">
                                <?php foreach($books as $b){ ?>
                                    <div class="custom-col-5 custom-col-style mb-95">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a>
                                                    <?= $this->Html->image("$b->thumbnail_img", ['url' => ['controller' => 'Books', 'action' => 'view', $b->id]]);?>
                                                </a>
                                            </div>
                                            <div class="product-content-2 text-center">
                                                <h4><a><?= $this->Html->link($b->name, ['controller' => 'Books', 'action'=>'view', $b->id]) ?></a></h4>
                                                <span>By: <?= $this->Html->link($b->authors, ['controller' => 'Books', 'action'=>'view', $b->id]) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php foreach($uniqueGenres as $a) { ?>
                            <div class="tab-pane fade" id="<?= $a ?>" role="tabpanel">
                            <div class="custom-row" style="justify-content: center;">
                            <?php foreach($books as $b) {
                                if(strtoupper($b->genre) == strtoupper($a)) { ?>
                                    <div class="custom-col-5 custom-col-style mb-95">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a>
                                                    <?= $this->Html->image("$b->thumbnail_img", ['url' => ['controller' => 'Books', 'action' => 'view', $b->id]]);?>
                                                </a>
                                            </div>
                                            <div class="product-content-2 text-center">
                                            <h4><a href="product-details.html"><?= $this->Html->link($b->name, ['controller' => 'Books', 'action'=>'view', $b->id]) ?></a></h4>
                                            <span>By: <?= $this->Html->link($b->authors, ['controller' => 'Books', 'action'=>'view', $b->id]) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } 
                             }?>
                            </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- best product area end -->

    <!-- blog area start -->
    <div class="blog-area pt-10 pb-80">
        <div class="container">
            <div class="section-title-3 text-center mb-50">
                <h2>Latest News</h2>
            </div>
            <div class="row">
                <?php foreach($top as $t) { ?>
                    <div class="col-md-4">
                    <div class="blog-wrapper mb-40">
                    <div class="blog-img blog-hover mb-15">
                        <?php if($t->image != null) {?>
                        <!-- if image exists then display, if not then display video, else nothing-->
                        <a><?= $this->Html->image("$t->image", ['url' => ['controller' => 'Articles', 'action' => 'view', $t->id]]);?></a>
                        <?php } 
                        elseif($t->video != null) { ?>
                            <?=$t->video ?>
                        <?php } 
                        else {
                            //do nothing
                        }?>
                    </div>
                    <div class="blog-info">
                        <h4><a><?= $this->Html->link($t->title, ['controller' => 'Articles', 'action'=>'view', $t->id]) ?></a></h4>
                        <span><?= $t->created->format('d/m/Y'); ?></span>
                    </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- blog area end -->

    <!-- all js here -->
    <?= $this->Html->script('vendor/jquery-1.12.4.min.js') ?>
    <?= $this->Html->script('popper.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('jquery.magnific-popup.min.js') ?>
    <?= $this->Html->script('isotope.pkgd.min.js') ?>
    <?= $this->Html->script('imagesloaded.pkgd.min.js') ?>
    <?= $this->Html->script('jquery.counterup.min.js') ?>
    <?= $this->Html->script('waypoints.min.js') ?>
    <?= $this->Html->script('ajax-mail.js') ?>
    <?= $this->Html->script('owl.carousel.min.js') ?>
    <?= $this->Html->script('plugins.js') ?>
    <?= $this->Html->script('main.js') ?>
</body>

</html>
