<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookSubmission $bookSubmission
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
            'url' => ['controller' => 'BookSubmissions', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('Edit Book Submission'), ['action' => 'edit', $bookSubmission->id], ['class' => 'default-btn floatright']) ?>
        <?= $this->Form->postLink(__('Delete Book Submission'), ['action' => 'delete', $bookSubmission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookSubmission->id), 'class' => 'default-btn floatright']) ?>
        <?= $this->Html->link(__('List Book Submissions'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        </div>
    <div class="column-responsive column-80">
        <div class="bookSubmissions view content">
        <div class="table-content table-responsive">
            <h3><?= h($bookSubmission->title) ?></h3>
            <table style="border: 1px solid black ;">
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $bookSubmission->has('user') ? $this->Html->link($bookSubmission->user->id, ['controller' => 'Users', 'action' => 'view', $bookSubmission->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Full Name') ?></th>
                    <td><?= h($bookSubmission->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($bookSubmission->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($bookSubmission->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($bookSubmission->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Language') ?></th>
                    <td><?= h($bookSubmission->language) ?></td>
                </tr>
                <tr>
                    <th><?= __('Complete') ?></th>
                    <td><?= h($bookSubmission->complete) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($bookSubmission->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Explanation') ?></th>
                    <td><?= h($bookSubmission->explanation) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($bookSubmission->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time Sent') ?></th>
                    <td><?= h($bookSubmission->time_sent->i18nFormat(\IntlDateFormatter::SHORT,'Australia/Melbourne')) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
</div>
