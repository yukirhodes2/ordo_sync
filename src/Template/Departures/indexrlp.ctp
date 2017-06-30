<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau départ'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departures index large-9 medium-8 columns content">
    <h3><?= __('Départs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('way_id', 'Voie') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_id') ?></th>
				<th scope="col"><?= $this->Paginator->sort('loc_id', 'Loc') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set1_id', 'Rame 1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set2_id', 'Rame 2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set3_id', 'Rame 3') ?></th>
                <th scope="col">Départ théorique Landy</th>
                <th scope="col"><?= $this->Paginator->sort('landy_departure', 'Départ réel Landy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('formed', 'Formé') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brake_id', 'Freinage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('osmose') ?></th>
                <th scope="col"><?= $this->Paginator->sort('restit', 'Rendu voie') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
		
            <?php foreach ($departures as $departure): ?>
            <tr>
			<?php // debug($departure); ?>
                <td><?= $departure->has('way') ? $this->Html->link($departure->way->numero, ['controller' => 'Ways', 'action' => 'view', $departure->way->id]) : '' ?></td>
                <td><?= $departure->has('departure_train') ? $this->Html->link($departure->departure_train->numero, ['controller' => 'DepartureTrains', 'action' => 'view', $departure->departure_train->id]) : '' ?></td>
				<td><?= $departure->has('loc') ? $this->Html->link($departure->loc->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->loc->id]) : '' ?></td>
                <td><?= $departure->has('train_set1') ? $this->Html->link($departure->train_set1->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set1->id]) : '' ?></td>
                <td><?= $departure->has('train_set2') ? $this->Html->link($departure->train_set2->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set2->id]) : '' ?></td>
                <td><?= $departure->has('train_set3') ? $this->Html->link($departure->train_set3->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set3->id]) : '' ?></td>
                <td class="ld_theorique"><?= h($this->Time->format($departure->departure_train->theoric_departures['0']->landy_departure, "HH:mm")) ?></td>
                <td class="ld_reel"><?= h($this->Time->format($departure->landy_departure, "HH:mm")) ?></td>
				<?php if ($departure->formed === true){ ?>
					<td class="green"> </td>
				<?php }else{ ?>
					<td class="red"> </td>
				<?php } ?>
                <td <?php
					if ( !empty($departure->brake_controls) ){
						if ($departure->brake_controls['0']->present->id !== 3 && $departure->brake_controls['0']->present->id !== 4){
							echo 'class="green"';
						}
						else{
							echo 'class="orange"';
						}
					} else {
						echo 'class="red"';
					} ?> > <?= $departure->has('brake') ? $this->Html->link($departure->brake->type, ['controller' => 'Brakes', 'action' => 'view', $departure->brake->id]) : '' ?></td>
                <td class="osmose" >
				<!-- osmose -->
				<?php 
				if ( isOsmose($departure) ){
						echo '<script>color(".osmose", "green");</script>';
					}
					else {
						echo '<script>color(".osmose", "red");</script>';
					}  ?>
				</td>
                <td class="restit" <?= $departure->restit !== null ? 'class="green"' : 'class="red"' ?>></td>
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
	<?php if (isset($departure)) echo '<script>alert_daemon('.$alerts[1].','.$departure->departure_train.', 1);</script>'; ?>
</div>
