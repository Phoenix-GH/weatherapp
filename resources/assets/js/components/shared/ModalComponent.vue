<template>
    <div class="modal fade" role="dialog" id="confirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Monitoring Notice</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        <slot>

                        </slot>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" @click="$emit('accepted')">Accept</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            showModal: false
        }
    }
</script>