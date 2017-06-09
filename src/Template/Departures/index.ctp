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
                <th scope="col"><?= $this->Paginator->sort('push_pool', 'T/P') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('loc_id', 'Loc') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set1_id', 'Rame 1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set2_id', 'Rame 2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('train_set3_id', 'Rame 3') ?></th>
                <th scope="col">Dép. théorique Landy</th>
                <th scope="col"><?= $this->Paginator->sort('landy_departure', 'Dép. réel Landy') ?></th>
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
                <td><?= $departure->push_pool ?></td>
                <td class="train" ><?= $departure->has('departure_train') ? $this->Html->link($departure->departure_train->numero, ['controller' => 'DepartureTrains', 'action' => 'view', $departure->departure_train->id]) : '' ?></td>
				<td><?= $departure->has('loc') ? $this->Html->link($departure->loc->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->loc->id]) : '' ?></td>
                <td><?= $departure->has('train_set1') ? $this->Html->link($departure->train_set1->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set1->id]) : '' ?></td>
                <td><?= $departure->has('train_set2') ? $this->Html->link($departure->train_set2->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set2->id]) : '' ?></td>
                <td><?= $departure->has('train_set3') ? $this->Html->link($departure->train_set3->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set3->id]) : '' ?></td>
				<td class="ld_theorique" ><?= h($this->Time->format($departure->departure_train->theoric_departures['0']->landy_departure, "HH:mm")) ?></td>
                <td class="ld_reel" ><?= h($this->Time->format($departure->landy_departure, "HH:mm")) ?></td>
				<?php if ($departure->formed === true){ ?>
					<td class="green"> </td>
				<?php }else{ ?>
					<td class="red"> </td>
				<?php } ?>
                <td <?= highlightClass("Freinage", $departure) ?> > <?= $departure->has('brake') ? $this->Html->link($departure->brake->type, ['controller' => 'Brakes', 'action' => 'view', $departure->brake->id]) : '' ?></td>
                <td class="osmose" 
					<?php
						$liberations = [];
						$countSet = 0;
						if ( isset($departure->train_set1) ){
							++$countSet;
							if (count($departure->train_set1->train_set_releases) > 0){
								if ( $departure->train_set1->train_set_releases[count($departure->train_set1->train_set_releases)-1]->active){
									array_push($liberations, $departure->train_set1->train_set_releases[count($departure->train_set1->train_set_releases)-1]->heure);
								}
							}
						} 
						if ( isset($departure->train_set2) ){
							++$countSet;
							if (count($departure->train_set2->train_set_releases) > 0){
								if ( $departure->train_set2->train_set_releases[count($departure->train_set2->train_set_releases)-1]->active){
									array_push($liberations, $departure->train_set2->train_set_releases[count($departure->train_set2->train_set_releases)-1]->heure);
								}
							}
						}
						if ( isset($departure->train_set3) ){
							++$countSet;
							if (count($departure->train_set3->train_set_releases) > 0){
								if ( $departure->train_set3->train_set_releases[count($departure->train_set3->train_set_releases)-1]->active){
									array_push($liberations, $departure->train_set3->train_set_releases[count($departure->train_set3->train_set_releases)-1]->heure);
								}
							}
						}
				if ((!empty($liberations) && !in_array(null, $liberations) && $countSet !== 0 && count($liberations) === $countSet && $countSet !== 0) || isset($departure->osmose)){
					echo 'class="green"';
				}
				else {
					echo 'class="red"';
				}  
				?> > <!-- osmose --> <?php if (isset($departure->landy_departure)){
					echo h($this->Time->format($departure->osmose, "HH:mm"));
				}
				else if (!empty($liberations)){
					echo h($this->Time->format(max($liberations), "HH:mm"));
				}  ?>
				</td>
                <td class="restit" <?php if ( isset($departure->restit) ){
					echo 'class="green"';
				}
				else {
					echo 'class="red"';
				}  ?> ><?= h($this->Time->format($departure->restit, "HH:mm")) ?></td>
				
                <td class="actions">
				<?= $departure->comment_eic != null || $departure->comment_rlp != null || $departure->comment_cpt != null || $departure->comment_geops != null? $this->Html->link($this->Html->image('eye.png', ['alt' => 'Observations', 'class' => 'icon']), ['action' => 'view_obs', $departure->id], ['target' => '_blank', 'escape' => false, 'title' => 'Observations']) : '' ?>
					
				<?= $this->Html->link($this->Html->image('view.png', ['alt' => __('Voir'), 'class' => 'icon']), ['action' => 'view', $departure->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
				<?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['action' => 'edit', $departure->id], ['escape' => false, 'title' => 'Modifier']) ?>
				<?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['action' => 'delete', $departure->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer ce départ ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include('paginator.php'); ?>
	
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
