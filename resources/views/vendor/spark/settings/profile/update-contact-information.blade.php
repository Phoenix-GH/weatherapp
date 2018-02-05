<spark-update-contact-information :user="user" inline-template>
    <div class="panel panel-default col-md-8 sidebar-content contactFormEdit" style="display: none;">
        <h4 class="edit-heading">Edit Individual Profile Information</h4>

        <div class="panel-body">
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                Your contact information has been updated!
            </div>

            <form class="edit-profile" role="form">

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" v-model="form.name">
                    <span class="help-block" v-show="form.errors.has('name')">
                        @{{ form.errors.get('name') }}
                    </span>
                </div>

                <!-- E-Mail Address -->
                <div class="form-group" :class="{'has-error': form.errors.has('email')}">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" v-model="form.email">
                    <span class="help-block" v-show="form.errors.has('email')">
                        @{{ form.errors.get('email') }}
                    </span>
                </div>

                <!-- Account Type -->
                <div class="form-group" :class="">
                    <label for="account-type">Account Type</label>
                    <input type="text" class="form-control" name="account-type">
                    <span class="help-block" v-show="">
                        @{{ form.errors.get('account-type') }}
                    </span>
                </div>

                <!-- Company Name -->
                <div class="form-group" :class="">
                    <label for="company-nameny">Company Name</label>
                    <input type="text" class="form-control" name="company-name" >
                    <span class="help-block" v-show="">
                        @{{ form.errors.get('company-name') }}
                    </span>
                </div>

                <!-- Phone Number -->
                <div class="form-group" :class="{'has-error': form.errors.has('phone')}">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" name="phone" v-model="form.phone">
                    <span class="help-block" v-show="form.errors.has('phone')">
                        @{{ form.errors.get('phone') }}
                    </span>
                </div>

                <!-- Current Password -->
                <div class="form-group" :class="{'has-error': form.errors.has('phone')}">
                    <label for="current-password">Current Password</label>
                    <input type="text" class="form-control" name="password"  value="**********">
                    <span class="help-block" v-show="form.errors.has('password')">
                        @{{ form.errors.get('password') }}
                    </span>
                </div>

                <!-- New Password -->
                <div class="form-group" :class="{'has-error': form.errors.has('phone')}">
                    <label for="new-password">New Password</label>
                    <input type="text" class="form-control" name="password"  value="**********">
                    <span class="help-block" v-show="form.errors.has('password')">
                        @{{ form.errors.get('password') }}
                    </span>
                </div>

                <!-- Confirm Password -->
                <div class="form-group" :class="{'has-error': form.errors.has('phone')}">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="text" class="form-control" name="password"  value="**********">
                    <span class="help-block" v-show="form.errors.has('password')">
                        @{{ form.errors.get('password') }}
                    </span>
                </div>

                <!-- Back & Submit -->
                <div class="form-group login-button">
                    <div class="float-unset">
                        <a class="blue-border pull-left btn-link btn-tranparent btns-blue" href="#"  @click.prevent="backProfile">Back</a>
                        <button type="submit" class="btn pull-right btn-green"@click.prevent="update"
                        :disabled="form.busy">
                        Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-update-contact-information>
