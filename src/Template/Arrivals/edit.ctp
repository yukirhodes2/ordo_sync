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
                ['action' => 'delete', $arrival->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette arrivée ?', $arrival->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'Trains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des rames'), ['controller' => 'TrainSets', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="arrivals form large-9 medium-8 columns content">
    <?= $this->Form->create($arrival) ?>
    <fieldset>
        <legend><?= __('Editer arrivée') ?></legend>
        <?php
            echo $this->Form->control('way_id', ['options' => $ways, 'label' => 'Voie']);
            echo $this->Form->control('train_id', ['options' => $trains]);
            echo $this->Form->control('train_set1_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 1']);
            echo $this->Form->control('train_set2_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 2']);
            echo $this->Form->control('train_set3_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 3']);
            echo $this->Form->control('paris_nord_arrival', ['label' => 'Arrivée PNO (valeur dépréciée)', 'disabled' => true]);
            echo $this->Form->control('landy_arrival', ['label' => 'Arrivée Landy ', 'disabled' => true]);
            echo $this->Form->control('comment_eic', ['label' => 'Observations EIC', 'type' => 'textarea']);
            echo $this->Form->control('comment_rlp', ['label' => 'Observations RLP', 'type' => 'textarea']);
            echo $this->Form->control('lavage_id', ['options' => $lavages, 'empty' => true, 'MAL']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
