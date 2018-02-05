module.exports = {
    props: ['user', 'team', 'billableType'],

    /**
     * The component's data.
     */
   

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
      

        checking()
        {
            alert("fbdfshfdh");
        }


        /**
         * Update the billable's card information.
         */
      

        /**
         * Send the credit card update information to the server.
         */
    },


    computed: {
      
    }
};
