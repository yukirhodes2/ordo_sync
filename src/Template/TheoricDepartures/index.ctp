<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau départ théorique'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="theoricDepartures index large-9 medium-8 columns content">
    <h3><?= __('Départs théoriques') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('train_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paris_nord_departure', 'Départ Paris Nord') ?></th>
                <th scope="col"><?= $this->Paginator->sort('docking_time', 'Mise à quai') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descent_duration', 'Temps de descente') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rendition_duration', 'Temps de rendu matériel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_alert_id', 'Alerte 1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_alert_id', 'Alerte 2') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($theoricDepartures as $theoricDeparture): ?>
            <tr>
                <td><?= $theoricDeparture->has('train') ? $this->Html->link($theoricDeparture->train->numero, ['controller' => 'Trains', 'action' => 'view', $theoricDeparture->train->id]) : '' ?></td>
                <td><?= h(date_format($theoricDeparture->paris_nord_departure,'H:i')) ?></td>
                <td><?= h(duration($theoricDeparture->docking_time)) ?></td>
                <td><?= h(duration($theoricDeparture->descent_duration)) ?></td>
                <td><?= h(duration($theoricDeparture->rendition_duration)) ?></td>
                <td><?= h($theoricDeparture->first_alert_id) ?></td>
                <td><?= $theoricDeparture->has('alert') ? $this->Html->link($theoricDeparture->alert->id, ['controller' => 'Alerts', 'action' => 'view', $theoricDeparture->alert->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Infos'), ['action' => 'view', $theoricDeparture->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $theoricDeparture->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $theoricDeparture->id], ['confirm' => __('Voulez-vous vraiment supprimer ce départ théorique ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
