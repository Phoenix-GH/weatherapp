<template>
  <div class="bg-clouds">
        <section class="module-progress-bar">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 16%;">
                    <span class="sr-only">16% Complete</span>
                </div>
            </div>
        </section>
        <section class="module-onboarding container">
        <div class="onboarding">
          <h1 class="text-center">Start monitoring your properties</h1>
          <div class="form-wrapper">
            <form>
                <label for="email">Email</label>
                <input type="text" placeholder="Email" name="email" id="email" v-model="registerForm.email">
                <label for="name">Name</label>
                <input type="text" placeholder="Name" name="name" id="name" v-model="registerForm.name">
                <label for="company">Company</label>
                <input type="text" placeholder="Company" name="company" id="company"
                       v-model="registerForm.company">
                <label for="phone">Phone</label>
                <input type="text" placeholder="Phone" name="phone" id="phone"
                       v-model="registerForm.phone">
                <label for="name">I am...</label>
                <div>
                    <select name="gender" v-model="registerForm.account_type">
                        <option>Please select...</option>
                        <option value="reit">REIT</option>
                        <option value="property_manager">Property Manager</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" id="password"
                       v-model="registerForm.password">

                <label for="confirm-password">Confirm Password</label>
                <input type="password" placeholder="Confirm Password" name="password_confirmation"
                       id="password_confirmation" v-model="registerForm.password_confirmation">

                <div class="checkbox">
                    <input type="checkbox" v-model="acceptFirstTerms" id="firstTerms" />
                    <label for="firstTerms" class="checkbox">
                        <span> I accept the <a target="_blank" href="/content/terms_part_one">terms and conditions</a></span>
                    </label>
                </div>
                <span class="help-block error-terms" style="color: red; display: none;">
                    You must accept the terms and conditions to continue.
                </span>
                <input class="btn" type="submit" name="submit" value="Create Account"
                       @click.prevent="validate">
            </form>
          </div>
        </div>
        <b-modal ref="myModalRef" class="modal fade" role="dialog" id="confirmModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Monitoring Notice</h4>
              </div>
              <div class="modal-body">
                <p class="text-center">
                  <h3>Effective as of November 13, 2017</h3>
                  <h2>INSTALLATION OF SENSORY EQUIPMENT</h2>
                  <ol type="l">
                      <li>
                          We may need access to the physical premises of the property address you provided to the Company Website (the “Premises”).
                      </li>
                      <li>
                          If such access is needed and we have secured your agreement with such need on a specific portion of the Company WebSite, you hereby grant us a non- exclusive license to an install and affix sensory equipment (the “Equipment”) to the Premises, together with the right to Company, its successors, assigns, contractors, and agents, to construct, install, operate, maintain, inspect, repair, renew, remove, and relocate the Equipment and to doing anything necessary or useful or convenient in connection with the foregoing
                      </li>
                      <li>
                          If you don’t own the Premises, you are solely responsible for securing the required permission for installation to take place on the Premises as outlined above. You may be asked to provide written evidence that you have requested and been afforded all necessary permissions to complete the installation and you should be prepared to present said evidence at any time.
                      </li>
                      <li>
                          We will make every effort to install the Equipment consistent with the aesthetics and construction of the Premises
                      </li>
                      <li>
                          The Equipment will at all times remain the personal property of Company, its successors or assigns, and may be removed by Company upon the termination of this TOS.
                      </li>
                  </ol>
                </p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn" @click="sendRegistration">Accept</button>
              </div>
            </div>
          </div>
        </b-modal>
      </section>
    </div>
</template>

<script>
export default {
  data () {
    return {
      showTermsModal: false,
      acceptFirstTerms: false,
      registerForm: {
        stripe_token: '',
        name: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: '',
        country: 'US',
        terms: false,
        coupon: null,
        invitation: null
      }
    }
  },
  mounted () {
    console.log('register component loaded')
  },
  computed: {},
  watch: {},
  methods: {
    validate () {
      if (this.acceptFirstTerms) {
      //   Spark
      //       .post('/onboard/user/validate', this.registerForm)
      //       .then(response => {
      //           $('.error-text').remove();
        this.$refs.myModalRef.show()
      //       })
      //       .catch(error => {
      //           var fields = Object.keys(error.errors);
      //           $('.error-text').remove();
      //           fields.forEach(field => {
      //             var errors = error.errors[field];
      //             var $errorText = $('<span />', {
      //                 'class': 'help-block error-text',
      //                 style: 'color: red;'
      //             });
      //             var errorHtml = '';
      //             errors.forEach(error => {
      //                 errorHtml += error + '<br>';
      //             });
      //             $errorText.html(errorHtml);
      //             $errorText.insertAfter($('[name="'+field+'"]'));
      //           });
      //       });
      // } else {
      //   $('.error-terms').show();
      //   $('#firstTerms').on('change', event => {
      //       $('.error-terms').toggle(!$(this).prop('checked'));
      //   });
      }
    },
    sendRegistration () {
      if (this.acceptFirstTerms) {
      //   Spark.post('/onboard/user/create', this.registerForm)
      //     .then(response => {
      //         window.location.replace('/onboard/import');
      //     });
      }
    }
  }
}
</script>
