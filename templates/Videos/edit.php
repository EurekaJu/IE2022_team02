<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Video $video
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
            'url' => ['controller' => 'Videos', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('New Footer page'), ['action' => 'add'], ['class' => 'default-btn floatright']) ?>
</div>
    <aside class="column">
        <div class="side-nav">
        <div class="button-box">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $video->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $video->id), 'class' => 'default-btn floatright']
            ) ?>
            <?= $this->Html->link(__('List Videos'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        </div>
        </div>  
    </aside>
    <div class="column-responsive column-80">
        <div class="videos form content">
            <?= $this->Form->create($video) ?>
            <fieldset>
                <legend><?= __('Edit Video') ?></legend>
                <?php
                    echo $this->Form->control('name',['id' => 'name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('video', ['row'=> 100,'cols'=>100]);
                    echo $this->Form->control('description');
                    echo $this->Form->control('book_id', ['options' => $books, 'empty' => true]);
                ?>
                <script>
                    var input = document.getElementById('name');
                    input.oninvalid = function(event) {
                        event.target.setCustomValidity('Please Enter Text Only');
                    }
                </script>
            </fieldset>
            <div class="button-box">
                <button type="submit" class="default-btn floatright">Submit</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>