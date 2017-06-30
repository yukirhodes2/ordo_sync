<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des départs théoriques'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="theoricDepartures form large-9 medium-8 columns content">
    <?= $this->Form->create($theoricDeparture) ?>
    <fieldset>
        <legend><?= __('Nouveau départ théorique') ?></legend>
        <?php
            echo $this->Form->control('train_id', ['options' => $trains]);
            echo $this->Form->control('paris_nord_departure');
            echo $this->Form->input('docking_time');
            echo $this->Form->input('descent_duration');
            echo $this->Form->input('rendition_duration');
            echo $this->Form->control('first_alert_id');
            echo $this->Form->control('second_alert_id', ['options' => $alerts, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
