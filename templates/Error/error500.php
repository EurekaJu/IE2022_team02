<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Database\StatementInterface $error
 * @var string $message
 * @var string $url
 */
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'menufooter';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.php');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
    <strong>SQL Query Params: </strong>
    <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?php if ($error instanceof Error) : ?>
    <strong>Error in: </strong>
    <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    $this->end();
endif;
?>

<div class="error-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 col-xl-6 ms-auto me-auto">
                <div class="error">
                    <div class="error-container">
                        <div class="error form">
                            <?= $this->Flash->render() ?>
                            <div class='container'>
                                <h1 style="text-align:center">OOPS! The page can't be found</h1>
                            </div>
                            <fieldset style="font-size: 20px">
                                <br>
                                <body style="text-align:center; font-size:20px;">This is a 404 error, which means you've clicked on a bad link or entered an invalid URL.</body>
                                <br>
                            </fieldset>
                            <br>
                            <div class="button-box" style="width:90%; margin:0 auto;display: flex;justify-content: center">
                                <?= $this->Html->link(__('Back'), 'javascript:history.back()', ['class' => ['class' => "default-btn middle"]]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<h2><?/*= __d('cake', '404 - THE PAGE CAN"T BE FOUND') */?></h2>
<p class="error">
    <strong><?/*= __d('cake', 'Error') */?>: </strong>
    <?/*= h($message) */?>
</p>-->
