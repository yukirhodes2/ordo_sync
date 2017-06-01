<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Departure Train'), ['action' => 'edit', $departureTrain->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Departure Train'), ['action' => 'delete', $departureTrain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departureTrain->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departure Trains'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departure Train'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departureTrains view large-9 medium-8 columns content">
    <h3><?= h($departureTrain->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($departureTrain->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departureTrain->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alerte1') ?></th>
            <td><?= $this->Number->format($departureTrain->alerte1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alerte2') ?></th>
            <td><?= $this->Number->format($departureTrain->alerte2) ?></td>
        </tr>
    </table>
</div>
