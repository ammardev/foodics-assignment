<template>
    <aside class="flex flex-col w-1/4">
        <div class="w-full bg-violet-500 text-white text-lg font-bold tracking-wide px-3 py-2 rounded-lg">
            Your Order Items
        </div>
        <div class="flex flex-col gap-4 flex-grow border-2 border-dashed border-t-0 border-slate-400 rounded-b-lg p-3">
            <cart-product-card v-for="product in cartProducts" :key="product.i" :product="product"/>
        </div>
        <button class="bg-violet-500 rounded-lg py-3 text-white font-bold mt-3" @click="checkout">
            Checkout
        </button>
    </aside>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';
    import CartProductCard from './Products/CartProductCard.vue';

    export default {
        components: {
            CartProductCard,
        },
        
        methods: {
            ...mapActions('cart', ['checkout']),
        },

        computed: {
            ...mapGetters('cart', [
                'cartProducts'
            ])
        }
    }
</script>
