<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Departure Train'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departureTrains index large-9 medium-8 columns content">
    <h3><?= __('Departure Trains') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('alerte1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('alerte2') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departureTrains as $departureTrain): ?>
            <tr>
                <td><?= $this->Number->format($departureTrain->id) ?></td>
                <td><?= h($departureTrain->numero) ?></td>
                <td><?= $this->Number->format($departureTrain->alerte1) == 0 ? 'Définie selon alerte globale' : $this->Number->format($departureTrain->alerte1) ?></td>
                <td><?= $this->Number->format($departureTrain->alerte2) == 0 ? 'Définie selon alerte globale' : $this->Number->format($departureTrain->alerte2) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $departureTrain->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departureTrain->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departureTrain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departureTrain->id)]) ?>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
