<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des voies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['controller' => 'Arrivals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouvel arrivée'), ['controller' => 'Arrivals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Liste des départs'), ['controller' => 'Departures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouveau départ'), ['controller' => 'Departures', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ways form large-9 medium-8 columns content">
    <?= $this->Form->create($way) ?>
    <fieldset>
        <legend><?= __('Ajouter une voie') ?></legend>
        <?php
            echo $this->Form->control('numero');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
