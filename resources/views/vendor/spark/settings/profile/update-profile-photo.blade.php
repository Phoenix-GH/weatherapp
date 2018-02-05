<div class="sidebar-content profileContact">
    <spark-update-profile-photo :user="user" inline-template>
        <div>
            <div class="panel panel-default" v-if="user">

                <div class="panel-body">

                    <form class="form-horizontal profile-photo" role="form">
                        <!-- Photo Preview-->
                        <div class="form-group">
                            <div class="col-md-6">
                                <span role="img" class="profile-photo-preview"
                                :style="previewStyle">
                            </span>
                            <a class="chang-pic" data-toggle="modal" data-target="#uploadModal">
                                <i class="fa fa-fw fa-btn fa-edit"></i>
                                Change Picture
                            </a>
                        </div>
                    </div>

                    <div id="uploadModal" class="modal myModals fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="modal-body">
                                    <h4>Change Profile Photo</h4>
                                    <div class="alert alert-danger" v-if="form.errors.has('photo')">
                                        @{{ form.errors.get('photo') }}
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6 image-sec">
                                        <span role="img" class="profile-photo-preview"
                                :style="previewStyle"></span>
                                    </div>
                                    <div class="col-md-6 button-sec">
                                        <div class="blk">
                                            <label type="button" class="blue-border pull-left btn-link btn-tranparent btns-blue btn-upload" :disabled="form.busy">Upload Photo
                                            <input ref="photo" type="file" class="form-control" name="photo" @change="update">
                                            </label>
                                        </div>
                                        <div class="blk">
                                            <a class="delete-photo" href="#">Delete Photo</a>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</spark-update-profile-photo>
<spark-update-contact-information :user="user" inline-template>
    <div class="panel panel-default">

        <div class="panel-body">
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                Your contact information has been updated!
            </div>

            <h4>Individual Profile</h4>
            <form class="form-horizontal" role="form">
                <!-- Name -->
                <div class="form-group" :class="{'has-error': form.errors.has('name')}">
                    <label class="col-md-2 control-label">Name</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" v-model="form.name">

                        <span class="help-block" v-show="form.errors.has('name')">
                            @{{ form.errors.get('name') }}
                        </span>
                    </div>
                </div>

                <!-- E-Mail Address -->
                <div class="form-group" :class="{'has-error': form.errors.has('email')}">
                    <label class="col-md-2 control-label">Email</label>

                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" v-model="form.email">

                        <span class="help-block" v-show="form.errors.has('email')">
                            @{{ form.errors.get('email') }}
                        </span>
                    </div>
                </div>

                <!-- Account Type -->
                <div class="form-group" :class="">
                    <label class="col-md-2 control-label">Account Type</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" name="account-type">

                        <span class="help-block" v-show="">
                            @{{ form.errors.get('account-type') }}
                        </span>
                    </div>
                </div>

                <!-- Company Name -->
                <div class="form-group" :class="">
                    <label class="col-md-2 control-label">Company Name</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" name="company-name" >

                        <span class="help-block" v-show="">
                            @{{ form.errors.get('company-name') }}
                        </span>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="form-group" :class="{'has-error': form.errors.has('phone')}">
                    <label class="col-md-2 control-label">Phone Number</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" name="phone" v-model="form.phone">

                        <span class="help-block" v-show="form.errors.has('phone')">
                            @{{ form.errors.get('phone') }}
                        </span>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group" :class="{'has-error': form.errors.has('phone')}">
                    <label class="col-md-2 control-label">Password</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" name="password"  value="**********">

                        <span class="help-block" v-show="form.errors.has('password')">
                            @{{ form.errors.get('password') }}
                        </span>
                    </div>
                </div>


                <!-- Update Button -->
                <div class="form-group login-button">
                    <div class="float-unset">
                        <button type="submit" class="btn btn-green"@click.prevent="EditProfile"
                        :disabled="form.busy">
                        Edit Information
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-update-contact-information>
</div>
