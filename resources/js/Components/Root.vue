<template>
    <header class="bg-violet-500 px-10 py-5 text-white text-xl font-bold tracking-wider shadow-md">
        Foodics Assignment
    </header>
    
    <main class="flex flex-grow gap-6 px-10 pt-14">
        <cart/>
        <div class="w-3/4">
            <div class="grid grid-cols-4 gap-5">
                <product-card v-for="product in products" :key="product.id" :product="product" @openDetails="activeProductInDialog = $event"/>
            </div>
            <div class="mt-3">
                paginator
            </div>
        </div>
    </main>
    
    <product-details-dialog :product="activeProductInDialog" @close="activeProductInDialog = null"/>
    
    <footer class="py-5 text-center text-slate-500">
        Developed By <a href="mailto:me@ammar.dev" class="text-violet-500 font-semibold">Ammar Al-Khawaldeh</a>
    </footer>
</template>

<script>
    import ProductCard from './Products/ProductCard.vue'
    import Cart from './Cart.vue'
    import ProductDetailsDialog from './Products/ProductDetailsDialog.vue'

    export default {
        components: { ProductCard, Cart, ProductDetailsDialog },

        data() {
            return {
                products: [],
                activeProductInDialog: null,
            }
        },

        created() {
            axios.get('/api/products').then(response => this.products = response.data.data)
        },
    }
</script>
