<div class="paginator">
	<ul class="pagination">
		<?= $this->Paginator->first('<< ' . __('début')) ?>
		<?= $this->Paginator->prev('< ' . __('précédent')) ?>
		<?= $this->Paginator->numbers() ?>
		<?= $this->Paginator->next(__('suivant') . ' >') ?>
		<?= $this->Paginator->last(__('dernier') . ' >>') ?>
	</ul>
	<p><?= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, {{current}} résultat(s) sur un total de {{count}}')]) ?></p>
</div>