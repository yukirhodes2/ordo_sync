<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des alertes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="alerts form large-9 medium-8 columns content">
    <?= $this->Form->create($alert) ?>
    <fieldset>
        <legend><?= __('Editer alerte') ?></legend>
        <?php
            echo $alert->libelle;
            echo $this->Form->control('first_timer', ['label' => 'Minuteur']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
