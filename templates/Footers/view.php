<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Footer $footer
 */
?>
<div class="blog-details pt-5 pb-100">
    <div class="container">
    <div class="button-box">
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Books', 'action' => 'home']
        ]); ?>
    </div>
        <div class="row">
            <div class="col-12">
                <div class="blog-details-info">
                    <h3><?= $footer->title ?> </h3>
                    <p><?= $footer->body ?></p>
                </div>
            </div>
        </div>
    </div>
</div>