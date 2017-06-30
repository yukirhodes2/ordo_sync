<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $lavage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $lavage->id], ['confirm' => __('Voulez-vous vraiment supprimer ce lavage ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des MAL'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="lavages view large-9 medium-8 columns content">
    <h3>MAL #<?= h($lavage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Libelle') ?></th>
            <td><?= h($lavage->libelle) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Arrivées associées à ce MAL') ?></h4>
        <?php if (!empty($lavage->arrivals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('ID') ?></th>
                <th scope="col"><?= __('Train') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($lavage->arrivals as $arrivals): ?>
            <tr>
                <td><?= h($arrivals->id) ?></td>
                <td><?= h($arrivals->train->numero) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['controller' => 'Arrivals', 'action' => 'view', $arrivals->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['controller' => 'Arrivals', 'action' => 'edit', $arrivals->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Arrivals', 'action' => 'delete', $arrivals->id], ['confirm' => __('Voulez-vous vraiment supprimer cette arrivée ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
