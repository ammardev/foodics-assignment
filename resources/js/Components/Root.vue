<template>
    <header class="bg-violet-500 px-10 py-5 text-white text-xl font-bold tracking-wider shadow-md">
        Foodics Assignment
    </header>
    
    <main class="flex flex-grow gap-6 px-10 pt-14">
        <aside class="flex flex-col w-1/4">
            <div class="w-full bg-violet-500 text-white text-lg font-bold tracking-wide px-3 py-2 rounded-lg">
                Your Order Items
            </div>
            <div class="flex flex-col gap-4 flex-grow border-2 border-dashed border-t-0 border-slate-400 rounded-b-lg p-3">
                <div v-for="i in 3" :key="i" class="flex items-center bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.deliveryhero.io/image/talabat/MenuItems/blob_637430330387395346" class="w-1/3" height="100" width="200">
                    <div class="w-2/3 px-4 py-2">
                        Product Name
                        <div class="flex gap-2 pt-2">
                            <input type="number" class="text-slate-600 border border-slate-300 px-2 py-1 rounded-lg w-3/4" value="1">
                            <button class="bg-red-400 rounded-lg px-2 text-xs tracking-wide font-bold text-white uppercase">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="bg-violet-500 rounded-lg py-3 text-white font-bold mt-3">
                Checkout
            </button>
        </aside>
        <div class="w-3/4">
            <div class="grid grid-cols-4 gap-5">
                <product-card v-for="product in products" :key="product.id" :product="product"/>
            </div>
            <div class="mt-3">
                paginator
            </div>
        </div>
        
    </main>
    
    <footer class="py-5 text-center text-slate-500">
        Developed By <a href="mailto:me@ammar.dev" class="text-violet-500 font-semibold">Ammar Al-Khawaldeh</a>
    </footer>
</template>

<script>
    import ProductCard from './ProductCard.vue'

    export default {
        components: { ProductCard },

        data() {
            return {
                products: []
            }
        },
    }
</script>
