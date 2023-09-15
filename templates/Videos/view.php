<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Video $video
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
</style>
<div class="row">
<div class="container">
    <br>
    <div class="button-box">
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Videos', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('Edit Video'), ['action' => 'edit', $video->id], ['class' => 'default-btn floatright']) ?>
        <?= $this->Form->postLink(__('Delete Video'), ['action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete # {0}?', $video->name), 'class' => 'default-btn floatright']) ?>
        <?= $this->Html->link(__('List Videos'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        <?= $this->Html->link(__('New Video'), ['action' => 'add'], ['class' => 'default-btn floatright']) ?>

    </div>
    <br>
    <div class="column-responsive column-80">
        <div class="Video view content">
            <h3> Video: <?=$video->name ?> (ID: <?= h($video->id) ?>)</h3>
            <div class="table-content table-responsive">
                <br>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($video->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Video') ?></th>
                    <td><?= $video->video ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($video->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Book') ?></th>
                    <td><?= $video->has('book') ? $this->Html->link($video->book->name, ['controller' => 'Books', 'action' => 'view', $video->book->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($video->id) ?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</div>
</div>
