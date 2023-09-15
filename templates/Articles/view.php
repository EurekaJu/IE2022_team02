<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<style>
iframe {
  display: block ;
  margin-left: auto ;
  margin-right: auto ;
  width: 100% ;
}
</style>

<head>
  <title> Margalya Press - View News and Articles </title>
  <meta name="description" content="Read Margalya Press content to keep up to date with Margalya Press.">
</head>

<div class="blog-details pb-100">
    <div class="container"><br>
 
        <div class="button-box">
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Articles', 'action' => 'home']
        ]); ?>

        </div><br>
            <div class="row">
                <div class="col-12">
                    <div class="blog-details-info">
                        <div class="blog-meta">
                            <ul>
                                <li>Published: <?= h($article->created) ?></li>
                            </ul>
                        </div>
                        <h3><?= h($article->title) ?></h3>
                        <div class="blog-wrapper mb-40" >
                            <div class="blog-img mb-15">
                                <a><?= $this->Html->image($article->image);?></a>
                            </div>
                            <?php if($article->video != null) { ?>
                                <div>
                                <?= $article->video ?>
                                </div>
                            <?php } ?>
                        </div>
                        <p><?= $this->Text->autoParagraph($article->body); ?></p>
                        <div class="blog-feature">
                            <p><?= $article->has('user') ? 'Published by: ' . $article->user->first_name . ' ' . $article->user->last_name : '' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
