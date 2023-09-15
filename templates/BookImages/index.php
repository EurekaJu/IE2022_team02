<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookImage[]|\Cake\Collection\CollectionInterface $bookImages
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<div class="bookImages index content">
<div class="container">
    <br>
    <h1 class="cart-heading">Book Images</h1>
    <div class="button-box">
        <?php
        echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Users', 'action' => 'index']
        ]);
        ?>
        <!--
        <?/*= $this->Html->link(__('Admin portal'), ['action' => 'index', 'controller'=>'Users'], ['class' => ['class' => "default-btn floatright"]]) */?>
        -->
        <?= $this->Html->link(__('New Book Image'), ['action' => 'add'], ['class' => ['class' => "default-btn floatright"]]) ?>
    </div>
    <br>
    <div class="table-content table-responsive">
        <table id="BookImages-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('book_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookImages as $bookImage): ?>
                <tr>
                    <td><?= $this->Number->format($bookImage->id) ?></td>
                    <td><?= h($bookImage->image) ?></td>
                    <td><?= h($bookImage->description) ?></td>
                    <td><?= $bookImage->has('book') ? $this->Html->link($bookImage->book->name, ['controller' => 'Books', 'action' => 'view', $bookImage->book->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $bookImage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookImage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookImage->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#BookImages-table').DataTable();
     });
</script>
