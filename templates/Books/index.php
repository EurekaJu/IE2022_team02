<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books

 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
$url = '/book-images/add/';
?>
<div class="books index content">
<div class="container">
    <br>
    <h1 class="cart-heading">Books</h1>
    <div class="button-box">
        <?php
        echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Users', 'action' => 'index']
        ]);
        ?>
        <!--
        <?/*= $this->Html->link(__('Admin portal'), ['action' => 'index','controller'=>'Users'],['class' => "default-btn floatright"]) */?>
        -->
        <?= $this->Html->link(__('New Book'), ['action' => 'add'],['class' => "default-btn floatright"]) ?>
        <?= $this->Html->link(__('Add videos to books'), ['controller' => 'Videos', 'action' => 'add'],['class' => "default-btn floatright"]) ?>
        <?= $this->Html->link(__('View book videos'), ['controller' => 'Videos', 'action' => 'index'],['class' => "default-btn floatright"]) ?>
    </div>
    <br>
    <div class="table-content table-responsive">
        <table id="Books-table">
            <thead>
                <tr>
                    <th><?= h('ID') ?></th>
                    <th><?= h('Name') ?></th>
                    <th><?= h('Thumbnail image') ?></th>
                    <th><?= h('Year Published') ?></th>
                    <th><?= h('Summary') ?></th>
                    <th><?= h('Volume') ?></th>
                    <th><?= h('Hardcover price') ?></th>
                    <th><?= h('Softcover price') ?></th>
                    <th><?= h('ebook price') ?></th>
                    <th><?= h('Authors') ?></th>
                    <th><?= h('Genre') ?></th>
                    <th><?= h('Hardcover Quantity') ?></th>
                    <th><?= h('Softcover Quantity') ?></th>
                    <th><?= h('Status') ?></th>
                    <th><?= h('Deposit') ?></th>
                    <th><?= h('Fulfillment type') ?></th>
                    <th><?= h('Keywords') ?></th>
                    <th><?= h('Additional Information')?></th>

                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $this->Number->format($book->id) ?></td>
                    <td><?= h($book->name) ?></td>
                    <td><?= h($book->thumbnail_img) ?></td>
                    <td><?= h($book->year_published) ?></td>
                    <td><?= h(substr($book->summary, 0, 70) . '...'); ?></td>
                    <td><?= h($book->volume) ?></td>
                    <td><?= $this->Number->format($book->hardcover_price) ?></td>
                    <td><?= $this->Number->format($book->softcover_price) ?></td>
                    <td><?= $this->Number->format($book->ebook_price) ?></td>
                    <td><?= h($book->authors) ?></td>
                    <td><?= h($book->genre) ?></td>
                    <td><?= $this->Number->format($book->hardcover_quantity) ?></td>
                    <td><?= $this->Number->format($book->softcover_quantity) ?></td>
                    <td><?= h($book->status) ?></td>
                    <td><?= $this->Number->format($book->deposit) ?></td>
                    <td><?= h($book->fulfillment_type) ?></td>
                    <td><?= h($book->keywords) ?></td>
                    <td><?= h($book->additional_information) ?></td>


                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $book->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $book->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id)]) ?>
                        <br>
                        <?= $this->Html->link( 'AddBookImage', $url) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#Books-table').DataTable();
     });
</script>
