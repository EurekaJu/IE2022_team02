<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HomeImage[]|\Cake\Collection\CollectionInterface $homeImages
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<div class="homeImages index content">
<div class="container">
    <br>
    <div class="button-box">
        <?php
        echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Users', 'action' => 'index']
        ]);
        ?>
    </div>
    <br>
    <br>
    <h1 class="cart-heading">Home Image Pages </h1>       
            <table id ="HomeImages-table">
                <thead>
                    <tr>
                        <th><?= h('Title') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($homeImages as $homeImage): ?>
                    <tr>
                        <td><?= h($homeImage->title) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $homeImage->id]) ?>
                            <?= $this->Html->link(__('View'), ['action' => 'view', $homeImage->id]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>                      
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#HomeImages-table').DataTable();
     });
</script>
