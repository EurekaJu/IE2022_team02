<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Footer[]|\Cake\Collection\CollectionInterface $footers
 */
echo $this->Html->css('//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js',['block' => true]);
?>
<div class="footers index content">
    <div class="container">
    <div class="button-box">
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Users', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('New Footer page'), ['action' => 'add'], ['class' => 'default-btn floatright']) ?>
    </div>
    <br>
    <h1 class="cart-heading">Footer Pages (Useful Links)</h1>       
            <table id ="footers-table">
                <thead>
                    <tr>
                        <th><?= h('title') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($footers as $footer): ?>
                    <tr>
                        <td><?= h($footer->title) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $footer->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $footer->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $footer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $footer->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>                      
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#footers-table').DataTable();
     });
</script>
