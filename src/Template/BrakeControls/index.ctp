<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau contrôle de freinage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des départs'), ['controller' => 'Departures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des présents'), ['controller' => 'Presents', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="brakeControls index large-9 medium-8 columns content">
    <h3><?= __('Contrôles de freinage') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('departure_id', 'Départ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('present_id', 'Présent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('realisation_time', 'Réalisation') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brakeControls as $brakeControl): ?>
            <tr>
                <td><?= $brakeControl->has('departure') ? $this->Html->link($brakeControl->departure->id, ['controller' => 'Departures', 'action' => 'view', $brakeControl->departure->id]) : '' ?></td>
                <td><?= $brakeControl->has('present') ? $this->Html->link($brakeControl->present->libelle, ['controller' => 'Presents', 'action' => 'view', $brakeControl->present->id]) : '' ?></td>
                <td><?= $brakeControl->realisation_time ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $brakeControl->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $brakeControl->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $brakeControl->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $brakeControl->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
