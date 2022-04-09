<template>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img :src="product.image" class="w-full" height="200" width="300">
        <div class="flex flex-col p-4">
            <h2 class="text-lg pb-2 text-slate-800 font-semibold">{{product.name}}</h2>
            <button class="bg-violet-500 rounded-lg py-3 text-white font-bold">
                Add to cart
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product']
    }
</script>