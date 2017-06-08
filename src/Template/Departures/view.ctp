<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer départ'), ['action' => 'edit', $departure->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer départ'), ['action' => 'delete', $departure->id], ['confirm' => __('Voulez-vous vraiment supprimer ce départ ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste départs'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="departures view large-9 medium-8 columns content">
    <h3><?= 'Départ #'.h($departure->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row" class="geops" ><?= __('Voie') ?></th>
            <td><?= $departure->has('way') ? $this->Html->link($departure->way->numero, ['controller' => 'Ways', 'action' => 'view', $departure->way->id]) : "" ?></td>
        </tr>
		<tr>
            <th scope="row" class="geops" ><?= __('Tire/Pousse') ?></th>
			<td><?= showDefine($departure->push_pool) ?></td>
        
		</tr>
        <tr>
            <th scope="row" class="geops" ><?= __('Train') ?></th>
            <td><?= $departure->has('train') ? $this->Html->link($departure->train->numero, ['controller' => 'Trains', 'action' => 'view', $departure->train->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row" class="geops" ><?= __('Rame 1') ?></th>
            <td><?= $departure->has('train_set1') ? $this->Html->link($departure->train_set1->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set1->id]) : '-' ?></td>
        </tr>
        <tr>
            <th scope="row" class="geops" ><?= __('Rame 2') ?></th>
            <td><?= $departure->has('train_set2') ? $this->Html->link($departure->train_set2->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set2->id]) : '-' ?></td>
        
        </tr>
		<tr>
            <th scope="row" class="geops" ><?= __('Rame 3') ?></th>
            <td><?= $departure->has('train_set3') ? $this->Html->link($departure->train_set3->numero, ['controller' => 'TrainSets', 'action' => 'view', $departure->train_set3->id]) : '-' ?></td>
        </tr>
        
		<tr>
            <th scope="row" class="geops"><?= __('Type de freinage') ?></th>
			<td><?= isset($departure->brake->type) ? $departure->brake->type : '<span class="error">'.__('A définir').'</span>' ?></td>
        
        </tr>
		<tr>
            <th scope="row" class="geops"><?= __('Présent au freinage') ?></th>
			<td><?= isset($departure->brake_controls['0']->present->libelle) ? $departure->brake_controls['0']->present->libelle : '<span class="error">'.__('A définir').'</span>' ?></td>
        </tr>
		<tr>
            <th scope="row" class="geops"><?= __('Heure de réalisation freinage') ?></th>
            <td><?= isset($departure->brake_controls['0']->realisation_time) ? $departure->brake_controls['0']->realisation_time : '<span class="error">'.__('A définir').'</span>' ?></td>
        </tr>
        
		<tr>
            <th scope="row" class="geops" ><?= __('Formé') ?></th>
            <td><?= $departure->formed ? __('Oui') : __('Non'); ?></td>
        </tr>
		<tr>
            <th scope="row" class="geops" ><?= __('Commentaire GEOPS') ?></th>
            <td><?= h($departure->comment_geops) ?></td>
        </tr>
		<tr>
            <th scope="row" class="rlp" ><?= __('Osmose') ?></th>
            <td><?= showDefine($departure->osmose) ?></td>
        </tr>
        <tr>
            <th scope="row" class="rlp" ><?= __('Rendu voie') ?></th>
            <td><?= showDefine($departure->restit) ?></td>
        </tr>
		<tr>
            <th scope="row" class="rlp" ><?= __('Commentaire RLP') ?></th>
            <td><?= h($departure->comment_rlp) ?></td>
        </tr>
		<tr>
            <th scope="row" class="cpt" ><?= __('Arrivée du refouleur') ?></th>
            <td><?= showDefine($departure->refouleur_arrival) ?></td>
        </tr>
		
        <tr>
            <th scope="row" class="cpt" ><?= __('Arrivée EM, CRML ou ADC') ?></th>
            <td><?= showDefine($departure->adc_arrival) ?></td>
        </tr>
		<tr>
            <th scope="row" class="cpt" ><?= __('Numéro de radio') ?></th>
            <td><?= showDefine($departure->radio_number) ?></td>
        </tr>
		<tr>
            <th scope="row" class="cpt" ><?= __('Information au CRML') ?></th>
            <td><?= isset($departure->information) ? h($departure->information) : '<span class="error">'.__('A définir').'</span>' ?></td>
        </tr>
        <tr>
            <th scope="row" class="cpt" ><?= __('Commentaire CPT') ?></th>
            <td><?= h($departure->comment_cpt) ?></td>
        </tr>
        
        
        <tr>
            <th scope="row" class="eic" ><?= __('Départ Landy réel') ?></th>
            <td><?= showDefine($departure->landy_departure) ?></td>
		</tr>
		
		<tr>
            <th scope="row" class="eic" ><?= __('Passage carré') ?></th>
            <td><?= showDefine($departure->passagecarre_departure) ?></td>
		</tr>
		<tr>
            <th scope="row" class="eic" ><?= __('Départ réel Poste P') ?></th>
            <td><?= showDefine($departure->postep_departure) ?></td>
		</tr>
        
        <tr>
            <th scope="row" class="eic" ><?= __('Annonce du refouleur/CRML') ?></th>
			<td><?= showDefine($departure->annoucement) ?></td>
		</tr>
        
		<tr>
            <th scope="row" class="eic"><?= __('Commentaire EIC') ?></th>
            <td><?= h($departure->comment_eic) ?></td>
        </tr>
        
    </table>
</div>
