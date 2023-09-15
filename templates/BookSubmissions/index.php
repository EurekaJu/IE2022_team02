<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookSubmission[]|\Cake\Collection\CollectionInterface $bookSubmissions
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<div class="bookSubmissions index content">
<div class="container">
    <br>
<h1 class="cart-heading">Book Submissions</h1>
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
    </div>
    <br>
    <div class="table-content table-responsive">
        <table id="BookSubmissions-table">
            <thead>
                <tr>
                    <!-- <th><?= h('ID') ?></th> -->
                    <!-- <th><?= h('user_id') ?></th> -->
                    <th><?= h('Full name') ?></th>
                    <th><?= h('Email') ?></th>
                    <th><?= h('Time sent') ?></th>
                    <th><?= h('Title') ?></th>
                    <th><?= h('Role') ?></th>
                    <th><?= h('Language') ?></th>
                    <th><?= h('Complete') ?></th>
                    <th><?= h('Description') ?></th>
                    <th><?= h('Explanation') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookSubmissions as $bookSubmission): ?>
                <tr>
                    <!-- <td><?= $this->Number->format($bookSubmission->id) ?></td> -->
                    <!-- <td><?= $bookSubmission->has('user') ? $this->Html->link($bookSubmission->user->id, ['controller' => 'Users', 'action' => 'view', $bookSubmission->user->id]) : '' ?></td> -->
                    <td><?= h($bookSubmission->full_name) ?></td>
                    <td><?= h($bookSubmission->email) ?></td>
                    <td><?= h($bookSubmission->time_sent) ?></td>
                    <td><?= h($bookSubmission->title) ?></td>
                    <td><?= h($bookSubmission->role) ?></td>
                    <td><?= h($bookSubmission->language) ?></td>
                    <td><?= h($bookSubmission->complete) ?></td>
                    <td><?= h($bookSubmission->description) ?></td>
                    <td><?= h($bookSubmission->explanation) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $bookSubmission->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookSubmission->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookSubmission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookSubmission->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#BookSubmissions-table').DataTable();
     });
</script>
