<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rdrfs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rdrfs form large-9 medium-8 columns content">
    <?= $this->Form->create($rdrf) ?>
    <fieldset>
        <legend><?= __('Ajouter Rdrf') ?></legend>
        <?php
            echo $this->Form->control('libelle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>