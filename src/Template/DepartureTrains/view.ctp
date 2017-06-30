<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $departureTrain->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $departureTrain->id], ['confirm' => __('Voulez-vous vraiment supprimer ce train ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des trains type départ'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="departureTrains view large-9 medium-8 columns content">
    <h3> Train type départ </h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($departureTrain->numero) ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('Départ théorique PNO') ?></th>
            <td><?= $this->Time->format($departureTrain->theoric_departures[0]->paris_nord_departure, "HH:mm") ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('Départ théorique Landy') ?></th>
            <td><?= $this->Time->format($departureTrain->theoric_departures[0]->landy_departure, "HH:mm") ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('Temps de mise à quai') ?></th>
            <td><?= duration($departureTrain->theoric_departures[0]->docking_time) ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('Temps de descente') ?></th>
            <td><?= duration($departureTrain->theoric_departures[0]->descent_duration) ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('Temps de rendu matériel') ?></th>
            <td><?= duration($departureTrain->theoric_departures[0]->rendition_duration) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alerte1') ?></th>
            <td><?= empty($departureTrain->alerte1) ? 'Définie selon alerte globale' : duration($departureTrain->alerte1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alerte2') ?></th>
            <td><?= empty($departureTrain->alerte2) ? 'Définie selon alerte globale' : duration($departureTrain->alerte2) ?></td>
        </tr>
    </table>
</div>
