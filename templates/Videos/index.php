<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Video[]|\Cake\Collection\CollectionInterface $videos
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<div class="videos index content">
<div class="container">
<br>
    <div class="button-box">
    <?= $this->Html->link(__('New Video'), ['action' => 'add'], ['class' => 'default-btn floatright']) ?>
    </div><br>
    <h1 class="cart-heading">Videos</h1>
        <div class="button-box">
            <?php
            echo $this->Html->image("/webroot/img/previous.png", [
                "alt" => "back",
                'url' => ['controller' => 'Users', 'action' => 'index']
            ]);
            ?>
    <div class="table-responsive">
        <table id="Videos-table">
            <thead>
                <tr>
                    <th><?= h('ID') ?></th>
                    <th><?= h('Name') ?></th>
                    <th><?= h('Video') ?></th>
                    <th><?= h('Description') ?></th>
                    <th><?= h('Book ID') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($videos as $video): ?>
                <tr>
                    <td><?= $this->Number->format($video->id) ?></td>
                    <td><?= h($video->name) ?></td>
                    <td><?= h(substr($video->video, 0, 70) . '...'); ?></td>
                    <td><?= h($video->description) ?></td>
                    <td><?= $video->has('book') ? $this->Html->link($video->book->name, ['controller' => 'Books', 'action' => 'view', $video->book->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $video->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $video->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete # {0}?', $video->id)]) ?>
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
        $('#Videos-table').DataTable();
     });
</script>