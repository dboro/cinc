export default {
  data() {
    return {
      options: {},
      query: {
        sorts: [],
        paginate: {
          page: 1,
          limit: 50,
        }
      }
    }
  },
  watch: {
    options: {
      handler () {
        const { sortBy, sortDesc, page, itemsPerPage } = this.options
        this.query.sorts = []
        for (let i in sortBy) {
          if (sortDesc[i]) {
            this.query.sorts.push('-' + sortBy[i])
          }
          else {
            this.query.sorts.push(sortBy[i])
          }
        }
        console.log(this.query.sorts.join(','));
        this.load()
      },
      deep: true,
    },
  },
}
