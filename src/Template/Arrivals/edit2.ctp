<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Supprimer cette arrivée'),
                ['action' => 'delete', $arrival->id],
                ['confirm' => __('Etes-vous sûr de supprimer cette arrivée ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="arrivals form large-9 medium-8 columns content">
    <?= $this->Form->create($arrival) ?>
    <fieldset>
        <legend><?= __('Editer l\'arrivée') ?></legend>
        <?php
            echo $this->Form->control('protection_time', ['label' => 'Heure de protection de la rame', 'empty'=>true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('protection_time')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('protection_time')"]);
            echo '<br/>';
			
            echo $this->Form->control('comment_rlp', ['label' => 'Observations', 'type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
