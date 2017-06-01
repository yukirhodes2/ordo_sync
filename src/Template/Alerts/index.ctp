<?php
/**
  * @var \App\View\AppView $this
  */
?>
<p> Partie du site en construction. Comment avez-vous fait pour atterrir ici d'abord ?</p>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Alert'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="alerts index large-9 medium-8 columns content">
    <h3><?= __('Alerts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('libelle') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_timer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_timer') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alerts as $alert): ?>
            <tr>
                <td><?= h($alert->libelle) ?></td>
                <td><?= h($alert->first_timer) ?></td>
                <td><?= h($alert->second_timer) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $alert->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $alert->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $alert->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $alert->id)]) ?>
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
