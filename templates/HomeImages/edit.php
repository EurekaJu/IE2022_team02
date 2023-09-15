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

    <div class="button-box">
    <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'HomeImages', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('List Home Images'), ['action' => 'index'], ['class' => "default-btn floatright"]) ?>
        </div><br>
    <div class="column-responsive column-80">
        <div class="homeImages form content">
            <?= $this->Form->create($homeImage,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Home Image') ?></legend>
                <?php
                    echo $this->Form->control('image',['type' => 'file', 'label' => 'Image *']);
                    echo $this->Form->control('title', ['type' => 'hidden']);
                    echo '<br>';
                    echo '<span style="color: #1D8388; font-weight: bold;">Please enter  &ltbr&gt where you wish to have a line break in the text. (E.g. Margalya  ' . "&lt" . "br"  . "&gt Press.)</span>";
                    echo '<br><br>';
                    echo $this->Form->control('heading');
                    echo $this->Form->control('subheading');
                    echo $this->Form->control('body');
                    echo $this->Form->control('button_link', ['label' => 'Button Link * (link for the button, e.g. /books/home)', 'allowEmpty' => false]);
                    echo $this->Form->control('button_text', ['label' => 'Button text * (text displayed on the button, e.g. Home)', 'allowEmpty' => false]);
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
