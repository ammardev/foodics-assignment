<template>
    <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden">
        <img :src="product.image" class="w-1/3" height="100" width="200">
        <div class="w-2/3 px-4 py-1">
            {{product.name}}
            <div class="flex gap-2 pt-1">
                <input type="number" class="text-slate-600 border border-slate-300 px-2 py-1 rounded-lg w-3/4" :value="product.quantity">
                <button class="bg-red-400 rounded-lg px-2 text-xs tracking-wide font-bold text-white uppercase">Remove</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product'],
    }
</script>
