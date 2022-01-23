export const state = () => ({
  user: {},
  errors: {}
})

export const mutations = {
  setUser(state, data) {
    state.user = data
  },
  setData(state, {key, data}) {
    state[key] = data
  }
}

export const actions = {
  login(context, data) {
    this.$axios.post('auth/login', data)
      .then(response => {
        this.$router.push('/')
      })
      .catch(error => {
        if (error.response.status === 422) {
          context.commit('setData', {key: 'errors', data: error.response.data.errors})
        }
      })
  },
  logout(context, data) {
    this.$axios.post('auth/logout')
      .then(response => {
          this.$router.push({name: 'auth-login'})
      })
  },
  getUser(context) {
    this.$axios.$get('api/user')
      .then(response => context.commit('setUser', response))
  },
}
