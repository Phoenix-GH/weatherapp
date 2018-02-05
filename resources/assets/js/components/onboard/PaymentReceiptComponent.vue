<template>
    <div class="row">
        <div class="bg-clouds">
            <section class="module-progress-bar">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <span class="sr-only">100% Complete</span>
                    </div>
                </div>
            </section>
            <section class="module-onboarding container">
                <div class="onboarding">
                    <h1 class="onboarding-title text-center">Thank you for your payment</h1>
                    <p>You can now continue using WeatherCheck. You’ll receive a confirmation email shortly</p>

                    <div class="text-center">
                        <button type="submit" class="btn-block btns-green" @click="sendDashboard">Dashboard</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['user'],
        data() {
            return {
            };
        },
        mounted() {
            console.log('Payment receipt Component mounted.', this.user)

            axios.get('/onboard/get_invoices')
                .then(response => {
                    console.log(response)
                })
                .catch(err => {
                    console.log(err)
                })
        },
        methods: {
            sendDashboard() {
                window.location.replace("/dashboard");
            },
        },
    };
</script>

