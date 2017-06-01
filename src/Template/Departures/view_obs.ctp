<div class="departures view large-9 medium-8 columns content">
    <h3>Départ #<?= h($departure->id) ?></h3>
    <table class="vertical-table"> 
        <tr>
            <th scope="row"><?= __('Observations EIC') ?></th>
            <td><?= h($departure->comment_eic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observations RLP') ?></th>
            <td><?= h($departure->comment_rlp) ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('Observations CPT') ?></th>
            <td><?= h($departure->comment_cpt) ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('Observations GEOPS') ?></th>
            <td><?= h($departure->comment_geops) ?></td>
        </tr>
    </table>
</div>
