<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouvelle arrivée'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'ArrivalTrains', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="arrivals index large-9 medium-8 columns content">
    <h3><?= __('Arrivées') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('way_id', 'Voie') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_id') ?></th>
				<th scope="col"><?= $this->Paginator->sort('loc_id', 'Loc') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set1_id', 'Rame 1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set2_id', 'Rame 2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set3_id', 'Rame 3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landy_arrival', 'Arrivée Landy') ?></th>
				<th scope="col"><?= $this->Paginator->sort('announcement_time', 'Annoncé en place') ?></th>
                <th scope="col"><?= $this->Paginator->sort('protection_time', 'Heure de protection') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arrivals as $arrival): ?>
			
            <tr>
                <td><?= $arrival->has('way') ? $this->Html->link($arrival->way->numero, ['controller' => 'Ways', 'action' => 'view', $arrival->way->id]) : '' ?></td>
                <td><?= $arrival->has('arrival_train') ? $this->Html->link($arrival->arrival_train->numero, ['controller' => 'ArrivalTrains', 'action' => 'view', $arrival->arrival_train->id]) : '' ?></td>
				<td><?= $arrival->has('loc') ? $this->Html->link($arrival->loc->numero, ['controller' => 'TrainSets', 'action' => 'view', $arrival->loc->id]) : '' ?></td>
                <td><?= $arrival->train_set1_id != null ? $trainSets[($arrival->train_set1_id)-1]['numero'] : '' ?></td>
                <td><?= $arrival->has('train_set') ? $arrival->train_set->numero : '' ?></td>
                <td><?= $arrival->train_set2_id != null ? $trainSets[($arrival->train_set2_id)-1]['numero'] : '' ?></td>
                <td><?= $this->Time->format($arrival->landy_arrival, "HH:mm"); ?></td>
				<td><?= $this->Time->format($arrival->announcement_time, "HH:mm"); ?></td>
                <?= $arrival->protection_time != null ? '<td class="green">'.$this->Time->format($arrival->protection_time, "HH:mm").'</td>' : '<td class="red"></td>' ?>
				
                <td class="actions">
                    <?= $arrival->comment_eic != null || $arrival->comment_rlp != null ? $this->Html->link($this->Html->image('eye.png', ['alt' => 'Observations', 'class' => 'icon']), ['action' => 'view_obs', $arrival->id], ['target' => '_blank', 'title' => 'Observations', 'escape' => false]) : '' ?>

					<?= $this->Html->link($this->Html->image('view.png', ['alt' => 'Voir', 'class' => 'icon']), ['action' => 'view', $arrival->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
                    <?= $arrival->announcement_time!= null ? $this->Html->link($this->Html->image('edit.png', ['alt' => 'Editer', 'class' => 'icon']), ['action' => 'edit', $arrival->id], ['escape' => false, 'title' => 'Modifier']) : '' ?>
					<?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => 'Supprimer', 'class' => 'icon']), ['action' => 'delete', $arrival->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer cette arrivée ? Voie {0}, Train N°{1}', $arrival->way->numero, $arrival->arrival_train->numero)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
