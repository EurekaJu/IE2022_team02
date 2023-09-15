<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookImage $bookImage
 * @var \Cake\Collection\CollectionInterface|string[] $books
 */
$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>
<div class="row">
<div class="container">
    <aside class="column">
        <div class="side-nav">
        <div class="button-box">
        <?= $this->Html->link(__('List Book Images'), ['action' => 'index'], ['class' => "default-btn floatright"]) ?>
        </div>
    </div><br>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookImages form content">
            <?= $this->Form->create($bookImage,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Book Image') ?></legend>
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
