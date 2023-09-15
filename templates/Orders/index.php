<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $orders
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<div class="orders index content">
<div class="container">
    <!-- <?= $this->Html->link(__('New Order'), ['action' => 'add'], ['class' => 'button float-right']) ?> -->
    <h1 class="cart-heading">Orders</h1>
        <div class="button-box">
            <?php
            echo $this->Html->image("/webroot/img/previous.png", [
                "alt" => "back",
                'url' => ['controller' => 'Users', 'action' => 'index']
            ]);
            ?>
    <div class="table-responsive">
        <table id="Orders-table">
            <thead>
                <tr>
                    <!-- <th><?= h('ID') ?></th> -->
                    <th><?= h('Reference number') ?></th>
                    <th><?= h('Customer name') ?></th>
                    <th><?= h('Email') ?></th>
                    <th><?= h('Full amount') ?></th>
                    <th><?= h('Date') ?></th>
                    <th><?= h('Address') ?></th>
                    <th><?= h('Currency') ?></th>
                    <th><?= h('Status') ?></th>
                    <th><?= h('Time') ?></th>
                    <th><?= h('Book Details') ?></th>
                    <th><?= h('User') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <!-- <td><?= $this->Number->format($order->id) ?></td> -->
                    <td><?= h($order->reference_number) ?></td>
                    <td><?= h($order->customer_name) ?></td>
                    <td><?= h(substr($order->email,0,10) . '...')?></td>
                    <td><?= $this->Number->format($order->full_amount) ?></td>
                    <td><?= h($order->date) ?></td>
                    <td><?= h(substr($order->address,0,50) . '...') ?></td>
                    <td><?= h($order->currency) ?></td>
                    <td><?= h($order->status) ?></td>
                    <td><?= h($order->time) ?></td>
                    <td><?= h(substr($order->book_notes, 0, 50) . '...') ?></td>
                    <td><?= $order->has('user') ? $this->Html->link($order->user->first_name . ' ' . $order->user->last_name, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
                        <!-- <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> -->
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
        $('#Orders-table').DataTable();
     });
</script>
