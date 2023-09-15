<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HomeImage $homeImage
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
            'url' => ['controller' => 'HomeImages', 'action' => 'index']
        ]); ?>
        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $homeImage->id], ['class' => 'default-btn floatright']) ?>

        <?= $this->Html->link(__('List Home Page Images'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
    </div>
    <div class="column-responsive column-80">
        <div class="homeImages view content">
        <div class="table-content table-responsive">
            <h3><?= h($homeImage->title) ?></h3>
            <table style="border: 1px solid black ;">
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= $this->Html->image($homeImage->image); ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= $homeImage->title ?></td>
                </tr>
                <tr>
                    <th><?= __('Heading') ?></th>
                    <td><?= $homeImage->heading ?></td>
                </tr>
                <tr>
                    <th><?= __('Subheading') ?></th>
                    <td><?= $homeImage->subheading ?></td>
                </tr>
                <tr>
                    <th><?= __('Body') ?></th>
                    <td><?= $homeImage->body ?></td>
                </tr>
                <tr>
                    <th><?= __('Button Link') ?></th>
                    <td><?= h($homeImage->button_link) ?></td>
                </tr>
                <tr>
                    <th><?= __('Button Text') ?></th>
                    <td><?= h($homeImage->button_text) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
</div>
