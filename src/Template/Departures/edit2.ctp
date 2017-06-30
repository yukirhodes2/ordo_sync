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
                ['action' => 'delete', $departure->id],
                ['confirm' => __('Voulez-vous vraiment supprimer ce départ ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des départs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departures form large-9 medium-8 columns content">
    <?= $this->Form->create($departure) ?>
    <fieldset>
        <legend><?= __('Editer Départ') ?></legend>
        <?php			
			echo ' Train n°'.$departure->departure_train->numero .' prévu sur voie '.$departure->way->numero.'<br/>';
			
            echo $this->Form->control('restit', ['label' => 'Rendu de voie','empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('restit')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('restit')"]);
            echo '<br/>';
			
            echo $this->Form->control('osmose', ['label' => 'OSMOSE', 'empty' => true]);
            echo $this->Form->control('comment_rlp', ['label' => 'Observations', 'type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
