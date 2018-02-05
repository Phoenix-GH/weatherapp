<template>
    <div class="bg-clouds">
        <section class="module-progress-bar">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100" style="width: 64%;">
                    <span class="sr-only">64% Complete</span>
                </div>
            </div>
        </section>
        <section class="module-onboarding container">
            <div class="onboarding">
                <h1 class="onboarding-title text-center">Notification Settings</h1>
                <div class="notify-container">
                    <div class="weather-event text-center">
                        <img src="/images/hail.png">
                        <p class="event-name">Hail event</p>
                        <p class="past-event text-left">
                            <span>{{ days_before_value }}</span> days <span>before</span> the event
                        </p>
                    </div>

                    <div id="days_before" class="days_before_slider"></div>

                    <input v-model="days_before_value"
                           class="slider"
                           id="beforeUpdate"
                           type="range"
                           min="0"
                           max="8"
                           value="8"
                           step="1"
                    />
                    <div class="col-md-10 col-md-offset-1 ">
                        <div class="select-notify-option m-t-20">
                            <h1>Notify me via:</h1>
                            <ul class="nav nav-pills notify-via">
                                <li class="active"><a data-toggle="pill" name="ngroup" href="#text" v-model="notifyOption" class="blue-border btn-link btn-tranparent btns-blue">Text</a></li>
                                <li><a data-toggle="pill" name="ngroup" href="#email" v-model="notifyOption" class="blue-border btn-link btn-tranparent btns-blue">Email</a></li>
                                <li><a data-toggle="pill" name="ngroup" href="#both" v-model="notifyOption" class="blue-border btn-link btn-tranparent btns-blue">Both</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="text" class="tab-pane fade in active">
                                <div class="form-group">
                                    <label for="phn">Phone Number</label>
                                    <input type="text" class="form-control input-lg" id="phone" placeholder="1 (xxx) xxx-xxx" v-model="phone">
                                </div>
                            </div>
                            <div id="email" class="tab-pane fade">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control input-lg" id="email" placeholder="" v-model="email">
                                </div>
                            </div>
                            <div id="both" class="tab-pane fade">
                                <div class="form-group">
                                    <label for="phn">Phone Number</label>
                                    <input type="text" class="form-control input-lg" id="phone" placeholder="1 (xxx) xxx-xxx" v-model="phone">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control input-lg" id="email" placeholder="" v-model="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group back-next">
                        <div class="col-md-12 m-t-100">
                            <a class="blue-border btn-link btn-tranparent btns-blue" href="/">Back</a>
                            <button type="button" class="btns btns-green pull-right"  @click="submit()">
                                <span v-if="!busy">Next</span>
                                <span v-else>Please wait...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3, STATUS_IMPORTING = 4;
    import rangesliderJs from 'rangeslider-js'

    export default {
        data () {
            return {
                days_before_value: 8,
                busy: false,
                notifyOption: 'both',
                phone: null,
                email:null,
                phoneBusy: false,
                error: '',
                current_status: null,
                current_phone_status: null,
                message: '',
            };
        },
        mounted () {
            rangesliderJs.create(document.getElementById('days_before_slider'))

            if (Spark.state.user.phone != null || Spark.state.user.phone != ''){
                this.phone = Spark.state.user.phone
            }
            if (Spark.state.user.email != null || Spark.state.user.email != ''){
                this.email = Spark.state.user.email
            }
        },
        computed: {

        },
        watch: {

        },
        methods: {
            submit () {
                this.busy = true;
                const formData = {
                    user_id: Spark.state.user.id,
                    team_id: Spark.state.user.current_team_id,
                    days_before_event: this.days_before_value,
                    notifyOption: this.notifyOption,
                    phone: this.phone,
                    email: this.email,
                }
                axios.post('/onboard/notify_settings', formData)
                    .then(response => {
                        this.message = response
                        this.busy = false
                        this.current_status = STATUS_SUCCESS
                    })
                    .catch(err =>{
                        this.current_status = STATUS_FAILED
                        this.error = err
                    });
                window.location.href = '/onboard/payment_profile'
            },
        },
    };
</script>