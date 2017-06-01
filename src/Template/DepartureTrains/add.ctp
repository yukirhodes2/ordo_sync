<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Departure Trains'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departureTrains form large-9 medium-8 columns content">
    <?= $this->Form->create($departureTrain) ?>
    <fieldset>
        <legend><?= __('Add Departure Train') ?></legend>
        <?php
            echo $this->Form->control('numero');
            echo $this->Form->control('alerte1');
            echo $this->Form->control('alerte2');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
