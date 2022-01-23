import query from "@/commons/query";

export const mutations = {
  test(state, data) {
    data.rData = data.data.map((item) => {
      item.name += '-test'
      return item
    })
    console.log(data.rData);
  }
}

export const actions = {
  getAll(context, {success, end}) {

    this.$axios.$get('api/admin/users' + query.setParams({
      fields: {users: ['id', 'name']}
    }))
      .then(response => {
        success(response.data)
      })
      .finally(() => {
        if (typeof end === "function") {
          end()
        }
      })
  },
  find(context, {id, success, end}) {

    this.$axios.$get(`api/admin/users/${id}`)
      .then(response => {
        success(response.data)
      })
      .finally(() => {
        if (typeof end === "function") {
          end()
        }
      })
  },
  update(context, {data, success, error, end}) {

    this.$axios.$put(`api/admin/users/${data.id}`, data)
      .then(response => {
        success()
      })
      .catch(data => {
        if (data.response.status === 422) {
          if (typeof error === "function") {
            error(data.response.data)
          }
        }
      })
      .finally(() => {
        if (typeof end === "function") {
          end()
        }
      })
  },
  store(context, {data, success, error, end}) {

    this.$axios.$post(`api/admin/users`, data)
      .then(response => {
        success()
      })
      .catch(data => {
        if (data.response.status === 422) {
          if (typeof error === "function") {
            error(data.response.data)
          }
        }
      })
      .finally(() => {
        if (typeof end === "function") {
          end()
        }
      })
  },
  destroy(context, {id, success}) {
    this.$axios.$delete(`api/admin/users/${id}`)
      .then(response => {
        success()
      })
      .finally(() => {

      })
  }
}
