<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rdrf'), ['action' => 'edit', $rdrf->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rdrf'), ['action' => 'delete', $rdrf->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rdrf->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rdrfs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rdrf'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rdrfs view large-9 medium-8 columns content">
    <h3><?= h($rdrf->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Libelle') ?></th>
            <td><?= h($rdrf->libelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rdrf->id) ?></td>
        </tr>
    </table>
</div>
