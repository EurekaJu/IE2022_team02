<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookImage $bookImage
 * @var string[]|\Cake\Collection\CollectionInterface $books
 */
$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>
<div class="row">
<div class="container">
    <div class="button-box">
    <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'BooksImages', 'action' => 'index']
        ]); ?>
        <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bookImage->id], ['class' => "default-btn floatright"],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bookImage->id), 'class' => 'default-btn floatright']
            ) ?>
        <?= $this->Html->link(__('List Book Images'), ['action' => 'index'], ['class' => "default-btn floatright"]) ?>
        </div><br>
    <div class="column-responsive column-80">
        <div class="bookImages form content">
            <?= $this->Form->create($bookImage,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Book Image') ?></legend>
                <?php
                    echo $this->Form->control('image',['type' => 'file']);
                    echo $this->Form->control('description');
                    echo $this->Form->control('book_id', ['options' => $books]);
                ?>
            </fieldset>
            <div class="button-box">
                <button type="submit" class="default-btn floatright">Submit</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>
