<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry $enquiry
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


    <div class="button-box">
    <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Enquiries', 'action' => 'index']
        ]); ?>

    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $enquiry->id], ['class' => 'default-btn floatright']) ?>
    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $enquiry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enquiry->id), 'class' => 'default-btn floatright']) ?>
    <?= $this->Html->link(__('List Enquiries'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
    </div>
    <div class="column-responsive column-80">
        <div class="enquiries view content">
           <br>
            <table id = "enquiryview-table">
                <tr>
                    <th><?= __('Full Name') ?></th>
                    <td><?= h($enquiry->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Body') ?></th>
                    <td><?= h($enquiry->body) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($enquiry->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($enquiry->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $enquiry->has('user') ? $this->Html->link($enquiry->user->id, ['controller' => 'Users', 'action' => 'view', $enquiry->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($enquiry->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Resolved') ?></th>
                    <td><?= $this->Number->format($enquiry->resolved) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time Sent') ?></th>
                    <td><?= h($enquiry->time_sent) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function () {
        $('#enquiryview-table').DataTable();
     });
</script>