<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau lavage'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lavages index large-9 medium-8 columns content">
    <h3><?= __('MAL') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('libelle') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lavages as $lavage): ?>
            <tr>
                <td><?= h($lavage->libelle) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $lavage->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $lavage->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $lavage->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $lavage->id)]) ?>
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
</div>
