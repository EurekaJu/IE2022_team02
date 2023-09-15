<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $books
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
            'url' => ['controller' => 'Orders', 'action' => 'index']
        ]); ?>
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
            
            </div>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orders form content">
        <div class="table-content table-responsive">
            <?= $this->Form->create($order) ?>
            <fieldset><br>
                <legend><?= __('Edit Order') ?></legend>
                <?php
                    echo $this->Form->control('reference_number');
                    echo $this->Form->control('customer_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('full_amount');
                    echo $this->Form->control('date');
                    echo $this->Form->control('address');
                    echo $this->Form->control('currency');
                    echo $this->Form->control('status');
                    echo $this->Form->control('time');
                    echo $this->Form->control('book_notes');
                    echo $this->Form->control('user_id', ['options' => $usernames, 'empty' => true]);
                    echo $this->Form->control('books._ids', ['options' => $books]);
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
