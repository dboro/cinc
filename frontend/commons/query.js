export default {
  setParams: (params = {
    fields: {},
    includes: [],
    sorts: [],
    page: null,
    limit: null
  }) => {

    let query = ''

    if (typeof params.includes === 'object' && params.includes.length > 0) {
      query += query.length == 0 ? '?' : '&'
      query += `include=` + params.includes.join(',')
    }

    if (typeof params.fields === 'object') {
      for (let i in params.fields) {
        query += query.length == 0 ? '?' : '&'
        query += `fields[${i}]=` + params.fields[i].join(',')
      }
    }

    if (typeof params.sorts === 'object' && params.sorts.length > 0) {
      query += query.length == 0 ? '?' : '&'
      query += `sort=` + params.sorts.join(',')
    }

    if (typeof params.page === 'number') {
      query += query.length == 0 ? '?' : '&'
      query += `page=${params.page}`
    }

    if (typeof params.limit === 'number') {
      query += query.length == 0 ? '?' : '&'
      query += `limit=${params.limit}`
    }

    return query
  }
}
