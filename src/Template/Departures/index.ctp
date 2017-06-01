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
                <td><?= $departure->has('train') ? $this->Html->link($departure->train->numero, ['controller' => 'Trains', 'action' => 'view', $departure->train->id]) : '' ?></td>
                <td><?= $departure->has('train_set1') ? $this->Html->link($departure->train_set1->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set1->id]) : '' ?></td>
                <td><?= $departure->has('train_set2') ? $this->Html->link($departure->train_set2->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set2->id]) : '' ?></td>
                <td><?= $departure->has('train_set3') ? $this->Html->link($departure->train_set3->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set3->id]) : '' ?></td>
				<td><?= h($this->Time->format($departure->train->theoric_departures['0']->paris_nord_departure, "HH:mm")) ?></td>
                <td><?= h($this->Time->format($departure->landy_departure, "HH:mm")) ?></td>
				<?php if ($departure->formed === true){ ?>
					<td class="green"> Oui </td>
				<?php }else{ ?>
					<td class="red"> Non </td>
				<?php } ?>
                <td <?php 
					if ( !empty($departure->brake_controls['0']->realisation_time) && !empty($departure->brake_controls['0']->present) ){ // si le freinage a été fait
						echo 'class="green"';
					} else {
						if ( isset($departure->brake_controls['0']->present) ){
							if ( $departure->brake_controls['0']->present->id === 2 ){
								echo 'class="orange"';
							}
							else{
								echo 'class="red"';
							}
						}
						else{
							echo 'class="red"';
						}
							
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
                <td <?php if ( isset($departure->restit) ){
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
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('début')) ?>
            <?= $this->Paginator->prev('< ' . __('précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivant') . ' >') ?>
            <?= $this->Paginator->last(__('dernier') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, {{current}} résultat(s) sur un total de {{count}}')]) ?></p>
    </div>
	
	<?= $this->form->create(null);?>
		<fieldset class="departures find columns large-3">
			<legend> Rechercher sur un autre jour</legend>
				<?php echo $this->Form->date('date');?>
		</fieldset>
		
		<div class="departures find columns large-5">
			<?= $this->Form->button('Rechercher', ['type' => 'submit']) ?>
		</div>
    <?= $this->Form->end();?>
	
</div>
