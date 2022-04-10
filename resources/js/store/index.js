import { createStore } from 'vuex'
import cart from './modules/cart'
import messages from './modules/messages'

export default createStore({
    modules: {
        cart,
        messages,
    }
})