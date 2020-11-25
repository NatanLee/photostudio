<section class = "price">
	<h2>Прайс-лист на аренду залов</h2> 
	<section class="price__info">
		<h3>Информация</h3>
		<div>
			<i class="fa fa-info-circle" aria-hidden="true"></i>
			<p>Допускается нахождение в зале не более 6 человек одновременно, включая фотографа.</p>
		</div>
		<div>
			<i class="fa fa-info-circle" aria-hidden="true"></i>
			<p>Возможно увеличение количества человек по согласованию с администратором. Дополнительная плата - 100 рублей за человека.</p>
		</div>
		<div>
			<i class="fa fa-info-circle" aria-hidden="true"></i>
			<p>Цены на новогодние декорированные залы могут измениться.</p>
		</div>
		<div>
			<i class="fa fa-info-circle" aria-hidden="true"></i>
			<p>Стоимость указана в рублях за 55 минут аренды.</p>
		</div>
	</section>
	<table class="price__price-list">
		<thead>
			<tr>
				<th>Зал<th>
				<th>ПН-ПТ с 10:00 до 18:00<th>
				<th>СБ-ВС с 10:00 до 20:00<th>				
			</tr>
		</thead>
		<tbody>
			<?foreach($priceList as $one):?>
			<tr>
				<td><?=$one['roomName']?><td>
				<td><?=$one['firstPrice']?><td>
				<td><?=$one['secondPrice']?><td>
			</tr>
			<?endforeach;?>
		</tbody>		
	</table>
</section>



