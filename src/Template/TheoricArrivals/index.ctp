<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouvelle arrivée théorique'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'Trains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouveau train'), ['controller' => 'Trains', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="theoricArrivals index large-9 medium-8 columns content">
    <h3><?= __('Arrivées théoriques') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('train_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paris_nord_arrival') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ascent_time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($theoricArrivals as $theoricArrival): ?>
            <tr>
                <td><?= $theoricArrival->has('train') ? $this->Html->link($theoricArrival->train->id, ['controller' => 'Trains', 'action' => 'view', $theoricArrival->train->id]) : '' ?></td>
                <td><?= h($theoricArrival->paris_nord_arrival) ?></td>
                <td><?= h(duration($theoricArrival->ascent_time)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $theoricArrival->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $theoricArrival->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $theoricArrival->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $theoricArrival->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
