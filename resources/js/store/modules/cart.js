const state = () => ({
    items: [],
})

const getters = {
    cartProducts: (state) => {
        return state.items;
    },
}

const actions = {
    addProductToCart({ state, commit }, product) {
        if (product.quantity < 1) {
            return;
        }
        const cartItem = state.items.find(item => item.id === product.id)
        if (!cartItem) {
            commit('pushProductToCart', {product})
        } else {
            commit('incrementItemQuantity', {product})
        }
    },
    removeProductFromCart({ state, commit }, product) {
        commit('popProductFromCart', {product})
    }
}

const mutations = {
    pushProductToCart(state, { product }) {
        state.items.push(product)
    },

    incrementItemQuantity(state, { product }) {
        const cartItem = state.items.find(item => item.id === product.id);
        cartItem.quantity += product.quantity;
    },

    popProductFromCart(state, { product }) {
        const cartItemIndex = state.items.findIndex(item => item.id === product.id);
        state.items.splice(cartItemIndex, 1);
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}