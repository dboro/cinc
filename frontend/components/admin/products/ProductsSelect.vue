<template>
  <c-select v-model="model" @input="input" :label="label" :items="items" :error="error"></c-select>
</template>

<script>

import langs from "@/mixins/langs";
import dataComponent from "@/mixins/dataComponent";

export default {
  mixins: [langs, dataComponent],
  name: "ProductsSelect",
  props: {
    value: String|Number,
    label: {
      default: 'Product'
    },
    error: Array|String,
  },
  data() {
    return {
      model: '',
      items: []
    }
  },
  watch: {
    value(val) {
      this.model = val
    },
  },
  methods: {
    input() {
      this.$emit('input', this.model)
    },
    load() {
      this.$store.dispatch('admin/products/getForSelect', {
        success: (data) => this.items = data
      })
    }
  },
  created() {

  },
  mounted() {
    if (!this.loaded) {
      this.load()
    }
  }
}
</script>

<style scoped>

</style>
