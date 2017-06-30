<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $theoricDeparture->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $theoricDeparture->id], ['confirm' => __('Voulez-vous vraiment supprimer ce départ théorique?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des départs théoriques'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouveau départ théorique'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="theoricDepartures view large-9 medium-8 columns content">
    <h3><?= h($theoricDeparture->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Train') ?></th>
            <td><?= $theoricDeparture->has('train') ? $this->Html->link($theoricDeparture->train->id, ['controller' => 'Trains', 'action' => 'view', $theoricDeparture->train->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alerte') ?></th>
            <td><?= $theoricDeparture->has('alert') ? $this->Html->link($theoricDeparture->alert->id, ['controller' => 'Alerts', 'action' => 'view', $theoricDeparture->alert->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($theoricDeparture->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prmière alerte Id') ?></th>
            <td><?= $this->Number->format($theoricDeparture->first_alert_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Départ Paris Nord') ?></th>
            <td><?= h($theoricDeparture->paris_nord_departure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MIse à quai') ?></th>
            <td><?= h(duration($theoricDeparture->docking_time)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Temps de déscente') ?></th>
            <td><?= h(duration($theoricDeparture->descent_duration)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Temps de rendu matériel') ?></th>
            <td><?= h(duration($theoricDeparture->rendition_duration)) ?></td>
        </tr>
    </table>
</div>
