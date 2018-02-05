<template>
    <div class="bg-clouds">
        <section class="module-progress-bar">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                    <span class="sr-only">80% Complete</span>
                </div>
            </div>
        </section>
        <section class="module-onboarding container">
            <div class="panel-body onboarding">
                    <h1 class="onboarding-title text-center">Start Today</h1>
                    <div class="text-center head-content">
                        WeatherCheck Subscription will automatically begin and you will be billed.
                    </div>
                    <div class="payment-overview col-md-10 col-md-offset-1">
                        <span class="pull-left">${{ cost_per_property }}/year per house: {{ number_of_properties }} units </span>
                        <span class="pull-right">Total: ${{ payment_total }}</span>
                    </div>
                    <form  class="form-payment" role="form">
                        <div class="form-group col-md-8 col-md-offset-2">
                            <label for="discount">Discount Code</label>
                            <input v-model="coupon" v-on:keyup="total_cost()" type="text" class="form-control has-error" placeholder="" >
                            <div class="help-block" id="error-discount" v-show="invalid_discount">Invalid discount code</div>
                        </div>
                        <!-- Cardholder's Name -->
                        <div class="form-group col-md-8 col-md-offset-2">
                            <label for="name">Card Holder Name</label>
                            <input type="text" class="form-control" placeholder="Sonny Tornaldo" v-model="cardForm.name">
                        </div>

                        <!-- Card Number -->
                        <div class="form-group col-md-8 col-md-offset-2" :class="{'has-error': cardForm.errors.has('number')}">
                            <label for="number">Card Number</label>
                            <input type="text" class="form-control" data-stripe="number" placeholder="" v-model="cardForm.number">
                            <span class="help-block" v-show="cardForm.errors.has('number')">
                                    @{{ cardForm.errors.get('number') }}
                            </span>
                        </div>

                        <!-- Security Code and Zip -->
                        <div class="form-group double-container col-md-8 col-md-offset-2">
                            <div class="col-md-6 double-section">
                                <label for="cvv">CVV</label>
                                <input type="text" class="form-control" data-stripe="cvc" v-model="cardForm.cvc">
                            </div>
                            <div class="col-md-6 double-section">
                                <label for="zip" class="col-md-4">Zip</label>
                                <input type="text" class="form-control" v-model="form.zip">
                            </div>
                        </div>

                        <!-- Expiration Information -->
                        <div class="form-group col-md-8 col-md-offset-2">
                            <label>Expiration</label>
                            <div class="row">
                                <!-- Month -->
                                <div class="col-xs-6">
                                    <input type="text" class="form-control"
                                           placeholder="MM" maxlength="2" data-stripe="exp-month" v-model="cardForm.month">
                                </div>

                                <!-- Year -->
                                <div class="col-xs-6">
                                    <input type="text" class="form-control"
                                           placeholder="YYYY" maxlength="4" data-stripe="exp-year" v-model="cardForm.year">
                                </div>
                            </div>
                        </div>

                        <!-- Discount Code -->
                        <div class="form-group col-md-8 col-md-offset-2">
                            <div class="text-center head-content">
                                Payment processing done by <span>stripe</span>
                            </div>
                        </div>
                        <!-- Back & Submit -->
                        <div class="form-group back-next">
                            <div class="col-md-12">
                                <a class="blue-border btn-link btn-tranparent btns-blue" href="/">Back</a>
                                <button v-if="!skip" type="submit" class="btns btns-green pull-right" @click.prevent="processCardAndPayment" :disabled="form.busy">
                                    <span v-if="form.busy">
                                        <i class="fa fa-btn fa-spinner fa-spin"></i>Updating
                                    </span>
                                    <span v-else>
                                            Pay Subscription
                                    </span>
                                </button>

                                <button v-else type="submit" class="btns btns-green pull-right" @click.prevent="processSkip" :disabled="form.busy">
                                    <span v-if="form.busy">
                                        <i class="fa fa-btn fa-spinner fa-spin"></i>Updating
                                    </span>
                                    <span v-else>
                                            Take me to the Dashboard
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div>
                                <span v-if="message">
                                    {{ message }}
                                </span>
                        </div>
                    </form>
                </div>
        </section>
    </div>
</template>
<script>
    export default {
        props: ['user', 'currentTeam'],
        /**
         * The component's data.
         */
        data() {
            return {
                number_of_properties: 0,
                cost_per_property: 0.0,
                payment_total: 0.0,
                skip:false,

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
                }),

                message: '',
                err_message: '',
                current_status: null,
                coupon: '',
                discount: {
                    '100free': 100
                }
            };
        },


        /**
         * Prepare the component.
         */
        mounted() {
            Stripe.setPublishableKey(this.spark.stripeKey);

            this.initializeBillingAddress();

            axios.get('/onboard/payment_order')
                .then(response => {
                    this.number_of_properties = response.data.data.number_of_properties;
                    this.cost_per_property = response.data.data.cost_per_property;
                    this.payment_total = response.data.data.payment_total;
                })
        },

        watch: {

        },
        methods: {
            /**
             * Initialize the billing address form for the billable entity.
             */
            initializeBillingAddress() {
                if (! this.spark.collectsBillingAddress) {
                    return;
                }

                this.form.address = this.billable.billing_address;
                this.form.address_line_2 = this.billable.billing_address_line_2;
                this.form.city = this.billable.billing_city;
                this.form.state = this.billable.billing_state;
                this.form.zip = this.billable.billing_zip;
                this.form.country = this.billable.billing_country || 'US';
            },

            processCardAndPayment(){
                this.update()
            },

            processSkip(){
                window.location.replace("/dashboard");
            },

            /**
             * Update the billable's card information.
             */
            update() {
                this.form.busy = true;
                this.form.errors.forget();
                this.form.successful = false;
                this.cardForm.errors.forget();

                // Here we will build out the payload to send to Stripe to obtain a card token so
                // we can create the actual subscription. We will build out this data that has
                // this credit card number, CVC, etc. and exchange it for a secure token ID.
                const payload = {
                    name: this.cardForm.name,
                    number: this.cardForm.number,
                    cvc: this.cardForm.cvc,
                    exp_month: this.cardForm.month,
                    exp_year: this.cardForm.year,
                    address_line1: this.form.address,
                    address_line2: this.form.address_line_2,
                    address_city: this.form.city,
                    address_state: this.form.state,
                    address_zip: this.form.zip,
                    address_country: this.form.country,
                };

                // Once we have the Stripe payload we'll send it off to Stripe and obtain a token
                // which we will send to the server to update this payment method. If there is
                // an error we will display that back out to the user for their information.
                Stripe.card.createToken(payload, (status, response) => {
                    if (response.error) {
                        this.cardForm.errors.set({number: [
                                response.error.message
                            ]});

                        this.form.busy = false;
                    } else {
                        this.sendUpdateToServer(response.id);
                        this.sendPayment()
                        window.location.replace("/onboard/payment_receipt");
                    }
                });
            },

            sendPayment(){
                const formPayload = {
                    coupon: this.coupon
                }

                axios.post('/onboard/make_payment_order', formPayload)
            },

            /**
             * Send the credit card update information to the server.
             */
            sendUpdateToServer(token) {
                this.form.stripe_token = token;

                Spark.put(this.urlForUpdate, this.form)
                    .then(() => {
                        Bus.$emit('updateUser');
                        Bus.$emit('updateTeam');

                        this.cardForm.name = '';
                        this.cardForm.number = '';
                        this.cardForm.cvc = '';
                        this.cardForm.month = '';
                        this.cardForm.year = '';

                        if ( ! this.spark.collectsBillingAddress) {
                            this.form.zip = '';
                        }

                        this.sendPayment()
                    });
            },
            total_cost() {
                console.log('total_cost');
                if(!this.invalid_discount){
                    let discount = this.discount[this.coupon];
                    let price = this.number_of_properties * this.cost_per_property;
                    let discountPrice = (discount / 100) * price;
                    let total = price - discountPrice;
                    total = total > 0 ? total : 0;
                    if(total === 0){
                        this.skip = true
                    }
                    this.payment_total = total;
                }
            }
        },

        computed: {
            invalid_discount() {
                return this.coupon && !this.discount[this.coupon];
            },

            /**
             * Get the billable entity's "billable" name.
             */
            billableName() {
                return this.billingUser ? this.user.name : this.team.owner.name;
            },


            /**
             * Get the URL for the payment method update.
             */
            urlForUpdate() {
                return this.billingUser
                    ? '/settings/payment-method'
                    : `/settings/${Spark.pluralTeamString}/${this.currentTeam.id}/payment-method`;
            },

            /**
             * Get the placeholder for the billable entity's credit card.
             */
            placeholder() {
                if (this.billable.card_last_four) {
                    return `************${this.billable.card_last_four}`;
                }

                return '';
            }
        }
    }
</script>
