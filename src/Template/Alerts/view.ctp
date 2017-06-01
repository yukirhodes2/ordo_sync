<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Alert'), ['action' => 'edit', $alert->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Alert'), ['action' => 'delete', $alert->id], ['confirm' => __('Are you sure you want to delete # {0}?', $alert->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Alerts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Alert'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="alerts view large-9 medium-8 columns content">
    <h3><?= h($alert->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Libelle') ?></th>
            <td><?= h($alert->libelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($alert->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Timer') ?></th>
            <td><?= h($alert->first_timer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Timer') ?></th>
            <td><?= h($alert->second_timer) ?></td>
        </tr>
    </table>
</div>
