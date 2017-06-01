<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('Listes des utilisateurs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouvel utilisateur'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Identifiant') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rôle Id') ?></th>
            <td><?= h($user->role->libelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crée le') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modifié le') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
</div>
