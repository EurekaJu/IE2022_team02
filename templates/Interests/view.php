<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Interest $interest
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
            'url' => ['controller' => 'Interests', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('List Interests'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
    </div>
    <div class="column-responsive column-80">
        <div class="interests view content">
            <br>
            <h3><?= h($interest->first_name) . ' ' . h($interest->last_name) . ' (ID:' . h($interest->id) . ')'?></h3>
            <div class="table-content table-responsive">
            <table style="border: 1px solid black ;">
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($interest->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($interest->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($interest->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($interest->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= h($interest->city) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($interest->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Country') ?></th>
                    <td><?= h($interest->country) ?></td>
                </tr>
                <tr>
                    <th><?= __('Book') ?></th>
                    <td><?= $interest->has('book') ? $this->Html->link($interest->book->name, ['controller' => 'Books', 'action' => 'view', $interest->book->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($interest->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Postcode') ?></th>
                    <td><?= $this->Number->format($interest->postcode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($interest->date->i18nFormat(\IntlDateFormatter::SHORT,'Australia/Melbourne')) ?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
    </div>
</div>
