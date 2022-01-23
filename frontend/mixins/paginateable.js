export default {
  data() {
    return {
      paginate: {
        limit: 50,
        page: 1,
      },
      count: null,
      getCountAction: ''
    }
  },
  watch: {
    paginate() {
      this.load()
    }
  },
  computed: {
    isPaginate() {
      return this.count && this.count > this.paginate.limit
    }
  },
  methods: {
    getCount() {
      this.$store.dispatch(this.getCountAction, {
        success: (count) => this.count = count
      })
    }
  },
  mounted() {
    this.getCount()
  }
}
