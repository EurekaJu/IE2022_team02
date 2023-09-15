<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Interest[]|\Cake\Collection\CollectionInterface $interests
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<div class="interests index content">
    <div class="container">
        <!-- <?= $this->Html->link(__('New Interest'), ['action' => 'add'], ['class' => 'button float-right']) ?> -->
                <h1 class="cart-heading">Registrations of Interest</h1>
        <div class="button-box">
            <?php
            echo $this->Html->image("/webroot/img/previous.png", [
                "alt" => "back",
                'url' => ['controller' => 'Users', 'action' => 'index']
            ]);
            ?>
         </div>
                
                    <div class="table-content table-responsive" >
                        <table id="Interests-table">
                            <thead>
                                <tr>
                                <!-- <th><?= h('ID') ?></th> -->
                                <th><?= h('Date') ?></th>
                                <th><?= h('Email') ?></th>
                                <th><?= h('First name') ?></th>
                                <th><?= h('Last name') ?></th>
                                <th><?= h('Address') ?></th>
                                <th><?= h('Book ID') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($interests as $interest): ?>
                                <tr>
                                <!-- <td><?= $this->Number->format($interest->id) ?></td> -->
                                <td><?= h($interest->date) ?></td>
                                <td><?= h($interest->email) ?></td>
                                <td><?= h($interest->first_name) ?></td>
                                <td><?= h($interest->last_name) ?></td>
                                <td><?= h(substr($interest->address . ', ' . $interest->city . ', ' . $interest->state . ', ' . $this->Number->format($interest->postcode) .  ', ' . $interest->country, 0, 20) . '...') ?></td>
                                <td><?= $interest->has('book') ? $this->Html->link($interest->book->name, ['controller' => 'Books', 'action' => 'view', $interest->book->id]) : '' ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $interest->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $interest->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $interest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $interest->id)]) ?>
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
        $('#Interests-table').DataTable();
     });
</script>
