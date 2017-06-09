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
                <td><?= $departure->train_set1_id !== null ? $trainSets[($departure->train_set1_id)-1]['numero'] : '' ?></td>
                <td><?= $departure->train_set2_id !== null ? $trainSets[($departure->train_set2_id)-1]['numero'] : '' ?></td>
                <td><?= $departure->train_set3_id !== null ? $trainSets[($departure->train_set3_id)-1]['numero'] : '' ?></td>
                <td><?= h($this->Time->format($departure->departure_train->theoric_departures['0']->paris_nord_departure, "HH:mm")) ?></td>
                <td><?= h($this->Time->format($departure->landy_departure, "HH:mm")) ?></td>
				<?php if ($departure->formed === true){ ?>
					<td class="green"> Oui </td>
				<?php }else{ ?>
					<td class="red"> Non </td>
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
                <td 
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
							if (count($departure->train_set2->train_set_releases) > 0){
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
				?> > <!-- osmose --> 
				</td>
                <td <?= $departure->restit !== null ? 'class="green"' : 'class="red"' ?>></td>
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
</div>
