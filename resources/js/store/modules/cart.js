const state = () => ({
    items: [],
    totalPrice: 0,
    isLoading: false
})

const getters = {
    cartProducts(state) {
        return state.items;
    },
    checkoutStatus(state) {
        return state.checkoutStatus;
    },
    getTotal(state) {
        return state.totalPrice
    }
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
        
        commit('updateTotal')
    },
    removeProductFromCart({ state, commit }, product) {
        commit('popProductFromCart', {product})
    },
    checkout({ state, commit, dispatch }) {
        if (state.items.length < 1) {
            return;
        }
        commit('setLoading', true);
        const products = state.items.map(item => ({id: item.id, quantity: item.quantity}));
        axios.post('/api/orders', {products, total: state.totalPrice}).then(response => {
            dispatch('messages/createMessage', {content: 'Your order has been created', type: 'success'}, {root:true})
            commit('emptyCart');
            commit('setLoading', false);
        }).catch(response => {
            dispatch('messages/createMessage', {content: 'An error has occurred. Please try again later.', type: 'error'}, {root:true})
            commit('setLoading', false);
        })
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
    
    setLoading(state, status) {
        state.isLoading = status;
    },

    emptyCart(state) {
        state.items = [];
        state.totalPrice = 0;
    },

    updateTotal(state) {
        state.totalPrice = state.items.reduce((total, item) => total + item.price * item.quantity, 0);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}