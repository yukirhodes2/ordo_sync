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
                ['action' => 'delete', $rdrf->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rdrf->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rdrfs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rdrfs form large-9 medium-8 columns content">
    <?= $this->Form->create($rdrf) ?>
    <fieldset>
        <legend><?= __('Edit Rdrf') ?></legend>
        <?php
            echo $this->Form->control('libelle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
