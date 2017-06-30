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
                ['action' => 'delete', $rdrf->id],
                ['confirm' => __('Voulez-vous vraiment supprimer ce RD/RF ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste RD/RF'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rdrfs form large-9 medium-8 columns content">
    <?= $this->Form->create($rdrf) ?>
    <fieldset>
        <legend><?= __('Editer RD/RF') ?></legend>
        <?php
            echo $this->Form->control('libelle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
