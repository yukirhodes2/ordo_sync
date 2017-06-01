<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer une arrivée théorique'), ['action' => 'edit', $theoricArrival->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer une arrivée théorique'), ['action' => 'delete', $theoricArrival->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $theoricArrival->id)]) ?> </li>
        <li><?= $this->Html->link(__('Liste des arrivées théoriques'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouvel arrivée théorique'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'Trains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouveau train'), ['controller' => 'Trains', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="theoricArrivals view large-9 medium-8 columns content">
    <h3><?= h($theoricArrival->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Train') ?></th>
            <td><?= $theoricArrival->has('train') ? $this->Html->link($theoricArrival->train->id, ['controller' => 'Trains', 'action' => 'view', $theoricArrival->train->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($theoricArrival->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Arrivée Paris Nord') ?></th>
            <td><?= h($theoricArrival->paris_nord_arrival) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Temps de montée') ?></th>
            <td><?= h($theoricArrival->ascent_time) ?></td>
        </tr>
    </table>
</div>
