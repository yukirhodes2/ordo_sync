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
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'Trains', 'action' => 'index']) ?></li>
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
                <th scope="col">Départ théorique Landy</th>
                <th scope="col"><?= $this->Paginator->sort('landy_departure', 'Départ réel Landy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brake_id', 'Freinage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('refouleur_arrival', 'Arrivée refouleur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adc_arrival', 'Arrivée ADC/CRML') ?></th>
                <th scope="col"><?= $this->Paginator->sort('annoucement', 'Annonce ref./CRML') ?></th>
			    <th scope="col"><?= $this->Paginator->sort('radio_number', 'N° radio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('information', 'Commande CRML') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
		
            <?php foreach ($departures as $departure): ?>
            <tr>
			<?php // debug($departure); ?>
                <td><?= $departure->has('way') ? $this->Html->link($departure->way->numero, ['controller' => 'Ways', 'action' => 'view', $departure->way->id]) : '' ?></td>
                <td class="train"><?= $departure->has('departure_train') ? $this->Html->link($departure->departure_train->numero, ['controller' => 'DepartureTrains', 'action' => 'view', $departure->departure_train->id]) : '' ?></td>
                <td><?= $departure->loc_id !== null ? $trainSets[($departure->loc_id)-1]['numero'] : '' ?></td>
                <td><?= $departure->train_set1_id !== null ? $trainSets[($departure->train_set1_id)-1]['numero'] : '' ?></td>
                <td><?= $departure->train_set2_id !== null ? $trainSets[($departure->train_set2_id)-1]['numero'] : '' ?></td>
                <td><?= $departure->train_set3_id !== null ? $trainSets[($departure->train_set3_id)-1]['numero'] : '' ?></td>
                <td class="ld_theorique"><?= h(date('H:m', strtotime($departure->train->theoric_departures['0']->paris_nord_departure)+$departure->train->theoric_departures['0']->descent_duration)) ?></td>
                <td class="ld_reel"><?= h($departure->landy_departure) ?></td>
                <td <?= highlightClass("Freinage", $departure) ?> > </td>
                <td><?= h($departure->refouleur_arrival) ?></td>
                <td><?= h($departure->adc_arrival) ?></td>
                <td><?= h($departure->annoucement) ?></td>
				<td><?= h($departure->radio_number) ?></td>
                <td <?= highlightClass("CommandeCRML", $departure) ?> > <?=  h($departure->information) ?></td>
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
    <?php include('paginator.php'); ?>
	
	<?php echo '<script>alert_daemon('.$alerts[1].','.$departure->departure_train.', 1);</script>'; ?>
</div>
