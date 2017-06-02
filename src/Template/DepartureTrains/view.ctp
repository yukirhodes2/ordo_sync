<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $departureTrain->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $departureTrain->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des trains type départ'), ['action' => 'index']) ?> </li>
		        <li><?= $this->Html->link(__('Liste des départs'), ['controller' => 'Departures', 'action' => 'index']) ?> </li>
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
            <th scope="row"><?= __('Alerte1') ?></th>
            <td><?= empty($departureTrain->alerte1) ? 'Définie selon alerte globale' : duration($departureTrain->alerte1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alerte2') ?></th>
            <td><?= empty($departureTrain->alerte2) ? 'Définie selon alerte globale' : duration($departureTrain->alerte2) ?></td>
        </tr>
    </table>
</div>
