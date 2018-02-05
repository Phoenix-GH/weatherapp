<template>
    <div class="bg-clouds">
        <section class="module-progress-bar">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;">
                    <span class="sr-only">33% Complete</span>
                </div>
            </div>
        </section>
        <section class="module-onboarding container">
            <div class="onboarding wrapper">
                <h1 class="text-center">Import your properties</h1>

                <div class="coming-soon">
                    <h4 class="text-center">Coming Soon: Upload properties via your
                        property management software!</h4>

                    <div class="clearfix">
                        <div class="software software-rentpost">
                            <img class="img-responsive" src="/images/rentpost.png" alt="">
                        </div>
                        <div class="software software-resman">
                            <img class="img-responsive" src="/images/resman.png" alt="">
                        </div>
                        <div class="software software-yardi">
                            <img class="img-responsive" src="/images/yardi.png" alt="">
                        </div>
                        <div class="software software-rentmanager">
                            <img class="img-responsive" src="/images/rentmanager.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="row text-center upload-header">
                    <h4 >Upload your properties via csv.</h4>
                    <a href="/template.csv" download>Download the template here.</a>
                </div>

                <div class="dropbox m-b-75">
                    <vue-dropzone ref="fileUploadZone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
                </div>

                <button name="Upload Properties" value="Upload Properties" id="uploadBtnCsv" class="uploadBtn" @click="sendProperties">Upload Properties</button>

                <a href="/onboard/manual_property_import" class="entries">Enter your properties manually</a>
            </div>

        </section>
    </div>
</template>
<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.css'
    const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3, STATUS_IMPORTING = 4;

    export default {
        props: ['user', 'currentTeam'],

        data () {
            return {
                dropzoneOptions: {
                    url: '/onboard/property_csv_upload',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    addRemoveLinks: true,
                    uploadMultiple: false,
                    acceptedFiles: '.csv',
                    autoProcessQueue : false,
                    dictDefaultMessage: 'Drag files here or click to browse. \n' +
                    '50MB max file size. All files must be .CSV'
                }
            };
        },
        components: {
            vueDropzone: vue2Dropzone
        },
        mounted () {
            this.reset()
        },
        methods: {
            reset(){
                this.current_status = null
                this.file_to_upload = null
                this.upload_error = null
            },
            sendProperties () {
                this.$refs.fileUploadZone.dropzone.processQueue();
                window.location.replace("/onboard/importing_properties");
            },
        },
    };
</script>
<style>
    .dropzone {
        outline: 2px dashed lightblue; /* the dash box */
        outline-offset: -10px;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px; /* minimum height */
        position: relative;
        cursor: pointer;
        background-repeat: no-repeat;
        background-image: url(/images/upload.png);
        background-position: center;
        border: 0px solid rgba(0, 0, 0, 0.3);
    }

    .input-file {
        opacity: 0; /* invisible but it's there! */
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }

    .dropzone .dz-message {
        text-align: center;
        margin: 10em 0 5em;
    }

    .dropbox:hover {
        background: lightblue; /* when mouse over to the drop zone, change color */
    }

    .dropbox p {
        font-size: 1.2em;
        text-align: center;
        padding: 70px 0 0;
    }

    .coming-soon {
        background: #f5f6fA;
        width: 419px;
        padding: 25px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 35px;
    }

    .upload-form {
        position: relative;
        margin-bottom: 60px;
    }

    .fs_icon {
        position: absolute;
        top: 35px;
        left: 50%;
        transform: translateX(-50%);
    }

    .software {
        float: left;
    }

    .software:not(:last-child) {
        margin-right: 24px;
        margin-top: 10px;
    }

    .software-rentpost {
        width: 59px;
    }

    .software-resman {
        width: 56px;
    }

    .software-yardi {
        width: 73px;
    }

    .software-rentmanager {
        width: 108px;
    }

    .upload-header {
        margin-bottom: 35px;
    }

    .uploadBtn {
        display: block;
        margin: 0 auto 40px;
        text-transform: uppercase;
        color: #fff;
        background: #8ec549;
        padding: 10px 35px;
        font-weight: 400;
        letter-spacing: 2px;
        border: 0;
    }

    .entries {
        display: block;
        text-align: center;
        margin-bottom: 20px;
        font-size: 20px;
    }

    .vue-dropzone {
        transition: background-color 0.2s linear;
    }
</style>