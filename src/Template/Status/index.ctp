<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau statut'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="status index large-9 medium-8 columns content">
    <h3><?= __('Statut') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('libelle') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($status as $status): ?>
            <tr>
                <td><?= h($status->libelle) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $status->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $status->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $status->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $status->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
