<template>
    <div class="weather-table">
        <h4 class="border-bottom">Weather Alerts  + Events :3 Unread</h4>
        <div class="scroll-list">
            <table class="table" cellpadding="3" cellspacing="3">
                <thead>
                <tr>
                    <th></th>
                    <th>Weather</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Property Affected</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="img-thumb">
                        <img :src="require('../../../../../public/images/hail.png')" class="img-responsive center-block"/>
                    </td>
                    <td>
                        .5 in hail: Affected
                    </td>
                    <td>
                        05/12/17
                    </td>
                    <td>
                       12:14 pm
                    </td>
                    <td>
                        Carmel Center Apart...
                    </td>
                </tr>
                 <tr>
                    <td class="img-thumb">
                        <img :src="require('../../../../../public/images/hail.png')" class="img-responsive center-block"/>
                    </td>
                    <td>
                        .5 in hail: Affected
                    </td>
                    <td>
                        05/12/17
                    </td>
                    <td>
                       12:14 pm
                    </td>
                    <td>
                        Carmel Center Apart...
                    </td>
                </tr>
                 <tr>
                    <td class="img-thumb">
                        <img :src="require('../../../../../public/images/hail.png')" class="img-responsive center-block"/>
                    </td>
                    <td>
                        .5 in hail: Affected
                    </td>
                    <td>
                        05/12/17
                    </td>
                    <td>
                       12:14 pm
                    </td>
                    <td>
                        Carmel Center Apart...
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
        data() {
            return {
            }
        },
        created(){

        },
        mounted() {

        },
        methods: {

        }
    }
</script>