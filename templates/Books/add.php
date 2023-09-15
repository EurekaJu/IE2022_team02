<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 * @var \Cake\Collection\CollectionInterface|string[] $orders
 */
$options = [
    'interest' => 'interest',
    'Pre-Order' => 'Pre-Order',
    'Out of Stock' => 'Out of Stock',
    'Available' => 'Available',];
$options2 = [
    '' => 'interest',
    'Print-On-Demand' => 'Print-On-Demand',
    'Drop-Shipping' => 'Drop-Shipping',];

$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>





<div class="row">
<div class="container">
    <aside class="column">
        <div class="side-nav">
        <div class="button-box">
        <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        </div></div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books form content">
            <?= $this->Form->create($book,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Book') ?></legend>
                <?php
                    echo $this->Form->control('name',['label' => 'Name (Please include the volume number if applicable to display, E.g. My book (Vol 1)).','allowEmpty' => false]);
                    echo $this->Form->control('thumbnail_img',['type' => 'file']);
//                    debug($book->thumbnail_img);
                    echo $this->Form->control('year_published',['type' => 'number']);
                    echo $this->Form->control('summary');
                    echo $this->Form->control('volume', ['label' => 'Volume (If there is no volume, please add the number 0.)']);
                    echo $this->Form->control('hardcover_price');
                    echo $this->Form->control('softcover_price');
                    echo $this->Form->control('ebook_price');
                    echo $this->Form->control('authors');
                    echo $this->Form->control('genre',['label' => 'Genre (please enter a dash when there are spaces)','id' => 'genre' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false, 'placeholder' => 'Enter one main genre']);
                    echo $this->Form->control('hardcover_quantity', ['allowEmpty' => false]);
                    echo $this->Form->control('softcover_quantity', ['allowEmpty' => false]);
                echo $this->Form->label('status');
                    echo $this->Form->select('status',$options, ['empty' => '(choose one)']);
                    echo $this->Form->label('fulfillment_type');
                echo $this->Form->select('fulfillment_type',$options2, ['empty' => '(choose one)']);
                echo $this->Form->control('deposit',['label'=>'Deposit (Deposit is ONLY used when book is Pre-Order status. E.g. Enter 20 for a 20% deposit)', 'allowEmpty' => false]);
                    echo $this->Form->control('keywords');
                echo $this->Form->control('additional_information', ['label'=>'Additional Information','allowEmpty' => true,'row'=> 100,'cols'=>100]);


                ?>
                <script>
                    // var input = document.getElementById('name');
                    var input2 = document.getElementById('genre');
                    // input.oninvalid = function(event) {
                    //     event.target.setCustomValidity('Please Enter Text Only');
                    // }
                    input2.oninvalid = function(event) {
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
