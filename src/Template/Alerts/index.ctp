<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Aucune action contextuelle') ?></li>
    </ul>
</nav>
<div class="alerts index large-9 medium-8 columns content">
    <h3><?= __('Alertes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('libelle') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_timer', 'Minuteur départ/arrivée') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_timer', 'Minuteur rendu') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alerts as $alert): ?>
            <tr>
                <td><?= $this->Number->format($alert->id) ?></td>
                <td><?= h($alert->libelle) ?></td>
                <td><?= $this->Number->format($alert->first_timer) ?></td>
                <td><?= $this->Number->format($alert->second_timer) ?></td>
                <td class="actions">
                     <?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['action' => 'edit', $alert->id], ['escape' => false, 'title' => 'Modifier']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include('paginator.php'); ?>
</div>
