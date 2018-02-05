<template>
	<section>
		<div class="plan-block thick-color">
			<h4 class="edit-heading">Previous invoices</h4>
			<table class="previous-invoices">
				<tr>
					<th>&nbsp;</th>
					<th>Date</th>
					<th>Invoice number</th>
					<th>Number of Properties</th>
					<th>Total Cost</th>
				</tr>
				<tr>
					<td><input type="checkbox"/></td>
					<td>MM/DD/YY</td>
					<td>217811</td>
					<td>1</td>
					<td>$70.00</td>
				</tr>
				<tr>
					<td><input type="checkbox"/></td>
					<td>MM/DD/YY</td>
					<td>867889</td>
					<td>1</td>
					<td>$70.00</td>
				</tr>
				<tr>
					<td><input type="checkbox"/></td>
					<td>MM/DD/YY</td>
					<td>045566</td>
					<td>2</td>
					<td>$140.00</td>
				</tr>
			</table>
			<div class="float-unset invoices">
				<button type="submit" class="btn btn-green invoice-button">
					Download
				</button>
			</div>
		</div>
	</section>
</template>
