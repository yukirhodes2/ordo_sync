<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouvelle libération de rame'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trainSetReleases index large-9 medium-8 columns content">
    <h3><?= __('Libérations de rame') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('heure', 'Heure de dispo') ?></th>
				<th scope="col"><?= $this->Paginator->sort('train_set_id', 'Rame') ?></th>
                <th scope="col"><?= $this->Paginator->sort('release1_id', 'Libération arrivée') ?></th>
                <th scope="col"><?= $this->Paginator->sort('release2_id', 'Libération départ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status1_id', 'Statut arrivée') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status2_id', 'Statut départ') ?></th>
				<th scope="col"><?= $this->Paginator->sort('active', 'Présent sur site') ?></th>
				
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trainSetReleases as $trainSetRelease): ?>
            <tr>
                <td><?= h($this->Time->format($trainSetRelease->heure, "HH:mm")) ?></td>
				<td><?= $trainSetRelease->has('train_set') ? $this->Html->link($trainSetRelease->train_set->numero, ['controller' => 'TrainSets', 'action' => 'view', $trainSetRelease->train_set->id]) : '' ?></td>
                <td><?= $trainSetRelease->has('releases1') ? $this->Html->link($trainSetRelease->releases1->libelle, ['controller' => 'Releases', 'action' => 'view', $trainSetRelease->releases1->id]) : '' ?></td>
                <td><?= $trainSetRelease->has('releases2') ? $this->Html->link($trainSetRelease->releases2->libelle, ['controller' => 'Releases', 'action' => 'view', $trainSetRelease->releases2->id]) : '' ?></td>
               <td><?= $trainSetRelease->has('status1') ? $this->Html->link($trainSetRelease->status1->libelle, ['controller' => 'Status', 'action' => 'view', $trainSetRelease->status1->id]) : '' ?></td>
                <td><?= $trainSetRelease->has('status2') ? $this->Html->link($trainSetRelease->status2->libelle, ['controller' => 'Status', 'action' => 'view', $trainSetRelease->status2->id]) : '' ?></td>
                <td <?= $trainSetRelease->active ? 'class="green"' : 'class="red"' ?> ></td>
				
                <td class="actions">
					<?= $trainSetRelease->comment != null ? $this->Html->link($this->Html->image('eye.png', ['alt' => 'Observations', 'class' => 'icon']), ['action' => 'view_obs', $trainSetRelease->id], ['target' => '_blank', 'escape' => false, 'title' => 'Observations']) : '' ?>
					<?= $this->Html->link($this->Html->image('view.png', ['alt' => __('Voir'), 'class' => 'icon']), ['action' => 'view', $trainSetRelease->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
                    <?= $trainSetRelease->active ? $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['action' => 'edit', $trainSetRelease->id], ['escape' => false]) : '' ?>
                    <?= !$trainSetRelease->active && $this->request->session()->read('Auth.User.id') !== 1 ? '' : $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['action' => 'delete', $trainSetRelease->id], ['escape' => false, 'confirm' => __('Voulez-vous vraiment supprimer cette libération de rame ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
	
	<?= $this->form->create(null);?>
		<fieldset class="cahierDeLevage find columns large-3">
			<legend>Rechercher sur un autre jour</legend>
				<?php echo $this->Form->date('date');?>
		</fieldset>
		
		<div class="cahierDeLevage find columns large-5">
			<?= $this->Form->button('Rechercher', ['type' => 'submit']) ?>
		</div>
    <?= $this->Form->end();?>
	
</div>