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
                ['action' => 'delete', $release->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $release->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des libérations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="releases form large-9 medium-8 columns content">
    <?= $this->Form->create($release) ?>
    <fieldset>
        <legend><?= __('Editer une libération') ?></legend>
        <?php
            echo $this->Form->control('libelle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
