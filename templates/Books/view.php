<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
$counter = 0;
?>
    <!doctype html>
    <html class="no-js" lang="en">


<body>
<div class="product-details pt-10 pb-80">
    <div class="container">
    <div class="button-box">
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Books', 'action' => 'shoplist']
        ]); ?>
        
    </div>
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12">
                <div class="product-details-img-content" >
                    <div class="product-details-tab mr-70" >
                        <div class="product-details-large tab-content" style="position: relative; left: 5%;">
                            <div class="tab-pane active show fade" id="pro-details1" role="tabpanel" >
                                <div class="easyzoom easyzoom--overlay" >
                                    <a href="#">
                                        <?= $this->Html->image($book->thumbnail_img); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bundle-area">

                    <div class="bundle-img" style="width: 135px; height: 140px" >

                        <?php foreach ($book->book_images as $bookImage):?>
                            <br>
                            <?= $this->Html->image($bookImage->image);?> </a>
                            <br>
                            <?php $counter++ ?>
                            <br>
                        <?php endforeach;?>
                        <br>


                    </div>
                </div>

            </div>
            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">
                    <h2><?= $book->name ?></h2>
                    <?php if($book->volume > 0) { ?>
                        <h3>Volume: <?= $book->volume ?></h3>
                    <?php } ?>
                    <h3>Author: <?=  $book->authors?></h3>


                    <div class="details-price">
                        <h4>Status: <?= $book->status?></h4>
                    </div>
                    <p><?= $book->summary ?></p>
                    </div>
                    <h5>Book types and prices</h5>
                    <?= $this->Form->create(null, array('type' => 'get')); ?>
                        <select id="multiple_values" name="cost">
                            <?php if($book->hardcover_price > 0 && $book->hardcover_quantity > 0) { ?>
                                <option name="hardcover_price" value="'Hard cover',<?= $book->hardcover_price?>">Hard cover: $<?= $book->hardcover_price?></option>
                            <?php }?>
                            <?php if($book->softcover_price > 0 && $book->softcover_quantity > 0) { ?>
                                <option name="softcover_price" value="'Soft cover',<?= $book->softcover_price?>">Soft cover: $<?= $book->softcover_price?></option>
                            <?php }?>
                            <?php if($book->ebook_price > 0) { ?>
                                <option name="ebook_price" value="'Ebook',<?= $book->ebook_price?>">Ebook: $<?= $book->ebook_price?></option>
                            <?php }?>
                        </select>

                        <?php if($book->status !== 'Out of Stock') {?>
                            <div class="quickview-plus-minus">
                            <input type="number" id="quan" name="quan" placeholder="Quantity" min=1 required>
                            <input type='hidden' name='pID' id='<?php echo $book->id ?>' value='<?php echo $book->id ?>'>
                            <div class="quickview-btn-cart">
                                <input type='submit' value='Add To Cart' class="btn-hover-black"> </input>
                            </div>
                        <?php }
                        else {?>
                            <br><h5><strong>Out of stock.</strong></h5>
                            <?php }?>

                    </div>
                    <br><p>Tags: <?= $book->keywords?></p>
                            
                    <?= $this->Form->end(); ?>
                </div>
        </div>
    </div>
</div>
<div class="product-description-review-area pb-90">
    <div class="container">
        <div class="product-description-review text-center">
            <div class="description-review-title nav" role=tablist>
                <a class="active" href="#pro-dec" data-bs-toggle="tab" role="tab" aria-selected="true">
                    Additional Information
                </a>
                <?php if($videoArray != null) {?>
                <a href="#pro-review" data-bs-toggle="tab" role="tab" aria-selected="false">
                    Learn More
                </a>
                <?php } ?>
            </div>
            <div class="description-review-text tab-content">
                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                    <p><?= $book->additional_information ?></p>
                </div>
                <div class="tab-pane fade" id="pro-review" role="tabpanel">
                <?php 
                if($videoArray != null) { 
                    foreach($videoArray as $video => $description) {?>
                    <?= $description ?>
                    <br>
                    <?= $video ?>
                    <br>
                    <br>
                <?php 
                    }
                } 
                else { ?>
                    <p> No videos available for this book. </p>
                <?php } ?>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->Html->css('easyzoom.css') ?>
<?= $this->Html->css('icofont.css') ?>
<?= $this->Html->script('/vendor/modernizr-3.11.7.min.js')?>
<?= $this->Html->script('jquery-1.12.4.min.js') ?>
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
<?php
