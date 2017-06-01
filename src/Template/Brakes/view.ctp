<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $brake->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $brake->id], ['confirm' => __('Voulez-vous vraiment supprimer ce freinage ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des freinages'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="brakes view large-9 medium-8 columns content">
    <h3>Freinage #<?= h($brake->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($brake->type) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Départs comprenant ce type de freinage') ?></h4>
        <?php if (!empty($brake->departures)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('ID') ?></th>
                <th scope="col"><?= __('Train') ?></th>
                <th scope="col"><?= __('Formé') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($brake->departures as $departures): ?>
            <tr>
                <td><?= h($departures->id) ?></td>
                <td><?= h($departures->train->numero) ?></td>
                <td><?= h($departures->formed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Departures', 'action' => 'view', $departures->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Departures', 'action' => 'edit', $departures->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Departures', 'action' => 'delete', $departures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departures->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
