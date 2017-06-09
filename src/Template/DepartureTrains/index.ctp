<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau train type départ'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departureTrains index large-9 medium-8 columns content">
    <h3><?= __('Trains type départ') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
				<th scope="col"><?= $this->Paginator->sort('paris_nord_departure', 'Départ théorique PNO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landy_departure', 'Départ théorique Landy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('docking_time', 'Mise à quai') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descent_duration', 'Temps de descente') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rendition_duration', 'Temps de rendu matériel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('alerte1', 'Alerte 1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('alerte2', 'Alerte 2') ?></th>

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departureTrains as $departureTrain): ?>
            <tr>
                <td><?= h($departureTrain->numero) ?></td>
                <td><?= isset($departureTrain->theoric_departures[0]) ? $this->Time->format($departureTrain->theoric_departures[0]->paris_nord_departure, "HH:mm") : '' ?></td>
                <td><?= isset($departureTrain->theoric_departures[0]) ? $this->Time->format($departureTrain->theoric_departures[0]->landy_departure, "HH:mm") : '' ?></td>
				<td><?= isset($departureTrain->theoric_departures[0]) ? duration($departureTrain->theoric_departures[0]->docking_time) : '' ?></td>
                <td><?= isset($departureTrain->theoric_departures[0]) ? duration($departureTrain->theoric_departures[0]->descent_duration) : '' ?></td>
				<td><?= isset($departureTrain->theoric_departures[0]) ? duration($departureTrain->theoric_departures[0]->rendition_duration) : '' ?></td>
                <td><?= $departureTrain->alerte1 === 0 ? 'Définie selon alerte globale' : duration($departureTrain->alerte1) ?></td>
                <td><?= $departureTrain->alerte2 === 0 ? 'Définie selon alerte globale' : duration($departureTrain->alerte2) ?></td>
                <td class="actions">
                   <?= $this->Html->link($this->Html->image('view.png', ['alt' => __('Voir'), 'class' => 'icon']), ['action' => 'view', $departureTrain->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
                    <?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['action' => 'edit', $departureTrain->id], ['escape' => false, 'title' => 'Modifier']) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['action' => 'delete', $departureTrain->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer ce train type départ ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>

</div>
