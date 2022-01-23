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
  getAll(context, {page, limit, sorts, success, end}) {

    this.$axios.$get('api/admin/accounts' + query.setParams({
      fields: {accounts: ['id', 'name', 'slug', 'product_id'], product:  ['name', 'id']},
      includes: ['product'],
      sorts: sorts,
      page: page,
      limit: limit
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

    this.$axios.$get(`api/admin/accounts/${id}`)
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

    this.$axios.$put(`api/admin/accounts/${data.id}`, data)
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

    this.$axios.$post(`api/admin/accounts`, data)
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
    this.$axios.$delete(`api/admin/accounts/${id}`)
      .then(response => {
        success()
      })
      .finally(() => {

      })
  },

  getCount(context, {success}) {
    this.$axios.$get('api/admin/accounts/count')
      .then(response => {
        success(response.data)
      })
  }
}
