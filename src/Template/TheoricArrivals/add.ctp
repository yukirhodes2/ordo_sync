<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des arrivées théoriques'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="theoricArrivals form large-9 medium-8 columns content">
    <?= $this->Form->create($theoricArrival) ?>
    <fieldset>
        <legend><?= __('Nouvelle arrivée théorique') ?></legend>
        <?php
            echo $this->Form->control('train_id', ['options' => $trains]);
            echo $this->Form->control('paris_nord_arrival');
            echo $this->Form->control('ascent_time');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
