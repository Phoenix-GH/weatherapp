<template>
    <div class="table-responsive">
        <div class="col-md-6 col-sm-6 col-xs-12 text-left">
            <p>Properties: {{ properties.length }}</p>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 text-right">
            <a href="/dashboard/map">View as map</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width:4%">
                        <input type="checkbox" class="no-margin">
                    </th>
                      <th style="width:10%">Address</th>
                      <th style="width:10%">City</th>
                      <th style="width:10%">State</th>
                      <th style="width:10%">Zip code</th>
                      <th style="width:10%">Status</th>
                </tr>
            </thead>
            <tbody>
               <tr v-for="property in properties">
                    <td>
                        <input type="checkbox" class="no-margin">
                    </td>
                    <td>
                        <a v-bind:href="'/property/single/'+ property.id"  class=''>{{ property.address }}</a>
                    </td>
                    <td>
                        {{ property.city }}
                    </td>
                    <td>
                        {{ property.state }}
                    </td>
                   <td>
                       {{ property.zip }}
                   </td>
                    <td>
                        OK
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
            <a href="/dashboard/list" class="">View all properties</a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                properties: [],
            }
        },
        created(){

        },
        mounted() {
            axios.get('/property_search')
            .then(response => this.properties = response.data)
        },
        methods: {
            url: function(id) {
                console.log(id);
                return 'item ' + id.text;
            },
        }
    }
</script>