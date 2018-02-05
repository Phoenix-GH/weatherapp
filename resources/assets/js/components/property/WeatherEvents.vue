<template>
    <div class="weather-table">
        <h4 class="border-bottom">Weather Events</h4>
        <div class="scroll-list">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="event in events">
                    <td>
                        <img :src="require('../../../../../public/images/hail.png')" class="img-responsive center-block"/>
                    </td>
                    <td>
                        {{ event.desc }}
                    </td>
                    <td>
                        {{ event.date }}
                    </td>
                    <td>
                        {{ event.type }}
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="panel-footer">
                <a href="#">View all alerts</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['property'],
        data() {
            return {
                events: this.property.events
            }
        },
        created(){

        },
        mounted() {
            axios.get('/property/'+this.property.id+'/weather-events').then(response =>
                this.events = this.events.concat(Object.values(response.data)));
        },
        methods: {

        }
    }
</script>