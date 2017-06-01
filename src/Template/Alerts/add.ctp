<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Alerts'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="alerts form large-9 medium-8 columns content">
    <?= $this->Form->create($alert) ?>
    <fieldset>
        <legend><?= __('Ajouter Alert') ?></legend>
        <?php
            echo $this->Form->control('libelle');
            echo $this->Form->control('first_timer');
            echo $this->Form->control('second_timer');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
