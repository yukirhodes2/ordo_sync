<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau train'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trains index large-9 medium-8 columns content">
    <h3><?= __('Trains') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paris_nord_arrival', 'Arrivée Landy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paris_nord_departure', 'Départ Landy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('docking_time', 'Mise à quai') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descent_duration', 'Temps de descente') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ascent_duration', 'Temps de montée') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rendition_duration', 'Temps de rendu matériel') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trains as $train): ?>
            <tr>
                <td><?= h($train->numero) ?></td>
                <td><?= h($train->theoric_arrivals['0']->paris_nord_arrival) ?></td>
                <td><?= h($train->theoric_departures['0']->paris_nord_departure) ?></td>
                <td><?= h(duration($train->theoric_departures['0']->docking_time)) ?></td>
				<td><?= h(duration($train->theoric_departures['0']->descent_duration)) ?></td>
				<td><?= h(duration($train->theoric_arrivals['0']->ascent_time)) ?></td>
				<td><?= h(duration($train->theoric_departures['0']->rendition_duration)) ?></td>
				<td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png', ['alt' => __('Voir'), 'class' => 'icon']), ['action' => 'view', $train->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
                    <?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['action' => 'edit', $train->id], ['escape' => false, 'title' => 'Modifier']) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['action' => 'delete', $train->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $train->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<?php include "paginator.php"; ?>
</div>
