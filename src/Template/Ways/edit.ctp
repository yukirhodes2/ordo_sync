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
                ['action' => 'delete', $way->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette voie ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des voies'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ways form large-9 medium-8 columns content">
    <?= $this->Form->create($way) ?>
    <fieldset>
        <legend><?= __('Editer une voie') ?></legend>
        <?php
            echo $this->Form->control('numero');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
