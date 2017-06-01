<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer un intervenant'), ['action' => 'edit', $present->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer un intervenant'), ['action' => 'delete', $present->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $present->id)]) ?> </li>
        <li><?= $this->Html->link(__('Liste des intervenants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouveau intervenant'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="presents view large-9 medium-8 columns content">
    <h3><?= h($present->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Libelle') ?></th>
            <td><?= h($present->libelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($present->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Brake Controls') ?></h4>
        <?php if (!empty($present->brake_controls)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Departure Id') ?></th>
                <th scope="col"><?= __('Present Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($present->brake_controls as $brakeControls): ?>
            <tr>
                <td><?= h($brakeControls->id) ?></td>
                <td><?= h($brakeControls->departure_id) ?></td>
                <td><?= h($brakeControls->present_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['controller' => 'BrakeControls', 'action' => 'view', $brakeControls->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['controller' => 'BrakeControls', 'action' => 'edit', $brakeControls->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'BrakeControls', 'action' => 'delete', $brakeControls->id], ['confirm' => __('Are you sure you want to delete # {0}?', $brakeControls->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
