<template :user="user" :team="team" :billable-type="billableType">
	<section>
		<div class="billing-block thick-color">

			<h4 class="edit-heading">Billing Information</h4>
			<form class="edit-billing" role="form">
				<!-- Name -->
				<div class="form-group name-block">
					<label for="name">Name</label>
					<input type="text" class="form-control" placeholder="John Doe">
				</div>

				<!-- Link to Stripe -->
				<div class="form-group">
					<label for="name">Link to Stripe</label>
					<div class="data">Not linked</div>
					<a href="modal-link" data-toggle="modal" data-target="#linkstripeModal">Link Account</a>
				</div>

				<!-- Payment Methods -->
				<div class="form-group">
					<label for="name">Payment Methods</label>
					<div class="data">xxxx-xxxx-xxxx-5555</div>
					<a href="modal-link" data-toggle="modal" data-target="#editPaymentModal">Edit</a>
				</div>
				<div class="form-group">
					<label for="name">&nbsp;</label>
					<div class="data">xxxx-xxxx-xxxx-5555</div>
					<a href="modal-link" data-toggle="modal" data-target="#editPaymentModal">Edit</a>
				</div>
				<div class="form-group">
					<label for="name">&nbsp;</label>
					<div class="data">&nbsp;</div>
					<a href="modal-link" data-toggle="modal" data-target="#addPaymentModal">Add Payment Method</a>
				</div>

				<!-- Submit -->
				<div class="form-group login-button">
					<div class="float-unset">
						<button type="submit" class="btn btn-green" @click.prevent="checking">
							Save
						</button>
					</div>
				</div>
			</form>



		</div>
		<div id="linkstripeModal" class="modal myModals fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-body">
						<h4>Link Stripe Account</h4>
						<div class="stripe-logo text-center">
							<img src="/images/stripe-logo.png" alt="">
						</div>
						<div class="bottom-section">
							<a class="stripe-connect" href="#" @click.prevent="showFormStripe">
								<img src="/images/stripe-connect.png" alt="">
							</a>
							<!-- Publishable Key -->
							<form class="stripe-connect-form" style="display: none;">
								<div class="form-group">
									<label for="name">Publishable Key</label>
									<input type="text" class="form-control" placeholder="**************************">
								</div>

								<!-- Secret Key -->
								<div class="form-group">
									<label for="name">Secret Key</label>
									<input type="text" class="form-control" placeholder="**************************">
								</div>

								<p><a href="#" class="stripe-link">Click Here</a> to get your Stripe API keys.</p>

								<!-- Connect Button -->
								<div class="form-group login-button">
									<div class="float-unset">
										<button type="submit" class="btn btn-green">
											Connect
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="editPaymentModal" class="modal myModals fade" role="dialog">
			<div class="modal-dialog" >

				<!-- Modal content-->
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-body">
						<h4>Edit Payment Method</h4>
						
						<div class="bottom-section">
							
							<form class="payment-method-form">
								
								<!-- Card Holder Name -->
								<div class="form-group">
									<label for="name">Card Holder Name</label>
									<input type="text" class="form-control" placeholder="Sonny Tomado">
								</div>

								<!-- Card Number -->
								<div class="form-group">
									<label for="name">Card Number</label>
									<input type="text" class="form-control" placeholder="Placeholder">
								</div>

								<!-- Cvv & Exp. Date -->
								<div class="form-group row">
									<div class="col-md-6">
										<label for="name">CVV</label>
										<input type="text" class="form-control" placeholder="Placeholder">
									</div>
									<div class="col-md-6">
										<label for="name">Exp. Date</label>
										<input type="text" class="form-control" placeholder="Placeholder">
									</div>
								</div>

								<!-- Zip -->
								<div class="form-group">
									<label for="name">Zip</label>
									<input type="text" class="form-control" placeholder="Placeholder">
								</div>

								<p>Payment processing done by <img class="small-logo" src="/images/stripe-logo-small.png" alt=""></p>

								<!-- Back & Submit -->
				                <div class="form-group login-button">
				                    <div class="float-unset">
				                        <a class="delete-photo pull-left" href="#">Delete Payment Method</a>
				                        <button type="submit" class="btn pull-right btn-green">
				                        Add Card
				                        </button>
				                    </div>
				                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="addPaymentModal" class="modal myModals fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-body">
						<h4>Add Payment Methods</h4>
						
						<div class="bottom-section">
							
							<form class="payment-method-form">
								
								<!-- Card Holder Name -->
								<div class="form-group">
									<label for="name">Card Holder Name</label>
									<input type="text" class="form-control" placeholder="Sonny Tomado">
								</div>

								<!-- Card Number -->
								<div class="form-group">
									<label for="name">Card Number</label>
									<input type="text" class="form-control" placeholder="Placeholder">
								</div>

								<!-- Cvv & Exp. Date -->
								<div class="form-group row">
									<div class="col-md-6">
										<label for="name">CVV</label>
										<input type="text" class="form-control" placeholder="Placeholder">
									</div>
									<div class="col-md-6">
										<label for="name">Exp. Date</label>
										<input type="text" class="form-control" placeholder="Placeholder">
									</div>
								</div>

								<!-- Zip -->
								<div class="form-group">
									<label for="name">Zip</label>
									<input type="text" class="form-control" placeholder="Placeholder">
								</div>

								<p>Payment processing done by <img class="small-logo" src="/images/stripe-logo-small.png" alt=""></p>

								<!-- Back & Submit -->
				                <div class="form-group login-button">
				                    <div class="float-unset">
				                        <button type="submit" class="btn btn-green">
				                        Add Card
				                        </button>
				                    </div>
				                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		props: ['user', 'team', 'billableType'],
		data() {
        return {
            form: new SparkForm({
                stripe_token: '',
                address: '',
                address_line_2: '',
                city: '',
                state: '',
                zip: '',
                country: 'US'
            }),

            cardForm: new SparkForm({
                name: '',
                number: '',
                cvc: '',
                month: '',
                year: ''
            })
        };
    },

		methods: {

			showFormStripe() {
				$(".stripe-connect").hide();
				$(".stripe-connect-form").show();
			}
		}
	}
</script>