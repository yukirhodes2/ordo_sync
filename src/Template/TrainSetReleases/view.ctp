<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $trainSetRelease->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $trainSetRelease->id], ['confirm' => __('Voulez-vous vraiment supprimer cette libération de rame ?')]) ?> </li>
    </ul>
</nav>
<div class="trainSetReleases view large-9 medium-8 columns content">
    <h3><?= 'Libération de rame n°'.h($trainSetRelease->id) ?></h3>
    <table class="vertical-table">
		<tr>
            <th scope="row"><?= __('Rame') ?></th>
            <td><?= $trainSetRelease->has('train_set') ? $this->Html->link($trainSetRelease->train_set->numero, ['controller' => 'TrainSets', 'action' => 'view', $trainSetRelease->train_set->id]) : '' ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('Présent sur site') ?></th>
            <td><?= $trainSetRelease->active ? __('Oui') : __('Non'); ?></td>
        </tr>
        <tr>
            <th scope="row" class="arrival" ><?= __('Libération arrivée') ?></th>
            <td><?= $trainSetRelease->has('releases1') ? $this->Html->link($trainSetRelease->releases1->libelle, ['controller' => 'Releases', 'action' => 'view', $trainSetRelease->release1_id]) : '' ?></td>
        </tr>
		<tr>
            <th scope="row" class="arrival"><?= __('Statut arrivée') ?></th>
            <td><?= $trainSetRelease->has('status1') ? $this->Html->link($trainSetRelease->status1->libelle, ['controller' => 'Status', 'action' => 'view', $trainSetRelease->status1->id]) : '' ?></td>
        </tr>
		<tr>
            <th scope="row" class="arrival"><?= __('Observations') ?></th>
            <td><?= h($trainSetRelease->comment) ?></td>
        </tr>
		<tr>
            <th scope="row" class="departure" ><?= __('Libération départ') ?></th>
             <td><?= $trainSetRelease->has('releases2') ? $this->Html->link($trainSetRelease->releases2->libelle, ['controller' => 'Releases', 'action' => 'view', $trainSetRelease->release2_id]) : '' ?></td>
       </tr>
        
        <tr>
            <th scope="row" class="departure" ><?= __('Statut départ') ?></th>
            <td><?= $trainSetRelease->has('status2') ? $this->Html->link($trainSetRelease->status2->libelle, ['controller' => 'Status', 'action' => 'view', $trainSetRelease->status2->id]) : '' ?></td>
        </tr>
            
        <tr>
            <th scope="row" class="departure" ><?= __('Heure de libération') ?></th>
            <td><?= h($trainSetRelease->heure) ?></td>
        </tr>
        
		<tr>
            <th scope="row" class="rlp" ><?= __('Commmentaire RLP') ?></th>
            <td><?= h($trainSetRelease->comment) ?></td>
        </tr>
        
    </table>
</div>
