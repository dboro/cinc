export const strict = false

export const state = () => ({
    layout: 'default'
  }
)

export const mutations = {
  setData(state, {key, data}) {
    state[key] = data
  }
}
