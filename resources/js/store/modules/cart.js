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
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}