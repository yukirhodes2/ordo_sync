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
                ['action' => 'delete', $trainSet->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette rame ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des rames'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="trainSets form large-9 medium-8 columns content">
    <?= $this->Form->create($trainSet) ?>
    <fieldset>
        <legend><?= __('Editer une rame') ?></legend>
        <?php
            echo $this->Form->control('numero');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
