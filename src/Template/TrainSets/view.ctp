<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer une rame'), ['action' => 'edit', $trainSet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer une rame'), ['action' => 'delete', $trainSet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trainSet->id)]) ?> </li>
        <li><?= $this->Html->link(__('Liste des rames'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouvelle rame'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Liste des libérations de rames'), ['controller' => 'TrainSetReleases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouvelle libération de rame'), ['controller' => 'TrainSetReleases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="trainSets view large-9 medium-8 columns content">
    <h3><?= h($trainSet->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($trainSet->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($trainSet->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Train Set Releases') ?></h4>
        <?php if (!empty($trainSet->train_set_releases)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Heure') ?></th>
                <th scope="col"><?= __('Release1 Id') ?></th>
                <th scope="col"><?= __('Release2 Id') ?></th>
                <th scope="col"><?= __('Status1 Id') ?></th>
                <th scope="col"><?= __('Status2 Id') ?></th>
                <th scope="col"><?= __('Train Set Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($trainSet->train_set_releases as $trainSetReleases): ?>
            <tr>
                <td><?= h($trainSetReleases->id) ?></td>
                <td><?= h($trainSetReleases->heure) ?></td>
                <td><?= h($trainSetReleases->release1_id) ?></td>
                <td><?= h($trainSetReleases->release2_id) ?></td>
                <td><?= h($trainSetReleases->status1_id) ?></td>
                <td><?= h($trainSetReleases->status2_id) ?></td>
                <td><?= h($trainSetReleases->train_set_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['controller' => 'TrainSetReleases', 'action' => 'view', $trainSetReleases->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['controller' => 'TrainSetReleases', 'action' => 'edit', $trainSetReleases->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'TrainSetReleases', 'action' => 'delete', $trainSetReleases->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $trainSetReleases->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
