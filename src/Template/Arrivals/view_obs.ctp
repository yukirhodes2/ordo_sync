<div class="arrivals view large-9 medium-8 columns content">
    <h3>Arrivée #<?= h($arrival->id) ?></h3>
    <table class="vertical-table"> 
        <tr>
            <th scope="row"><?= __('Observations EIC') ?></th>
            <td><?= h($arrival->comment_eic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observations RLP') ?></th>
            <td><?= h($arrival->comment_rlp) ?></td>
        </tr>
    </table>
</div>
