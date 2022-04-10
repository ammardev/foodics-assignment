const state = () => ({
    content: null,
    type: null
})

const getters = {
    getMessage(state) {
        return state;
    }
}

const actions = {
    createMessage({ state, commit }, {content, type}) {
        commit('setMessage', { content, type });
    }
}

const mutations = {
    setMessage(state, {content, type}) {
        state.content = content;
        state.type = type;
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}