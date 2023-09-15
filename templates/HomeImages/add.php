<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HomeImage $homeImage
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
        <?= $this->Html->link(__('List Home Page Images'), ['action' => 'index'], ['class' => "default-btn floatright"]) ?>
        </div>
    </div><br>
    </aside>
    <div class="column-responsive column-80">
        <div class="homeImages form content">
            <?= $this->Form->create($homeImage,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Home Page Image') ?></legend>
                <?php
                    echo $this->Form->control('image',['type' => 'file']);
                    echo $this->Form->control('title');
                    echo $this->Form->control('heading');
                    echo $this->Form->control('subheading');
                    echo $this->Form->control('body');
                    echo $this->Form->control('button_link');
                    echo $this->Form->control('button_text');
                ?>
            </fieldset>
            <div class="button-box">
                <button type="submit" class="default-btn floatright">Submit</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
