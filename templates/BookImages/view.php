<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookImage $bookImage
 */
?>
<style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
</style>
<div class="row">
<div class="container">
    <div class="button-box">
    <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'BooksImages', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('Edit Book Image'), ['action' => 'edit', $bookImage->id], ['class' => 'default-btn floatright']) ?>
        <?= $this->Form->postLink(__('Delete Book Image'), ['action' => 'delete', $bookImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookImage->id), 'class' => 'default-btn floatright']) ?>
        <?= $this->Html->link(__('List Book Images'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        <?= $this->Html->link(__('New Book Image'), ['action' => 'add'], ['class' => 'default-btn floatright']) ?>
    </div>
    <div class="column-responsive column-80">
        <div class="bookImages view content">
        <div class="table-content table-responsive">
            <h3><?= h($bookImage->id) ?></h3>
            <table style="border: 1px solid black ;">
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= $this->Html->image($bookImage->image); ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($bookImage->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Book') ?></th>
                    <td><?= $bookImage->has('book') ? $this->Html->link($bookImage->book->name, ['controller' => 'Books', 'action' => 'view', $bookImage->book->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($bookImage->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
</div>
