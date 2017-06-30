<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $delay->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $delay->id], ['confirm' => __('Voulez-vous vraiment supprimer ce type de retard ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des types de retard'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="delays view large-9 medium-8 columns content">
    <h3>Retard #<?= h($delay->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Libelle') ?></th>
            <td><?= h($delay->libelle) ?></td>
        </tr>
    </table>
</div>
