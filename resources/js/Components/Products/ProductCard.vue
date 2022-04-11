<template>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img :src="product.image" class="w-full" height="200" width="300">
        <div class="flex flex-col p-4">
            <div class="flex justify-between">
                <h2 class="text-lg pb-2 text-slate-800 font-semibold">{{product.name}}</h2>
                <span class="font-bold text-slate-600">
                    {{product.price/100}}$
                </span>
            </div>
            <button class="bg-violet-500 rounded-lg py-3 text-white font-bold" @click="openProductDetails">
                Details
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product'],

        methods: { 
            openProductDetails() {
                axios.get(`/api/products/${this.product.id}`)
                    .then(response => this.$emit('openDetails', response.data))
            }
        }
    }
</script>