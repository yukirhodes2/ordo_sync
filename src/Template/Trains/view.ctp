<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $train->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $train->id], ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $train->id)]) ?> </li>
        <li><?= $this->Html->link(__('Liste des trains'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['controller' => 'Arrivals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Liste des départs'), ['controller' => 'Departures', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="trains view large-9 medium-8 columns content">
    <h3>Train </h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numéro') ?></th>
            <td><?= h($train->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mise à quai') ?></th>
            <td><?= h(duration($train->theoric_departures['0']->docking_time)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Temps de descente') ?></th>
            <td><?= h(duration($train->theoric_departures['0']->descent_duration)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Temps de montée') ?></th>
            <td><?= h(duration($train->theoric_arrivals['0']->ascent_time)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Temps de rendu matériel') ?></th>
            <td><?= h(duration($train->theoric_departures['0']->rendition_duration)) ?></td>
        </tr>
		<tr>
            <th scope="row" class="arrival"><?= __('Arrivée théorique Landy') ?></th>
            <td><?= h($train->theoric_arrivals['0']->paris_nord_arrival) ?></td>
        </tr>
		<tr>
            <th scope="row" class="departure"><?= __('Départ théorique Landy') ?></th>
            <td><?= h($train->theoric_departures['0']->paris_nord_departure) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Arrivées associées') ?></h4>
        <?php if (!empty($train->arrivals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Arrivée Paris Nord') ?></th>
                <th scope="col"><?= __('MAL') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($train->arrivals as $arrivals): ?>
            <tr>
                <td><?= h($arrivals->id) ?></td>
                <td><?= h($arrivals->paris_nord_arrival) ?></td>
                <td><?= $arrivals->has('lavage') ? h($arrivals->lavage->libelle) : 'Non défini' ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png', ['alt' => __('Voir'), 'class' => 'icon']), ['controller' => 'Arrivals', 'action' => 'view', $arrivals->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
                    <?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['controller' => 'Arrivals', 'action' => 'edit', $arrivals->id], ['escape' => false, 'title' => 'Modifier']) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['controller' => 'Arrivals', 'action' => 'delete', $arrivals->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $arrivals->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
	
    <div class="related">
        <h4><?= __('Départs associés') ?></h4>
        <?php if (!empty($train->departures)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Voie') ?></th>
                <th scope="col"><?= __('Départ réel Landy') ?></th>
                <th scope="col"><?= __('Type de freinage') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($train->departures as $departures): ?>
            <tr>
                <td><?= h($departures->id) ?></td>
                <td><?= h($departures->way->numero) ?></td>
                <td><?= h($departures->landy_departure) ?></td>
                <td><?= $departures->has('brake') ? h($departures->brake->type) : 'Non défini' ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png', ['alt' => __('Voir'), 'class' => 'icon']), ['controller' => 'Departures', 'action' => 'view', $departures->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
                    <?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['controller' => 'Departures', 'action' => 'edit', $departures->id], ['escape' => false, 'title' => 'Modifier']) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['controller' => 'Departures', 'action' => 'delete', $departures->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $departures->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
