<template>
    <div class="row">
        <div class="col-md-5 login-page forgot-password">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="login-heading">
                            Thank You
                        </div>
                    
                        <!-- E-Mail Address -->
                        <div class="form-group">
                            <label class="col-md-8 col-md-offset-2 control-label">If weatherCheck account exists for {{ email_title }}, an e-mail will be sent with further  instructions, You may need to check your soam folder  or unblock no-reply@weathercheck.co </label>
                        </div>

                        <!-- Send Password Reset Link Button -->
                        <div class="form-group login-button">
                            <div class="col-md-5 float-unset">
                                <button type="button" @click="add()" class="btns forgot-thank btn-green">Back to Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>
<script>

    export default {
        
        mounted () {
            console.log('reset Password component loaded')
        },
        computed: {

        },
        watch: {

        },
        methods: {
            add () {

                this.busy = true;

                setTimeout(() => {
                    // this.busy = false;
                    window.location.href = '/login';
                }, 2000);
            },
        },
    };
</script>