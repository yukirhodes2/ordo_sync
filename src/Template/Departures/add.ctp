<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des départs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'Trains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouveau train'), ['controller' => 'Trains', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des opérations de freinage'), ['controller' => 'BrakeControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouvelle opération de freinage'), ['controller' => 'BrakeControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departures form large-9 medium-8 columns content">
    <?= $this->Form->create($departure) ?>
    <fieldset>
        <legend><?= __('Ajouter Départ') ?></legend>
        <?php
            echo $this->Form->control('way_id', ['label' => 'Voie']);
            echo $this->Form->control('train_id', ['options' => $trains]);
			echo $this->Form->control('loc_id', ['label' => 'Loc', 'options' => $trainSets, 'empty' => ['' => '']]);
			echo $this->Form->control('train_set1_id', ['label' => 'Rame 1', 'options' => $trainSets, 'empty' => ['' => '']]);
            echo $this->Form->control('train_set2_id', ['label' => 'Rame 2', 'options' => $trainSets, 'empty' => ['' => '']]);
            echo $this->Form->control('train_set3_id', ['label' => 'Rame 3', 'options' => $trainSets, 'empty' => ['' => '']]);    
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>