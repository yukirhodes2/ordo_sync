<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau Contact'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des fonctions'), ['controller' => 'Positions', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="contacts index large-9 medium-8 columns content">
    <h3><?= __('Contacts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('position_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mail') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= h($contact->name) ?></td>
                <td><?= h($contact->surname) ?></td>
                <td><?= $contact->has('position') ? $this->Html->link($contact->position->id, ['controller' => 'Positions', 'action' => 'view', $contact->position->id]) : '' ?></td>
                <td><?= h($contact->mail) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $contact->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $contact->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $contact->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $contact->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
