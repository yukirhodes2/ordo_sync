<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Arrival Train'), ['action' => 'edit', $arrivalTrain->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Arrival Train'), ['action' => 'delete', $arrivalTrain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arrivalTrain->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Arrival Trains'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Arrival Train'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="arrivalTrains view large-9 medium-8 columns content">
    <h3><?= h($arrivalTrain->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($arrivalTrain->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($arrivalTrain->id) ?></td>
        </tr>
    </table>
</div>
