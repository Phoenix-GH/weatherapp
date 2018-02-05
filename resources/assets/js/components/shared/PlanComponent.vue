<template>
	<section>
		<div class="plan-block thick-color">
			<h4 class="edit-heading">Plan Information</h4>
			<form class="edit-plan" role="form">

				<!-- Plan Type -->
				<div class="form-group">
					<label for="plan-type">Plan Type</label>
					<span class="desc">Yearly</span>
				</div>

				<!-- Plan Start Date -->
				<div class="form-group">
					<label for="plan-date">Plan Start Date</label>
					<span class="desc">MM/DD/YY</span>
				</div>

				<!-- Next Billing Date -->
				<div class="form-group">
					<label for="next-billing">Next Billing Date</label>
					<span class="desc">MM/DD/YY</span>
				</div>

				<!-- Next Payment Amount -->
				<div class="form-group">
					<label for="payment-amount">Next Payment Amount</label>
					<span class="desc">$70.00</span>
				</div>

				<!-- Edit -->
				<div class="form-group login-button">
					<div class="float-unset">
						<button type="submit" class="btn btn-green" data-toggle="modal" data-target="#editPlanModal">
							Edit
						</button>
					</div>
				</div>
			</form>
		</div>
		<div id="editPlanModal" class="modal myModals fade" role="dialog">
			<div class="modal-dialog" >

				<!-- Modal content-->
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-body">
						<h4>Edit Plan Information</h4>
						
						<div class="bottom-section">
							
							<form class="plan-edit-form">
								
								<!-- Plan Type -->
								<div class="form-group">
									<label for="plan-type">Plan Type</label>
									<select>
										<option>Yearly</option>
										<option>Weekly</option>
										<option>Monthly</option>
									</select>
								</div>

								<!-- start date and billing date -->
								<div class="form-group row">
									<div class="col-md-6">
										<label for="plan-start">Plan Start Date</label>
										<input type="text" class="form-control" placeholder="MM/DD/YY">
									</div>
									<div class="col-md-6">
										<label for="next-billing">Next Billing Date</label>
										<input type="text" class="form-control" placeholder="MM/DD/YY">
									</div>
								</div>

								<!-- Next Payment Amount -->
								<div class="form-group">
									<label for="payment-amount">Next Payment Amount</label>
									<input type="text" class="form-control" placeholder="$70.00">
								</div>

								<!-- Back & Submit -->
				                <div class="form-group login-button">
				                	<div class="float-unset">
				                		<a href="#" class="blue-border pull-left btn-link btn-tranparent btns-blue"  data-dismiss="modal">Back</a>
				                		<button type="submit" class="btn pull-right btn-green">
					                    Save
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

    /**
     * The component's data.
     */
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


    /**
     * Prepare the component.
     */
    mounted() {
        Stripe.setPublishableKey(Spark.stripeKey);

        this.initializeBillingAddress();
    },


    methods: {
        /**
         * Initialize the billing address form for the billable entity.
         */
        initializeBillingAddress() {
            if (! Spark.collectsBillingAddress) {
                return;
            }

            this.form.address = this.billable.billing_address;
            this.form.address_line_2 = this.billable.billing_address_line_2;
            this.form.city = this.billable.billing_city;
            this.form.state = this.billable.billing_state;
            this.form.zip = this.billable.billing_zip;
            this.form.country = this.billable.billing_country || 'US';
        },


   
    },


    computed: {
        /**
         * Get the billable entity's "billable" name.
         */
        billableName() {
            return this.billingUser ? this.user.name : this.team.owner.name;
        }
    }
	}
</script>