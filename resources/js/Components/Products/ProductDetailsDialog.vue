<template>
    <Dialog :open="product? true : false" @close="close" class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <DialogOverlay class="fixed inset-0 bg-black opacity-30" @click="close"/>

            <div class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <div class="flex justify-between items-center">
                    <DialogTitle as="h3" class="text-lg font-medium leading-6 text-slate-900">
                        {{product.name}}
                    </DialogTitle>
                    <button class="text-slate-400 border rounded-full p-1 hover:bg-violet-50" @click="close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <hr class="mt-2">

                <div class="mt-2">
                    <div class="flex justify-center">
                        <img :src="product.image" height="200" width="300" class="mb-5 rounded-lg"/>
                    </div>
                    <p class="text-sm text-slate-700" v-html="product.description"></p>
                </div>

                <hr class="mt-5">
                <div class="flex justify-between items-center mt-4">
                    <label class="text-slate-500">
                        Quantity: 
                        <input type="number" class="text-slate-600 border border-slate-300 px-2 py-1 rounded-lg w-1/2" v-model="quantity">
                    </label>

                    <button
                        class="px-4 py-2 text-sm font-medium text-white bg-violet-500 rounded-md hover:bg-violet-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-violet-200"
                        @click="addToCart"
                    >
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
    </Dialog>
</template>

<script>
    import {
        Dialog,
        DialogOverlay,
        DialogTitle,
        DialogDescription,
    } from '@headlessui/vue'

    export default {
        components: {
            Dialog,
            DialogOverlay,
            DialogTitle,
            DialogDescription,
        },
        
        props: ['product'],
        
        data() {
            return {
                quantity: 1,
            }
        },

        methods: { 
            close() {
                this.$emit('close');
            },
            addToCart() {
                this.$emit('addToCart', {
                    ...this.product,
                    quantity: this.quantity,
                });
                this.quantity = 1;
                this.close();
            }
        }
    }
</script>