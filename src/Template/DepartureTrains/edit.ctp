<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $departureTrain->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $departureTrain->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Departure Trains'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departureTrains form large-9 medium-8 columns content">
    <?= $this->Form->create($departureTrain) ?>
    <fieldset>
        <legend><?= __('Edit Departure Train') ?></legend>
        <?php
            echo $this->Form->control('numero');
            echo $this->Form->control('alerte1');
            echo $this->Form->control('alerte2');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
