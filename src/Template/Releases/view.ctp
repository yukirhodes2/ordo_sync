<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $release->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer', ['action' => 'delete', $release->id], ['confirm' => __('Voulez-vous vraiment supprimer cette libération ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des libérations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouvelle libération'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="releases view large-9 medium-8 columns content">
    <h3><?= h($release->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Libelle') ?></th>
            <td><?= h($release->libelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($release->id) ?></td>
        </tr>
    </table>
</div>
