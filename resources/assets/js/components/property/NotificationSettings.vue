<template>
    <form>
        <h4 class="border-bottom"> Notification Settings </h4>
        <img :src="require('../../../../../public/images/hail.png')" class="img-responsive center-block"/>
        <h5><span>{{ beforeUpdateNumber }}</span> days <span>before</span> a possible hail event</h5>
        <div class="form-group">
            <input v-model="beforeUpdateNumber" @change="beforeUpdate"
                   class="slider"
                   id="beforeUpdate"
                   type="range"
                   min="0"
                   max="8"
                   value="1"
                   step="1" number>
        </div>
    </form>
</template>

<script>
    import rangesliderJs from 'rangeslider-js'

    export default {
        data() {
            return {
                beforeUpdateNumber: 0,
            }
        },
        created(){
            axios.get('/notification-settings/before')
                .then(response => this.beforeUpdateNumber = response.data)
        },
        mounted() {
            rangesliderJs.create(document.getElementById('slider'))
        },
        methods: {
            beforeUpdate: function () {
                axios.post('/notification-settings/before/update', {
                    body: this.beforeUpdateNumber
                })
            }
        }
    }
</script>
