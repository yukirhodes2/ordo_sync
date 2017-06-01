<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer voie'), ['action' => 'edit', $way->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer voie'), ['action' => 'delete', $way->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $way->id)]) ?> </li>
        <li><?= $this->Html->link(__('Liste des voies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouvelle voie'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['controller' => 'Arrivals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouvel arrivée'), ['controller' => 'Arrivals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Liste des départs'), ['controller' => 'Departures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nouveau départ'), ['controller' => 'Departures', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ways view large-9 medium-8 columns content">
	<span class="error">Page en cours de développement</span>
    <h3><?= 'Voie' ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= $this->Number->format($way->numero) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Arrivées associées') ?></h4>
        <?php if (!empty($way->arrivals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Voie Id') ?></th>
                <th scope="col"><?= __('Train Id') ?></th>
                <th scope="col"><?= __('Rame 1 Id') ?></th>
                <th scope="col"><?= __('Rame 2 Id') ?></th>
                <th scope="col"><?= __('Rame 3 Id') ?></th>
                <th scope="col"><?= __('Arrivée Paris Nord') ?></th>
                <th scope="col"><?= __('Observation EIC') ?></th>
                <th scope="col"><?= __('Observation RLP') ?></th>
                <th scope="col"><?= __('Lavage Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($way->arrivals as $arrivals): ?>
            <tr>
                <td><?= h($arrivals->id) ?></td>
                <td><?= h($arrivals->way_id) ?></td>
                <td><?= h($arrivals->train_id) ?></td>
                <td><?= h($arrivals->train_set1_id) ?></td>
                <td><?= h($arrivals->train_set2_id) ?></td>
                <td><?= h($arrivals->train_set3_id) ?></td>
                <td><?= h($arrivals->paris_nord_arrival) ?></td>
                <td><?= h($arrivals->comment_eic) ?></td>
                <td><?= h($arrivals->comment_rlp) ?></td>
                <td><?= h($arrivals->lavage_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['controller' => 'Arrivals', 'action' => 'view', $arrivals->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['controller' => 'Arrivals', 'action' => 'edit', $arrivals->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Arrivals', 'action' => 'delete', $arrivals->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $arrivals->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Départs associés') ?></h4>
        <?php if (!empty($way->departures)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Way Id') ?></th>
                <th scope="col"><?= __('Train Id') ?></th>
                <th scope="col"><?= __('Train Set1 Id') ?></th>
                <th scope="col"><?= __('Train Set2 Id') ?></th>
                <th scope="col"><?= __('Train Set3 Id') ?></th>
                <th scope="col"><?= __('Paris Nord Departure') ?></th>
                <th scope="col"><?= __('Refouleur Arrival') ?></th>
                <th scope="col"><?= __('Adc Arrival') ?></th>
                <th scope="col"><?= __('Comment Geops') ?></th>
                <th scope="col"><?= __('Comment Rlp') ?></th>
                <th scope="col"><?= __('Comment Cpt') ?></th>
                <th scope="col"><?= __('Comment Eic') ?></th>
                <th scope="col"><?= __('Annoucement') ?></th>
                <th scope="col"><?= __('Formed') ?></th>
                <th scope="col"><?= __('Brake Id') ?></th>
                <th scope="col"><?= __('Osmose') ?></th>
                <th scope="col"><?= __('Restit') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($way->departures as $departures): ?>
            <tr>
                <td><?= h($departures->id) ?></td>
                <td><?= h($departures->way_id) ?></td>
                <td><?= h($departures->train_id) ?></td>
                <td><?= h($departures->train_set1_id) ?></td>
                <td><?= h($departures->train_set2_id) ?></td>
                <td><?= h($departures->train_set3_id) ?></td>
                <td><?= h($departures->paris_nord_departure) ?></td>
                <td><?= h($departures->refouleur_arrival) ?></td>
                <td><?= h($departures->adc_arrival) ?></td>
                <td><?= h($departures->comment_geops) ?></td>
                <td><?= h($departures->comment_rlp) ?></td>
                <td><?= h($departures->comment_cpt) ?></td>
                <td><?= h($departures->comment_eic) ?></td>
                <td><?= h($departures->annoucement) ?></td>
                <td><?= h($departures->formed) ?></td>
                <td><?= h($departures->brake_id) ?></td>
                <td><?= h($departures->osmose) ?></td>
                <td><?= h($departures->restit) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['controller' => 'Departures', 'action' => 'view', $departures->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['controller' => 'Departures', 'action' => 'edit', $departures->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Departures', 'action' => 'delete', $departures->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $departures->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
