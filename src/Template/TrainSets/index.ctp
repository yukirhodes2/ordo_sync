<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouvelle rame'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des libérations de rames'), ['controller' => 'TrainSetReleases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouvelle libération de rame'), ['controller' => 'TrainSetReleases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trainSets index large-9 medium-8 columns content">
    <h3><?= __('Train Sets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trainSets as $trainSet): ?>
            <tr>
                <td><?= h($trainSet->numero) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $trainSet->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $trainSet->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $trainSet->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $trainSet->id)]) ?>
					<?= $this->Html->link(__('Ajouter une libération de rame'), ['controller' => 'trainSetReleases', 'action' => 'add', $trainSet->id]) ?>
			   </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
