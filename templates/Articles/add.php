<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
$this->Form->setTemplates(['error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>
<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
<div class="row">
<div class="container">
    <aside class="column">
        <div class="side-nav">
        <div class="button-box">
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'],['class' => "default-btn floatright"]) ?>
        </div><br>
    </aside>
    <div class="column-responsive column-80">
        <div class="articles form content">
            <?= $this->Form->create($article,['type'=>'file','novalidate'=> true]) ?>
            <fieldset>
                <legend><?= __('Add Article') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('image',['type' => 'file']);
                    echo $this->Form->control('video',['row'=> 100,'cols'=>100]);
                    echo $this->Form->control('body');
                    echo "<br>";
                    echo $this->Form->control('published', ['label' => 'Tick to publish article']);
                    echo "<br>";
                    echo $this->Form->control('user_id', ['options' => $names, 'empty' => true]);
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
<script>
    $(document).ready(function () {
    ClassicEditor
        .create(document.querySelector('#body'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
         console.error( error );
        });
    });
</script>