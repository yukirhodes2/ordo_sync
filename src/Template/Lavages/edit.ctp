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
                ['action' => 'delete', $lavage->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $lavage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des MAL'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="lavages form large-9 medium-8 columns content">
    <?= $this->Form->create($lavage) ?>
    <fieldset>
        <legend><?= __('Editer MAL') ?></legend>
        <?php
            echo $this->Form->control('libelle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
