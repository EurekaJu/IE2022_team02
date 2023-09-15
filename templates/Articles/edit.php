<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<div class="row">
<div class="container">

    <aside class="column">
        <div class="side-nav">
        <div class="button-box">
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Articles', 'action' => 'index']
        ]); ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $article->id],['class' => "default-btn floatright"],
                ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]
            ) ?>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'],['class' => "default-btn floatright"]) ?></div>
        </div><br>
    </aside>
    <div class="column-responsive column-80">
        <div class="articles form content">
        <div class="table-content table-responsive">
            <?= $this->Form->create($article,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Article') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('image',['type' => 'file']);
                    echo $this->Form->control('video', ['row'=> 100,'cols'=>100]);
                    echo $this->Form->control('body');
                    echo $this->Form->control('published');
                    echo $this->Form->control('user_id', ['options' => $usernames, 'empty' => true]);
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
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>