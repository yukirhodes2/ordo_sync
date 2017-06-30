<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau train type arrivée'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="arrivalTrains index large-9 medium-8 columns content">
    <h3><?= __('Trains type arrivée') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
				<th scope="col"><?= $this->Paginator->sort('landy_arrival', 'Arrivée Théorique PNO') ?></th>
				<th scope="col"><?= $this->Paginator->sort('paris_nord_arrival', 'Arrivée Théorique Landy') ?></th>
				<th scope="col"><?= $this->Paginator->sort('ascent_time', 'Temps de montée') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arrivalTrains as $arrivalTrain): ?>
            <tr>
                <td><?= h($arrivalTrain->numero) ?></td>
				<td><?= h($this->Time->format($arrivalTrain->theoric_arrivals['0']->paris_nord_arrival, "HH:mm")) ?></td>
				<td><?= h($this->Time->format($arrivalTrain->theoric_arrivals['0']->landy_arrival, "HH:mm")) ?></td>
				<td><?= h(duration($arrivalTrain->theoric_arrivals['0']->ascent_time)) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png', ['alt' => __('Voir'), 'class' => 'icon']), ['action' => 'view', $arrivalTrain->id], ['escape' => false, 'title' => 'Plus de détails']) ?>
                    <?= $this->Html->link($this->Html->image('edit.png', ['alt' => __('Editer'), 'class' => 'icon']), ['action' => 'edit', $arrivalTrain->id], ['escape' => false, 'title' => 'Modifier']) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png', ['alt' => __('Supprimer'), 'class' => 'icon']), ['action' => 'delete', $arrivalTrain->id], ['escape' => false, 'title' => 'Supprimer', 'confirm' => __('Voulez-vous vraiment supprimer ce train type arrivée ?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include('paginator.php'); ?>
</div>
