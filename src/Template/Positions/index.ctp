<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouvelle affectation'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="positions index large-9 medium-8 columns content">
    <h3><?= __('Positions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('libelle') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position): ?>
            <tr>
                <td><?= h($position->libelle) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $position->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $position->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $position->id], ['confirm' => __('Voulez-vous vraiment supprimer cette affectation ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
