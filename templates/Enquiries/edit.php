<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry $enquiry
 * @var string[]|\Cake\Collection\CollectionInterface $users
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
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Enquiries', 'action' => 'index']
        ]); ?>
<?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $enquiry->id],['class' => "default-btn floatright"],
                ['confirm' => __('Are you sure you want to delete # {0}?', $enquiry->id)]
            ) ?>
<?= $this->Html->link(__('List Enquiries'), ['action' => 'index'], ['class' => "default-btn floatright"]) ?> </button>
        </div>
        </div>
    </aside><br>
    <div class="column-responsive column-80">
        <div class="enquiries form content">
            <?= $this->Form->create($enquiry) ?>
            <fieldset>
                <legend><?= __('Edit Enquiry') ?></legend>
                <?php
                    echo $this->Form->control('full_name',['id' => 'fullname' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$', 'title'=> 'Text Only' ,'label'=>'Full name * ','allowEmpty' => false]);
                    echo $this->Form->control('body');
                    echo $this->Form->control('email');
                    echo $this->Form->control('resolved', array('label' => 'RESOLVED'));
                    echo $this->Form->control('type');
                    echo $this->Form->control('time_sent');
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
                ?>
                <script>
                    var input = document.getElementById('fullname');
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
