<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<style>
iframe {
  /* override other styles to make responsive */
  width: 100%    !important;
  height: auto   !important;
}
</style>

<head>

  <title> Browse news and updates from Margalya Press </title>
  <meta name="description" content="Read news and articles to know more about Margalya Press, view blogs, articles, or see the current activities of Margalya Press">

</head>

<div class="blog-area pt-50 pb-100">
            <div class="container">
            <h2 style="text-align:center;">Articles and News</h2><br>
                <div class="blog-mesonry">
                    <div class="row grid">
                        <?php foreach($articles as $a) {
                            if($a->published == 1) { ?>
                            <div class="col-lg-4 col-md-6 grid-item">
                                <div class="blog-wrapper mb-40">
                                    <div class="blog-img mb-15">
                                    <?php if(isset($a->image)) { ?>
                                        <a><?= $this->Html->image($a->image, ['url' => ['controller' => 'Articles', 'action' => 'view', $a->id]]);?></a>
                                    <?php }
                                    else { ?>
                                        <?= $a->video ?>
                                    <?php }
                                    ?>
                                    </div>
                                    <div class="blog-info-wrapper">
                                        <div class="blog-meta">
                                            <ul>
                                                <li><?= $a->created ?></li>
                                            </ul>
                                        </div>
                                        <h4><a><?= $this->Html->link($a->title, ['controller' => 'Articles', 'action'=>'view', $a->id]) ?></a></h4>
                                        <a class="blog-btn btn-hover" href="<?= $this->Url->build('/articles/view/'.$a->id)?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        } ?>
                    </div>
                </div>
                <!-- <div class="pagination-style mt-20 text-center">
                    <ul>
                        <li><a href="#"><i class="ti-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">19</a></li>
                        <li class="active"><a href="#"><i class="ti-angle-right"></i></a></li>
                    </ul>
                </div> -->
            </div>
        </div>