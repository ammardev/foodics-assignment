<template>
    <div v-if="getMessage.type" class="absolute bottom-10 right-10 bg-green-500 text-white py-2 px-4 rounded-lg shadow-xl w-96" :class="colorStyle">
        {{getMessage.content}}
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: { 
            ...mapGetters('messages', [
                'getMessage'
            ]),
            colorStyle() {
                return {'bg-green-500': this.getMessage.type == 'success', 'bg-red-500': this.getMessage.type == 'error'};
            }
        }
    }
</script>
