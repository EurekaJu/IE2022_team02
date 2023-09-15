<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
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
            'url' => ['controller' => 'Orders', 'action' => 'index']
        ]); ?>
        <div class="side-nav">
            <br><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id], ['class' => 'default-btn floatright']) ?>
             <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
        </div>
    </div><br>
    <div class="column-responsive column-80">
        <div class="orders view content">
            <h3><?= 'Reference Number: ' . h($order->reference_number) . ' (Order ID: ' . h($order->id) .')'?></h3>
            <table style="border: 1px solid black ;">
                <tr>
                    <th><?= __('Reference Number') ?></th>
                    <td><?= h($order->reference_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer Name') ?></th>
                    <td><?= h($order->customer_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($order->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($order->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Currency') ?></th>
                    <td><?= h($order->currency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($order->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $order->has('user') ? $this->Html->link($order->user->first_name . ' ' . $order->user->last_name, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($order->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Full Amount') ?></th>
                    <td><?= $this->Number->format($order->full_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($order->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time') ?></th>
                    <td><?= h($order->time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Book Notes') ?></th>
                    <td><?= h($order->book_notes) ?></td>
                </tr>
            </table>
            <!-- <div class="related">
                <h4><?= __('Related Books') ?></h4>
                <?php if (!empty($order->books)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Thumbnail Img') ?></th>
                            <th><?= __('Year Published') ?></th>
                            <th><?= __('Summary') ?></th>
                            <th><?= __('Volume') ?></th>
                            <th><?= __('Hardcover Price') ?></th>
                            <th><?= __('Softcover Price') ?></th>
                            <th><?= __('Ebook Price') ?></th>
                            <th><?= __('Authors') ?></th>
                            <th><?= __('Genre') ?></th>
                            <th><?= __('Hardcover quantity') ?></th>
                            <th><?= __('Softcover quantity') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Fulfillment Type') ?></th>
                            <th><?= __('Keywords') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->books as $books) : ?>
                        <tr>
                            <td><?= h($books->id) ?></td>
                            <td><?= h($books->name) ?></td>
                            <td><?= h($books->thumbnail_img) ?></td>
                            <td><?= h($books->year_published) ?></td>
                            <td><?= h($books->summary) ?></td>
                            <td><?= h($books->volume) ?></td>
                            <td><?= h($books->hardcover_price) ?></td>
                            <td><?= h($books->softcover_price) ?></td>
                            <td><?= h($books->ebook_price) ?></td>
                            <td><?= h($books->authors) ?></td>
                            <td><?= h($books->genre) ?></td>
                            <td><?= h($books->hardcover_quantity) ?></td>
                            <td><?= h($books->softcover_quantity) ?></td>
                            <td><?= h($books->status) ?></td>
                            <td><?= h($books->fulfillment_type) ?></td>
                            <td><?= h($books->keywords) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Books', 'action' => 'view', $books->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Books', 'action' => 'edit', $books->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Books', 'action' => 'delete', $books->id], ['confirm' => __('Are you sure you want to delete # {0}?', $books->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div> -->
            <br>
        </div>
    </div>
</div>
</div>