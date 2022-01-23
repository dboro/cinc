<template>
  <div class="d-inline-block">
    <v-select v-if="isLimit"
      @change="changeLimit"
      v-model="limit"
      style="width: 120px"
      class="d-inline-block"
      :items="limitItems"
      dense outlined rounded
    ></v-select>
    <v-pagination
      class="d-inline-block"
      v-model="page"
      :length="length"
      :total-visible="totalVisible"
      circle
      @input="changePage"
    ></v-pagination>
  </div>
</template>

<script>
export default {
  name: "CPaginate",
  data() {
    return {
      limit: 50,
      page: 1
    }
  },
  props: {
    value: Object,
    limitItems: {
      default: () => [25, 50, 100]
    },
    isLimit: {
      default: true
    },
    defaultLimit: Number,
    count: Number,
    totalVisible: {
      type: Number,
      default: 7
    }
  },
  watch: {
    value (val) {
      this.page = val.page
      this.limit = val.limit
    }
  },
  methods: {
    changeLimit() {
      this.page = 1
      this.$emit('input', {page: this.page, limit: this.limit})
    },
    changePage() {
      this.$emit('input', {page: this.page, limit: this.limit})
    }
  },
  computed: {
    length() {
      let length = Math.ceil(this.count / this.limit)
      return length
    }
  },
  created() {
    this.limit = this.value.limit
    this.page = this.value.page
  }
}
</script>

<style scoped>

</style>
