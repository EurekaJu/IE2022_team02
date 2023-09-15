<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Footer $footer
 */
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
            'url' => ['controller' => 'Footers', 'action' => 'index']
        ]); ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $footer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $footer->id), 'class' => 'default-btn floatright']
            ) ?>
            <?= $this->Html->link(__('List Footer pages'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        </div>
        </div><br>
    </aside>
    <div class="column-responsive column-80">
        <div class="footers form content">
        <div class="table-content table-responsive">
            <?= $this->Form->create($footer) ?>
            <fieldset>
                <legend><?= __('Edit Footer') ?></legend>
                <?php
                    echo $this->Form->control('title', ['allowEmpty' => false]);
                    echo $this->Form->control('body', ['allowEmpty' => false]);
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
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>