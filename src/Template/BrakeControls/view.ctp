<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $brakeControl->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $brakeControl->id], ['confirm' => __('Voulez-vous vraiment supprimer ce contrôle de freinage ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des contrôles de freinage'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="brakeControls view large-9 medium-8 columns content">
    <h3>Contrôle de freinage #<?= h($brakeControl->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Départ') ?></th>
            <td><?= $brakeControl->has('departure') ? $this->Html->link($brakeControl->departure->id, ['controller' => 'Departures', 'action' => 'view', $brakeControl->departure->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Présent') ?></th>
            <td><?= $brakeControl->has('present') ? $this->Html->link($brakeControl->present->libelle, ['controller' => 'Presents', 'action' => 'view', $brakeControl->present->id]) : '' ?></td>
        </tr>
    </table>
</div>
