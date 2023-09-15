<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookSubmission $bookSubmission
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>
<div class="row">
<div class="container">

        <div class="side-nav">
        <div class="button-box">
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'BookSubmissions', 'action' => 'index']
        ]); ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bookSubmission->id], ['class' => "default-btn floatright"],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bookSubmission->id)]
            ) ?>
            <?= $this->Html->link(__('List Book Submissions'), ['action' => 'index'], ['class' => "default-btn floatright"]) ?></button>
        </div>
        </div><br>
    <div class="column-responsive column-80">
        <div class="bookSubmissions form content">
            <?= $this->Form->create($bookSubmission) ?>
            <fieldset>
                <legend><?= __('Edit Book Submission') ?></legend>
                <?php
                    // echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
                    echo $this->Form->control('full_name',['label'=>'Full name *','id' => 'full_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('email');
                    // echo $this->Form->control('time_sent');
                    echo $this->Form->control('title',['id' => 'title' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('role',['id' => 'role' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('language',['label'=>'What language is it in? *','id' => 'language' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('complete');
                    echo $this->Form->control('description');
                    echo $this->Form->control('explanation');
                ?>
                <script>
                    var input = document.getElementById('full_name');
                    var input2 = document.getElementById('language');
                    var input3 = document.getElementById('title');
                    var input4 = document.getElementById('role');
                    input.oninvalid = function(event) {
                        event.target.setCustomValidity('Please Enter Text Only');
                    }
                    input2.oninvalid = function(event) {
                        event.target.setCustomValidity('Please Enter Text Only');
                    }
                    input3.oninvalid = function(event) {
                        event.target.setCustomValidity('Please Enter Text Only');
                    }
                    input4.oninvalid = function(event) {
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
