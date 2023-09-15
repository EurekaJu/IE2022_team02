<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Footer $footer
 */
?>
<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
<div class="row">
<div class="container">
    <aside class="column">
        <div class="side-nav">
        <div class="button-box"><br>
            <?= $this->Html->link(__('List Footer pages'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        </div>
        </div><br>
    </aside>
    <div class="column-responsive column-80">
        <div class="footers form content">
            <?= $this->Form->create($footer,['novalidate'=> true]) ?>
            <fieldset>
                <legend><?= __('Add Footer') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('body', ['row' => 100, 'cols' => 100]);
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