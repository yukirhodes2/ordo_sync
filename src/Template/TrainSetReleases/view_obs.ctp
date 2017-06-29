<div class="departures view large-9 medium-8 columns content">
    <h3>Départ #<?= h($trainSetRelease->id) ?></h3>
    <table class="vertical-table"> 
        <tr>
            <th scope="row"><?= __('Observations RLP') ?></th>
            <td><?= h($trainSetRelease->comment) ?></td>
        </tr>
    </table>
</div>
