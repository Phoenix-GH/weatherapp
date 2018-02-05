<template>
    <div class="bg-clouds manual-properties">
        <section class="module-progress-bar">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    <span class="sr-only">60% Complete</span>
                </div>
            </div>
        </section>
        <section class="module-onboarding container">
            <div class="panel-body onboarding">
                <h1 class="onboarding-title text-center">Manually enter your properties</h1>

                <div class="properties-added" v-for="(property, index) in properties">
                    <div class="property-import m-b-5">
                        <div class="p-l-5 p-t-5">
                            {{ property.name }} -  {{ property.street }} - {{ property.city }}
                        </div>
                        <div class="text-right p-r-5 p-b-5">
                            <a href="#" @click="edit(index , property)"> Edit </a>
                            <a href="#" @click="remove(index)"> remove </a>
                        </div>
                    </div>
                </div>
                <form class="payment-form" @submit.prevent="submit()">
                    <!-- Name -->
                    <div class="form-group col-md-8 col-md-offset-2">
                        <label for="name">Name</label>
                        <input type="text"  name="name" id="name" v-model="currentProperty.name">
                    </div>

                    <!-- Street -->
                    <div class="form-group col-md-8 col-md-offset-2">
                        <label for="name">Street Address</label>
                        <input type="text"  name="street" id="street" v-model="currentProperty.street">
                    </div>

                    <!-- City -->
                    <div class="form-group col-md-8 col-md-offset-2">
                        <label for="city">City</label>
                        <input type="text"  name="city" id="city" v-model="currentProperty.city">
                    </div>

                    <!-- State & Zip-->
                    <div class="form-group col-md-8 col-md-offset-2">
                        <div class="col-md-6">
                            <label for="state">State</label>
                            <input class="form-control" type="text"  name="state" id="state" v-model="currentProperty.state">
                        </div>
                        <div class="col-md-6">
                            <label for="zip">Zip Code</label>
                            <input class="form-control" type="text"  name="zip" id="zip" v-model="currentProperty.zip">
                        </div>
                    </div>

                    <!-- Country -->
                    <div class="form-group col-md-8 col-md-offset-2">
                        <label for="country">Country</label>
                        <input type="text"  name="country" id="country" v-model="currentProperty.country">
                    </div>

                    <!-- Login Button -->
                    <div class="form-group login-button add-button">
                        <div class="col-md-offset-3 col-md-6 m-b-75">
                            <button type="button" class="blue-border btn-link btn-tranparent btns-blue m-b-15" @click="add()">
                                Add Another Address
                            </button>
                        </div>
                    </div>

                    <!-- Back & Submit -->
                    <div class="form-group">
                        <div class="col-md-12">
                            <a class="blue-border btn-link btn-tranparent btns-blue" href="/onboard/import">Back</a>
                            <button type="submit" class="btns btns-green pull-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</template>
<script>

    export default {
        data () {
            return {
                properties: [],
                currentProperty: {
                    name: null,
                    street: null,
                    city: null,
                    zip: null,
                    state: null,
                    country: null,
                    index: null,
                }
            };
        },
        mounted () {
            //
        },
        computed: {

        },
        watch: {

        },
        methods: {
            add () {
                if(this.currentProperty.index === null){
                    this.properties.push(this.currentProperty);
                }else{
                    this.properties[this.currentProperty.index] = this.currentProperty
                }

                this.currentProperty = {
                    name: null,
                    street: null,
                    city: null,
                    zip: null,
                    state: null,
                    country: null,
                    index: null,
                };
            },
            edit (index , property) {
                this.currentProperty = {
                    name: property.name,
                    street: property.street,
                    city: property.city,
                    zip: property.zip,
                    state: property.state,
                    country: property.country,
                    index: index,
                };
            },
            remove (index) {
                this.properties.splice(index, 1);
            },
            submit () {
                this.busy = true;
                axios.post('property_api_upload',this.properties)
                window.location.replace("/onboard/importing_properties");
            },
        },
    };
</script>