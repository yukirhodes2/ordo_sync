<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau départ'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des voies'), ['controller' => 'Ways', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'DepartureTrains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des rames'), ['controller' => 'TrainSets', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departures index large-9 medium-8 columns content">
    <h3><?= __('Départs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('way_id', 'Voie') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set1_id', 'Rame 1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set2_id', 'Rame 2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set3_id', 'Rame 3') ?></th>
                <th scope="col">Dép. théorique Landy</th>
                <th scope="col"><?= $this->Paginator->sort('landy_departure', 'Dép. réel Landy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('annoucement', 'Annonce ref./CRML') ?></th>
                <th scope="col"><?= $this->Paginator->sort('postep_departure', 'Dép. Poste P') ?></th>
                <th scope="col"><?= $this->Paginator->sort('passagecarre_departure', 'Dép. Passage carré') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
		
            <?php foreach ($departures as $departure): ?>
            <tr>
			<?php // debug($departure); ?>
                <td><?= $departure->has('way') ? $this->Html->link($departure->way->numero, ['controller' => 'Ways', 'action' => 'view', $departure->way->id]) : '' ?></td>
                <td><?= $departure->has('departure_train') ? $this->Html->link($departure->departure_train->numero, ['controller' => 'DepartureTrains', 'action' => 'view', $departure->departure_train->id]) : '' ?></td>
                <td><?= $departure->train_set1_id !== null ? $trainSets[($departure->train_set1_id)-1]['numero'] : '' ?></td>
                <td><?= $departure->train_set2_id !== null ? $trainSets[($departure->train_set2_id)-1]['numero'] : '' ?></td>
               <td><?= $departure->train_set3_id !== null ? $trainSets[($departure->train_set3_id)-1]['numero'] : '' ?></td>
                <td><?= h($this->Time->format($departure->departure_train->theoric_departures['0']->landy_departure, "HH:mm")) ?></td>
                <td><?= h($this->Time->format($departure->landy_departure, "HH:mm")) ?></td>
                <td><?= h($this->Time->format($departure->annoucement, "HH:mm")) ?></td>
				<td><?= h($this->Time->format($departure->postep_departure, "HH:mm")) ?></td>
				<td><?= h($this->Time->format($departure->passagecarre_departure, "HH:mm")) ?></td>
                <td class="actions">
				<?= $departure->comment_eic != null || $departure->comment_rlp != null || $departure->comment_cpt != null || $departure->comment_geops != null? $this->Html->link($this->Html->image('eye.png', ['alt' => 'Observations', 'class' => 'icon']), ['action' => 'view_obs', $departure->id], ['target' => '_blank', 'escape' => false, 'title' => 'Observations']) : '' ?>
				
				<?= $this->Html->link($this->Html->image('view.png', ['alt' => 'Voir', 'class' => 'icon']), ['action' => 'view', $departure->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
				<?= $this->Html->link($this->Html->image('edit.png', ['alt' => 'Editer', 'class' => 'icon']), ['action' => 'edit', $departure->id], ['escape' => false, 'title' => 'Modifier']) ?>
				<?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => 'Supprimer', 'class' => 'icon']), ['action' => 'delete', $departure->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer ce départ ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>

	
	<?= $this->form->create(null);?>
		<fieldset class="departures find columns large-3">
			<legend> Rechercher sur un autre jour</legend>
				<?php echo $this->Form->date('date');?>
		</fieldset>
		
		<div class="departures find columns large-5">
			<?= $this->Form->button('Rechercher', ['type' => 'submit']) ?>
		</div>
    <?= $this->Form->end();?>
	
	<?php echo '<script>alert_daemon('.$alerts[1].','.$departure->departure_train.', 1);</script>'; ?>
</div>
