Vue.component('vue-google-autocomplete'), {
    data() {
        return {
            address: ''
        }
    },

    mounted() {
        // To demonstrate functionality of exposed component functions
        // Here we make focus on the user input
        this.$refs.address.focus();
    },

    methods: {
        /**
         * When the location found
         * @param {Object} addressData Data of the found location
         * @param {Object} placeResultData PlaceResult object
         * @param {String} id Input container ID
         */
        getAddressData: function (addressData, placeResultData, id) {
            this.address = addressData;
        }
    }
}