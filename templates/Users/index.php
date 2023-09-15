<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<style>
.grid-container {
  display: grid;
  gap: 5px;
  grid-template-columns: auto auto auto;
  width: 30%;
  margin: auto;
}

.grid-item {
  width:100px;
  height:50px;
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 5px;
  text-align: center;
  line-height: 20px;
  border-radius: 10px;
}
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #686868;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 20px;
    color: #f1f1f1;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #818181;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
</style>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <?php
    $session = $this->request->getSession();
    $userRole = $session->read('userRole');
    $userId = $session->read('userId');
    if ($userRole == 'absolute') { ?>
        <?= $this->Html->link(__('Create New User'), ['action' => 'adminadd']) ?>
        <?php
    }
        else { ?>
        <?= $this->Html->link(__('Create New User'), ['action' => 'add']) ?>
    <?php
    }
    ?>
    <?= $this->Html->link(__('Enquiries'), ['controller' => 'enquiries', 'action' => 'index']) ?>
    <?= $this->Html->link(__('Interests'), ['controller' => 'interests', 'action' => 'index']) ?>
    <?= $this->Html->link('Book Submissions', ['controller' => 'bookSubmissions', 'action' => 'index']) ?>
    <?= $this->Html->link('Books', ['controller' => 'books', 'index']) ?>
    <?= $this->Html->link('Book Images', ['controller' => 'bookImages', 'action' => 'index']) ?>
    <?= $this->Html->link('Articles', ['controller' => 'articles', 'action' => 'index']) ?>
    <?= $this->Html->link('Orders', ['controller' => 'orders', 'action' => 'index']) ?>
    <?= $this->Html->link('Footer Page', ['controller' => 'footers']) ?>
    <?= $this->Html->link('Edit Home page images', ['controller' => 'homeImages']) ?>
    <?= $this->Html->link('Edit My Profile', ['controller' => 'users', 'action' => 'customeredit', $userId]) ?>
</div>

<div class='container'>
    <h1 style="text-align:center">Admin Portal</h1>
</div>
<!--<br>-->
<!--    <span style="font-size:30px;cursor:pointer;alignment: center"  onclick="openNav()">&#9776; Menu</span>-->
<!--    <script>-->
<!--        function openNav() {-->
<!--            document.getElementById("mySidenav").style.width = "250px";-->
<!--        }-->
<!---->
<!--        function closeNav() {-->
<!--            document.getElementById("mySidenav").style.width = "0";-->
<!--        }-->
<!--    </script>-->
<!--</div>-->
<br>
<?php
if ($userRole == 'admin'|| $userRole == 'editor') {
?>
<div class="Users index content">
    <div class="container">
        <h1 class="cart-heading">Customer Details</h1>
        <div class="table-content table-responsive">
            <table id="Users-table">
                <thead>
                <tr>
                    <!-- <th><?= h('ID') ?></th> -->
                    <th><?= h('First name') ?></th>
                    <th><?= h('Last name') ?></th>
                    <th><?= h('Email') ?></th>
                    <th><?= h('Mobile Number') ?></th>
                    <th><?= h('Address') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user):
                    if ($user->role == 'customer'){
                    ?>

                    <tr>
                        <!-- <td><?= $this->Number->format($user->id) ?></td> -->
                        <!-- <td><?= $user->has('user') ? $this->Html->link($user->user->id, ['controller' => 'Users', 'action' => 'view', $user->user->id]) : '' ?></td> -->
                        <td><?= h($user->first_name) ?></td>
                        <td><?= h($user->last_name) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->mobile_number) ?></td>
                        <td><?= h(substr($user->street_number .  ' ' . $user->street_name . ', ' . $user->suburb . ', ' . $user->city . ' ' . $user->postcode . ', ' . $user->state .  ' ' . $user->country, 0, 50) . '...'); ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                        </td>
                    </tr>
                <?php
                    }
                endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}
else {
?>
    <div class="Users index content">
        <div class="container">
            <h1 class="cart-heading">Staff and Customer Details</h1>
            <div class="table-content table-responsive">
                <table id="Users-table">
                    <thead>
                    <tr>
                        <!-- <th><?= h('ID') ?></th> -->
                        <th><?= h('First name') ?></th>
                        <th><?= h('Last name') ?></th>
                        <th><?= h('Email') ?></th>
                        <th><?= h('Mobile Number') ?></th>
                        <th><?= h('Address') ?></th>
                        <th><?= h('Role') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user):
                            ?>
                            <tr>
                                <!-- <td><?= $this->Number->format($user->id) ?></td> -->
                                <!-- <td><?= $user->has('user') ? $this->Html->link($user->user->id, ['controller' => 'Users', 'action' => 'view', $user->user->id]) : '' ?></td> -->
                                <td><?= h($user->first_name) ?></td>
                                <td><?= h($user->last_name) ?></td>
                                <td><?= h($user->email) ?></td>
                                <td><?= h($user->mobile_number) ?></td>
                                <td><?= h(substr($user->street_number .  ' ' . $user->street_name . ', ' . $user->suburb . ', ' . $user->city . ' ' . $user->postcode . ', ' . $user->state .  ' ' . $user->country, 0, 50) . '...'); ?></td>
                                <td><?= h($user->role) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete {0}?', $user->first_name . ' ' . $user->last_name)]) ?>
                                </td>
                            </tr>
                            <?php
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
}
?>

    <script>
        $(document).ready(function () {
            $('#Users-table').DataTable();
        });
    </script>
