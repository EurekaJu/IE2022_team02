<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<style>
table, th, td {
  border: 1px solid;
}

table.center {
    margin-left: auto;
    margin-right: auto;
}
</style>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <!--
            <h4 class="heading"><?/*= __('Actions') */?></h4>
            <?/*= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) */?>
            <?/*= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) */?>
            <?/*= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) */?>
            <?/*= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) */?>
            -->
        </div>
    </aside>

    <div class='container'>
        <?php
        $session = $this->request->getSession();
        $userRole = $session->read('userRole');
        if ($userRole == 'customer') {
            ?>
            <h1 style="text-align:center">My Profile</h1>
            <?php
        } else {
            ?>
            <h1 style="text-align:center">User Profile</h1>
            <?php
        }
        ?>
    </div>
    <div class='container' style="width:90%; margin:0 auto;display: flex;justify-content: center;">
        <div class="button-box">
            <br>
            <?php
            if ($userRole == 'customer') {
                ?>
                <?= $this->Html->link(__('Edit My Profile'), ['action' => 'customeredit', $user->id], ['class' => "default-btn floatright"]) ?>
                <?= $this->Form->postLink(__('Delete my account'), ['action' => 'delete', $user->id], ['confirm' => __('You are about to permanently delete your account. Your profile and related account information will be deleted from our site. Click OK to confirm.', $user->id), 'class' => "default-btn floatright"]) ?>
                <?php
            } elseif ($userRole == 'absolute') {
                ?>
                <?= $this->Html->link(__('Edit this Profile'), ['action' => 'edit', $user->id], ['class' => "default-btn floatright"]) ?>
                <?= $this->Form->postLink(__('Delete this account'), ['action' => 'delete', $user->id], ['confirm' => __('You are about to permanently delete this account. The profile and related account information will be deleted from our site. Click OK to confirm.', $user->id), 'class' => "default-btn floatright"]) ?>
                <?php
            } else {
                ?>
                <?= $this->Html->link(__('Edit this Profile'), ['action' => 'edit', $user->id], ['class' => "default-btn floatright"]) ?>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="column-responsive column-80 pt-40 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="users view content">
                        <h3><?= 'Welcome, ' . h($user->first_name) . ' ' . h($user->last_name) ?></h3>
                        <table class="center">
                            <tr>
                                <th><?= __('Email') ?></th>
                                <td><?= h($user->email) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('First Name') ?></th>
                                <td><?= h($user->first_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Last Name') ?></th>
                                <td><?= h($user->last_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Mobile Number') ?></th>
                                <td><?= h($user->mobile_number) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Street Name') ?></th>
                                <td><?= h($user->street_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Suburb') ?></th>
                                <td><?= h($user->suburb) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('City') ?></th>
                                <td><?= h($user->city) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('State') ?></th>
                                <td><?= h($user->state) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Country') ?></th>
                                <td><?= h($user->country) ?></td>
                            </tr>
                            <!--<tr>
                    <th><? /*= __('Role') */ ?></th>
                    <td><? /*= h($user->role) */ ?></td>
                </tr>
                <tr>
                    <th><? /*= __('Id') */ ?></th>
                    <td><? /*= $this->Number->format($user->id) */ ?></td>
                </tr>-->
                            <tr>
                                <th><?= __('Street Number') ?></th>
                                <td><?= $this->Number->format($user->street_number) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Postcode') ?></th>
                                <td><?= $this->Number->format($user->postcode) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- <div class="related">
                <?php if (!empty($user->articles)) : ?>
                    <h4><?= __('Related Articles') ?></h4>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Published') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->articles as $articles) : ?>
                        <tr>
                            <td><?= h($articles->id) ?></td>
                            <td><?= h($articles->title) ?></td>
                            <td><?= h($articles->body) ?></td>
                            <td><?= h($articles->published) ?></td>
                            <td><?= h($articles->created) ?></td>
                            <td><?= h($articles->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $articles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $articles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div> -->
            <div class="related">
                <?php if (!empty($user->enquiries)) : ?>
                    <h4><?= __('Related Enquiries') ?></h4>
                <div class="table-responsive">
                    <table class="center">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Full Name') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Resolved') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Time Sent') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->enquiries as $enquiries) : ?>
                        <tr>
                            <td><?= h($enquiries->id) ?></td>
                            <td><?= h($enquiries->full_name) ?></td>
                            <td><?= h($enquiries->body) ?></td>
                            <td><?= h($enquiries->email) ?></td>
                            <td><?= h($enquiries->resolved) ?></td>
                            <td><?= h($enquiries->type) ?></td>
                            <td><?= h($enquiries->time_sent) ?></td>
                            <td><?= h($enquiries->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Enquiries', 'action' => 'view', $enquiries->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Enquiries', 'action' => 'edit', $enquiries->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Enquiries', 'action' => 'delete', $enquiries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enquiries->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related pt-20">
                <br>
            <h4><?= __('My Order History') ?></h4>
                <?php if (!empty($user->orders)) : ?>
                <div class="table-responsive pt-10">
                    <table class="center">
                        <tr>
                            <th><?= __('Reference Number') ?></th>
                            <th><?= __('Customer Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Paid Amount') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Shipping Address') ?></th>
                            <th><?= __('Currency') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Time') ?></th>
                            <th><?=__('Books Notes')?></th>
                        </tr>
                        <?php foreach ($user->orders as $orders) : ?>
                        <tr>
                            <td><?= h($orders->reference_number) ?></td>
                            <td><?= h($orders->customer_name) ?></td>
                            <td><?= h($orders->email) ?></td>
                            <td>$<?= h($orders->full_amount) ?></td>
                            <td><?= h($orders->date) ?></td>
                            <td><?= h($orders->address) ?></td>
                            <td><?= h($orders->currency) ?></td>
                            <td><?= h($orders->status) ?></td>
                            <td><?= h($orders->time) ?></td>
                            <td><?= h($orders->book_notes)?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

