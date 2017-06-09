<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><a href="/roles/add"><button class="btn btn-gradient btn-blue">Nouveau Rôle</button></a></li>
    </ul>
</nav>
<div class="roles index large-9 medium-8 columns content">
    <h3><?= __('Rôles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('libelle') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= h($role->libelle) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $role->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $role->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $role->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $role->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include "paginator.php"; ?>
</div>
