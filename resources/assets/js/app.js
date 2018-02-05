
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Bootstrap
 |--------------------------------------------------------------------------
 |
 | First, we will load all of the "core" dependencies for Spark which are
 | libraries such as Vue and jQuery. This also loads the Spark helpers
 | for things such as HTTP calls, forms, and form validation errors.
 |
 | Next, we'll create the root Vue application for Spark. This will start
 | the entire application and attach it to the DOM. Of course, you may
 | customize this script as you desire and load your own components.
 |
 */

require('spark-bootstrap');

require('./components/bootstrap');

import VueGoogleAutocomplete from 'vue-google-autocomplete'

Spark.forms.register = {
    account_type: ''
};

// import RegisterComponent from './components/onboard/RegisterComponent.vue'; //(testing)
// Vue.component('register',RegisterComponent); //(testing)

Vue.component('RegisterComponent', require('./components/onboard/RegisterComponent.vue'));
Vue.component('PaymentReceiptComponent',require('./components/onboard/PaymentReceiptComponent.vue'));
Vue.component('PaymentProfileComponent',require('./components/onboard/PaymentProfileComponent.vue'));
Vue.component('PropertyImportComponent',require('./components/onboard/PropertyImportComponent.vue'));
Vue.component('ManualPropertyImportComponent',require('./components/onboard/ManualPropertyImportComponent.vue'));
Vue.component('ImportingPropertyAnimationComponent',require('./components/onboard/ImportingPropertyAnimationComponent.vue'));
Vue.component('NotificationSettingsComponent',require('./components/onboard/NotificationSettingsComponent.vue'));
Vue.component('ResetPassword',require('./components/onboard/ResetPasswordComponent.vue'));
Vue.component('ModalComponent', require('./components/shared/ModalComponent.vue'));
Vue.component('NotificationSettings',require('./components/property/NotificationSettings.vue'));
Vue.component('MaintenanceChecklist',require('./components/property/MaintenanceChecklist.vue'));
Vue.component('WeatherEvents',require('./components/property/WeatherEvents.vue'));
Vue.component('PropertyInsurance',require('./components/property/PropertyInsurance.vue'));
Vue.component('PropertyList',require('./components/property/PropertyList.vue'));
Vue.component('ConvectiveOutlooks',require('./components/property/ConvectiveOutlooks.vue'));
Vue.component('Property',require('./components/property/Property.vue'));
Vue.component('LogoutRedirect',require('./components/property/LogoutRedirect.vue'));
Vue.component('BillingShow',require('./components/shared/BillingShow.vue'));
Vue.component('PlanComponent',require('./components/shared/PlanComponent.vue'));
Vue.component('InvoicesComponent',require('./components/shared/InvoicesComponent.vue'));

var app = new Vue({
        mixins: [require('spark')]
});

