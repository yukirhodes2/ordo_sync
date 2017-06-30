<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau freinage'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="brakes index large-9 medium-8 columns content">
    <h3><?= __('Freinages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brakes as $brake): ?>
            <tr>
                <td><?= h($brake->type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $brake->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $brake->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $brake->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $brake->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
