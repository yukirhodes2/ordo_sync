<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouvelle voie'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ways index large-9 medium-8 columns content">
    <h3><?= __('Voies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ways as $way): ?>
            <tr>
                <td><?= $this->Number->format($way->id) ?></td>
                <td><?= $this->Number->format($way->numero) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $way->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $way->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $way->id], ['confirm' => __('Voulez-vous vraiment supprimer cette voie ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
