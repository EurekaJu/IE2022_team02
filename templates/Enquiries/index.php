<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry[]|\Cake\Collection\CollectionInterface $enquiries
 */
echo $this->Html->css('//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js',['block' => true]);
?>

<div class="enquiries index content">
 <div class="container">
     <br>
    <h1 class="cart-heading">Enquiries</h1>
     <div class="button-box">
         <?php
         echo $this->Html->image("/webroot/img/previous.png", [
             "alt" => "back",
             'url' => ['controller' => 'Users', 'action' => 'index']
         ]);
         ?>
     </div>
     <br>
      <div class="table-content table-responsive" >
      <table id = "enquiry-table">
          <thead>
          <tr>
              <!-- <th><?= h('id') ?></th> -->
              <th><?= h('full name') ?></th>
              <th><?= h('body') ?></th>
              <th><?= h('email') ?></th>
              <th><?= h('resolved') ?></th>
              <th><?= h('type') ?></th>
              <th><?= h('time sent') ?></th>
              <th class="actions"><?= __('Actions') ?></th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($enquiry as $enquiry): ?>
              <tr>
                  <!-- <td><?= $this->Number->format($enquiry->id) ?></td> -->
                  <td><?= h($enquiry->full_name) ?></td>
                  <td><?= h($enquiry->body) ?></td>
                  <td><?= h($enquiry->email) ?></td>
                  <td><?= $enquiry->resolved? __('Yes') : __('No') ?> </td>
                  <td><?= h($enquiry->type) ?></td>

                  <td><?= h($enquiry->time_sent) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $enquiry->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $enquiry->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $enquiry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enquiry->id)]) ?>
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
        $('#enquiry-table').DataTable();
     });
</script>
