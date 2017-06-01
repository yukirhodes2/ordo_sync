<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $theoricDeparture->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $theoricDeparture->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des départs théorique'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'Trains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouveau train'), ['controller' => 'Trains', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="theoricDepartures form large-9 medium-8 columns content">
    <?= $this->Form->create($theoricDeparture) ?>
    <fieldset>
        <legend><?= __('Editer un départ théorique') ?></legend>
        <?php
            echo $this->Form->control('train_id', ['options' => $trains]);
            echo $this->Form->control('paris_nord_departure');
            echo $this->Form->control('docking_time');
            echo $this->Form->control('descent_duration');
            echo $this->Form->control('rendition_duration');
            echo $this->Form->control('first_alert_id');
            echo $this->Form->control('second_alert_id', ['options' => $alerts, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
