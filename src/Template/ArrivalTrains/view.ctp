<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editer'), ['action' => 'edit', $arrivalTrain->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $arrivalTrain->id], ['confirm' => __('Voulez-vous vraiment supprimer ce train ?')]) ?> </li>
        <li><?= $this->Html->link(__('Liste des trains type arrivée'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="arrivalTrains view large-9 medium-8 columns content">
    <h3>Train type arrivée</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numéro') ?></th>
            <td><?= h($arrivalTrain->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Temps de montée') ?></th>
            <td><?= h(duration($arrivalTrain->theoric_arrivals['0']->ascent_time)) ?></td>
        </tr>
		<tr>
            <th scope="row" class="arrival"><?= __('Arrivée théorique PNO') ?></th>
            <td><?= h($this->Time->format($arrivalTrain->theoric_arrivals['0']->paris_nord_arrival, "HH:mm")) ?></td>
        </tr>
		<tr>
            <th scope="row" class="arrival"><?= __('Arrivée théorique Landy') ?></th>
            <td><?= h($this->Time->format($arrivalTrain->theoric_arrivals['0']->landy_arrival, "HH:mm")) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Arrivées associées') ?></h4>
        <?php if (!empty($arrivalTrain->arrivals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Arrivée Paris Nord') ?></th>
                <th scope="col"><?= __('MAL') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($arrivalTrain->arrivals as $arrivals): ?>
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
	
</div>

