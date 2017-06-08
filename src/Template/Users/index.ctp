<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouvel utilisateur'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Utilisateurs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('username', __('Nom d\'utilisateur')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
				<th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', __('Créé')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified', __('Modifié')) ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user):?>
            <tr>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->prenom) ?></td>
                <td><?= h($user->nom) ?></td>
                <td><?= h($user->role->libelle) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png', ['alt' => __('Voir'), 'class' => 'icon']), ['action' => 'view', $user->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
                    <?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['action' => 'edit', $user->id], ['escape' => false, 'title' => 'Modifier']) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['action' => 'delete', $user->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include('paginator.php'); ?>
</div>
