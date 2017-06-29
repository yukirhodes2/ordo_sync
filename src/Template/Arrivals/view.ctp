<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer l\'arrivée'), ['action' => 'edit', $arrival->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer l\'arrivée'), ['action' => 'delete', $arrival->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arrival->id)]) ?> </li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="arrivals view large-9 medium-8 columns content">
    <h3>Arrivée #<?= h($arrival->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row" class="eic"><?= __('Voie') ?></th>
            <td><?= $arrival->has('way') ? $this->Html->link($arrival->way->numero, ['controller' => 'Ways', 'action' => 'view', $arrival->way->id]) : '' ?></td>
        </tr>
		<tr>
            <th scope="row" class="eic"><?= __('Tire/Pousse') ?></th>
            <td><?= $arrival->push_pool != null ? $arrival->push_pool : '<span class="error">'.__('A définir').'</span>' ?></td>
        </tr>
        <tr>
            <th scope="row" class="eic"><?= __('Train') ?></th>
            <td><?= $arrival->has('arrival_train') ? $this->Html->link($arrival->arrival_train->numero, ['controller' => 'ArrivalTrains', 'action' => 'view', $arrival->arrival_train->id]) : '' ?></td>
        </tr>
		<tr>
            <th scope="row" class="eic" ><?= __('Loc') ?></th>
            <td><?= $arrival->has('loc') ? $this->Html->link($arrival->loc->numero, ['controller' => 'TrainSets', 'action' => 'view', $arrival->loc->id]) : '' ?></td>
        </tr>
		<tr>
            <th scope="row" class="eic"><?= __('Rame 1') ?></th>
            <td><?= $arrival->train_set1_id != null ? $this->Html->link($trainSets[($arrival->train_set1_id)-1]['numero'], ['controller' => 'TrainSets', 'action' => 'view', $arrival->train_set1_id]) : '-' ?></td>
        </tr>
        <tr>
            <th scope="row" class="eic"><?= __('Rame 2') ?></th>
            <td><?= $arrival->train_set2_id != null ? $this->Html->link($trainSets[($arrival->train_set2_id)-1]['numero'], ['controller' => 'TrainSets', 'action' => 'view', $arrival->train_set2_id]) : '-' ?></td>
        </tr>
		<tr>
            <th scope="row" class="eic"><?= __('Rame 3') ?></th>
            <td><?= $arrival->has('train_set') ? $this->Html->link($arrival->train_set->numero, ['controller' => 'TrainSets', 'action' => 'view', $arrival->train_set->id]) : '-' ?></td>
        </tr>
        <tr>
            <th scope="row" class="eic"><?= __('Arrivée Landy') ?></th>
            <td><?= h($arrival->landy_arrival) ?></td>
        </tr>
	    <tr>
            <th scope="row" class="eic"><?= __('MAL') ?></th>
            <td><?= $arrival->has('lavage') ? $this->Html->link($arrival->lavage->libelle, ['controller' => 'Lavages', 'action' => 'view', $arrival->lavage->id]) : '<span class="error">'.__('A définir').'</span>' ?></td>
        </tr>
		<tr>
            <th scope="row" class="eic"><?= __('Heure d\'annonce') ?></th>
            <td><?= $arrival->announcement_time ? h($arrival->announcement_time) : '<span class="error">'.__('A définir').'</span>' ?></td>
        </tr>
        <tr>
            <th scope="row" class="eic"><?= __('Observations EIC') ?></th>
            <td><?= h($arrival->comment_eic) ?></td>
        </tr>
		<tr>
            <th scope="row" class="rlp"><?= __('Heure de protection') ?></th>
            <td><?= $arrival->protection_time != null ? h($arrival->protection_time) : '<span class="error">'.__('A définir').'</span>' ?></td>
        </tr>
        <tr>
            <th scope="row" class="rlp"><?= __('Observations RLP') ?></th>
            <td><?= h($arrival->comment_rlp) ?></td>
        </tr>
    </table>
</div>
