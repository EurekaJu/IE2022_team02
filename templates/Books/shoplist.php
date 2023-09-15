<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>
<!doctype html>
<html class="no-js" lang="en">
<body>

<head>
   <title> Margalya Press - Browse books (Purchase hard cover, soft cover and EBooks online) </title>
   <meta name="description" content="Browse all of the sacred Jewish texts from published by Margalya Press. The texts are translated into English and come in different volumes, and formats, with different Authors. Find out more Jewish Tetxs here, on Margalya Press. The first publication is the TIQQUNEI HA-ZOHAR.">
</head>

<div class="section-title-3 text-center mb-50">
    <h2>Shop Books</h2>
</div>
<div class="shop-page-wrapper shop-page-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop-sidebar mr-50">
                    <div class="sidebar-widget mb-50">
                        <h3 class="sidebar-title">Search</h3>
                        <div class="sidebar-search">
                            <?= $this->Form->create(null, array('type' => 'get')); ?>
                            <?=$this->Form->control('key', array('label'=> 'Search:', 'value'=>$this->request->getQuery('key'))); //'value'=>$this->request->getQuery('key') ?>
                            <br>
                            <?= $this->Form->submit(); ?>
                            <?= $this->Form->end(); ?>
                            <br>
                            <div class="sidebar-widget mb-45">
                                <h3 class="sidebar-title">Genres</h3>
                                <?= $this->Form->create(null, array('type' => 'get')); ?>
                                <?=$this->Form->control('genrefilter', ['options' => $uniqueGenres, 'label'=> 'Genre filter:', 'default'=>' ', 'value'=>$this->request->getQuery('genrefilter')]); //genrefilter = name of query ?>
                                <?= $this->Form->submit(); ?>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="sidebar-widget mb-40">
                        <h3 class="sidebar-title">Filter by Price</h3>
                        <div class="price_filter">
                            <div id="slider-range"></div>
                            <div class="price_slider_amount">
                                <div class="label-input">
                                    <label>price : </label>
                                    <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                                </div>
                                <button type="button">Filter</button> 
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="sidebar-widget mb-45">
                        <h3 class="sidebar-title">Genres</h3>
                        <div class="sidebar-categories">
                            <ul>
                            <?php foreach($uniqueGenres as $u) { ?>
                                <li><a href="#<?= $u ?>"> <?=$u ?></a></li>
                            <?php }
                                ?>
                            </ul>
                        </div>
                    </div> -->
                    <!-- <div class="sidebar-widget mb-40">
                        <h3 class="sidebar-title">tags</h3>
                        <div class="product-tags">
                            <ul>
                                <li><a href="#">Clothing</a></li>
                                <li><a href="#">Bag</a></li>
                                <li><a href="#">Women</a></li>
                                <li><a href="#">Tie</a></li>
                                <li><a href="#">Women</a></li>
                            </ul>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop-product-wrapper res-xl res-xl-btn">
                    <div class="shop-bar-area">
                        <div class="shop-bar pb-60">
                            <div class="shop-found-selector">
                                <div class="shop-selector">
                                    <!-- <label>Sort By : </label>
                                    <select name="select">
                                        <option value="">Default</option>
                                        <option value=""> Preorder</option>
                                        <option value="">In stock</option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="shop-product-content tab-content">
            <div id="grid-sidebar1" class="tab-pane fade active show">
                <div class="row">
                <?php foreach ($books as $b): ?>
                    <div class="col-lg-6 col-md-6 col-xl-3">
                        <div class="product-wrapper mb-30">
                            <div class="product-img">
                                <a>
                                    <?= $this->Html->image("$b->thumbnail_img", ['url' => ['controller' => 'Books', 'action' => 'view', $b->id]]);?>
                                </a>
                                <!-- <div class="product-action">
                                    <a class="animate-top" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                </div> -->
                            </div>
                            <div class="product-content">
                                <h4><a href="#"><?= $this->Html->link($b->name, ['controller' => 'Books', 'action'=>'view', $b->id]) ?></a></h4>
                                <span>By: <?= $this->Html->link($b->authors, ['controller' => 'Books', 'action'=>'view', $b->id]) ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="button-box">
        <button class="default-btn floatright">
            <a href="<?= $this->Url->build('/books/shoplist') ?>">Reset</a>
        </button>
    </div>
    <!-- <div class="pagination-style mt-30 text-center">
            <ul class="pagination-style mt-30 text-center">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Next') . '>') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div> -->
    <br>
</div>
</body>
</html>