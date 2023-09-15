<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Video $video
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
            <br><?= $this->Html->link(__('List Videos'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?><br>
        <br></div>
    </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="videos form content">
            <?= $this->Form->create($video) ?>
            <fieldset>
                <legend><?= __('Add Video') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('video',['row'=> 100,'cols'=>100, 'label' => 'Video (Open the Youtube Video, click Share, click Embed, click COPY. Paste the text from clipboard into the textbox below).']);
                    echo $this->Form->control('description');
                    echo $this->Form->control('book_id', ['options' => $books, 'empty' => true]);
                ?>
            </fieldset>
            <div class="button-box">
                <button type="submit" class="default-btn floatright">Submit</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</container>