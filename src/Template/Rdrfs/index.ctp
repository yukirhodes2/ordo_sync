<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau RD/RF'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rdrfs index large-9 medium-8 columns content">
    <h3><?= __('RD/RF') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('libelle') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rdrfs as $rdrf): ?>
            <tr>
                <td><?= h($rdrf->libelle) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png', ['alt' => 'Observations', 'class' => 'icon']), ['action' => 'view', $rdrf->id], ['escape' => false, 'title' => 'Observations']) ?>
                    <?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['action' => 'edit', $rdrf->id], ['escape' => false, 'title' => 'Modifier']) ?>
					<?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['action' => 'delete', $rdrf->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer cette donnée ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
