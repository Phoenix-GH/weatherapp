<script>
    Vue.component('property', {
        props: ['property'],
        data() {
            return {
                events: this.property.events
            }
        },
        mounted() {
            axios.get('/property/'+this.property.id+'/weatherevents').then(response =>
                this.events = this.events.concat(Object.values(response.data)));
        }
    });
</script>