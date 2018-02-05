module.exports = {
    props: ['user'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: $.extend(true, new SparkForm({
                name: '',
                email: '',
                phone: ''
            }), Spark.forms.updateContactInformation)
        };
    },


    /**
     * Bootstrap the component.
     */
    mounted() {
        this.form.name = this.user.name;
        this.form.email = this.user.email;
        this.form.phone = this.user.phone;
    },


    methods: {
        /**
         * Update the user's contact information.
         */
        update() { 
        $('.profileContact').hide();
        $('.contactFormEdit').show(); 
            Spark.put('/settings/contact', this.form)
                .then(() => {
                    Bus.$emit('updateUser');
                });
        },
         EditProfile() {
        $('.profileContact').hide();
        $('.contactFormEdit').show();      
        },

        backProfile(){
        $('.profileContact').show();
        $('.contactFormEdit').hide();   
        }

    }
};
