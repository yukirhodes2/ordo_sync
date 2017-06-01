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
        <li><?= $this->Html->link(__('Liste des voies'), ['controller' => 'Ways', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'Trains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des rames'), ['controller' => 'TrainSets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des freinages'), ['controller' => 'Brakes', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departures form large-9 medium-8 columns content">
    <?= $this->Form->create($departure) ?>
    <fieldset>
        <legend><?= __('Édition du départ') ?></legend>
        <?php
            echo $this->Form->control('way_id', ['options' => $ways, 'label' => 'Voie']);
            echo $this->Form->control('train_id', ['options' => $trains]);
            echo $this->Form->control('train_set1_id', ['options' => $trainSets, 'empty' => true]);
            echo $this->Form->control('train_set2_id', ['options' => $trainSets, 'empty' => true]);
            echo $this->Form->control('train_set3_id', ['options' => $trainSets, 'empty' => true]);
            echo $this->Form->control('landy_departure', ['empty' => true, 'div' =>false]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('landy_departure')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('landy_departure')"]);
            echo '<br/>';
			echo $this->Form->control('refouleur_arrival', ['empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('refouleur_arrival')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('refouleur_arrival')"]);
            echo '<br/>';
            echo $this->Form->control('adc_arrival', ['empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('adc_arrival')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('adc_arrival')"]);
            echo '<br/>';
            echo $this->Form->control('comment_geops', ['label' => 'Observations GEOPS', 'type' => 'textarea']);
            echo $this->Form->control('comment_rlp', ['label' => 'Observations RLP', 'type' => 'textarea']);
            echo $this->Form->control('comment_cpt', ['label' => 'Observations CPT', 'type' => 'textarea']);
            echo $this->Form->control('comment_eic', ['label' => 'Observations EIC', 'type' => 'textarea']);
            echo $this->Form->control('annoucement', ['empty' => true, 'label' => 'Annonce refouleur/CRML']);
            echo $this->Form->control('formed', ['label' => 'Formé']);
            echo $this->Form->control('brake_id', ['options' => $brakes, 'empty' => true, 'label' => 'Freinage']);
            echo $this->Form->control('osmose', ['empty' => true]);
            echo $this->Form->control('restit', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
