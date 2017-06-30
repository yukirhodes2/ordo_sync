<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $log->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $log->id], ['confirm' => __('Voulez-vous vraiment supprimer ce log ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des logs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouveau log'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="logs view large-9 medium-8 columns content">
    <h3><?= h($log->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $log->has('user') ? $this->Html->link($log->user->username, ['controller' => 'Users', 'action' => 'view', $log->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($log->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt') ?></th>
            <td><?= h($log->dt) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($log->content)); ?>
    </div>
</div>
