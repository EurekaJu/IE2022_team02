<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<div class="articles index content">
<div class="container">
    <div class="button-box">
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Users', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'default-btn floatright']) ?>
    </div>
    <br>
    <h1 class="cart-heading">Articles</h1>
    <div class="table-responsive">
        <table id="Articles-table">
            <thead>
                <tr>
                    <!-- <th><?= h('ID') ?></th> -->
                    <th><?= h('Title') ?></th>
                    <th><?= h('Image') ?></th>
                    <th><?= h('Video') ?></th>
                    <th><?= h('Published') ?></th>
                    <th><?= h('Created') ?></th>
                    <th><?= h('User') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <!-- <td><?= $this->Number->format($article->id) ?></td> -->
                    <td><?= h($article->title) ?></td>
                    <td><?= h($article->image) ?></td>
                    <td><?= $article->video ?></td>
                    <td><?= h($article->published) ?></td>
                    <td><?= h($article->created) ?></td>
                    <td><?= $article->has('user') ? $this->Html->link($article->user->first_name . ' ' . $article->user->last_name, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
        $('#Articles-table').DataTable();
     });
</script>