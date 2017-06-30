<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $position->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $position->id], ['confirm' => __('Voulez-vous vraiment supprimer cette affectation ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des affectations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouvelle affectation'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="positions view large-9 medium-8 columns content">
    <h3><?= h($position->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Libelle') ?></th>
            <td><?= h($position->libelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($position->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Contacts associés') ?></h4>
        <?php if (!empty($position->contacts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Surname') ?></th>
                <th scope="col"><?= __('Position Id') ?></th>
                <th scope="col"><?= __('Mail') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($position->contacts as $contacts): ?>
            <tr>
                <td><?= h($contacts->id) ?></td>
                <td><?= h($contacts->name) ?></td>
                <td><?= h($contacts->surname) ?></td>
                <td><?= h($contacts->position_id) ?></td>
                <td><?= h($contacts->mail) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Voulez-vous vraiment supprimer ce contact ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
