<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var \Cake\Collection\CollectionInterface|string[] $users
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
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        </div>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orders form content">
            <?= $this->Form->create($order) ?>
            <fieldset>
                <legend><?= __('Add Order') ?></legend>
                <?php
                    echo $this->Form->control('reference_number');
                    echo $this->Form->control('customer_name', ['id' => 'full_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('email');
                    echo $this->Form->control('full_amount');
                    echo $this->Form->control('date');
                    echo $this->Form->control('region');
                    echo $this->Form->control('address');
                    echo $this->Form->control('currency');
                    echo $this->Form->control('status');
                    echo $this->Form->control('time');
                    echo $this->Form->control('book_notes');
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
                    echo $this->Form->control('books._ids', ['options' => $books]);
                ?>
            </fieldset>
            <script>
                var input = document.getElementById('full_name');
                input.oninvalid = function(event) {
                    event.target.setCustomValidity('Please Enter Text Only');
                }
            </script>
            <div class="button-box">
                <button type="submit" class="default-btn floatright">Submit</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>
