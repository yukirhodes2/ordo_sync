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
                <td><?= h($departure->departure_train->theoric_departures['0']->paris_nord_departure
				//+$departure->train->theoric_departures['0']->descent_duration
				) ?></td>
                <td><?= h($departure->landy_departure) ?></td>
                <td><?= h($departure->annoucement) ?></td>
				<td><?= h($departure->postep_departure) ?></td>
				<td><?= h($departure->passagecarre_departure) ?></td>
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
