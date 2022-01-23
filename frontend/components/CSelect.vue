<template>
  <v-select
    v-model="model"
    @input="input"
    :loading="loading"
    :error-messages="errorMessage"
    :label="label"
    :prepend-inner-icon="prependInnerIcon"
    :placeholder="placeholder"
    :items="items"
    :item-text="itemText"
    :item-value="itemValue"
    dense
    rounded
    outlined
  >
  </v-select>
</template>

<script>
export default {
  name: "CTextField",
  props: {
    loading: Boolean,
    value: String|Number,
    error: Array|String,
    label: String,
    prependInnerIcon: String,
    placeholder: String,
    items: Array,
    itemValue: {default: 'id'},
    itemText: {default: 'name'},
  },
  watch: {
    value(val) {
      this.model = val
    },
    error(val) {
      this.errorMessage = val
    }
  },
  data() {
    return {
      model: this.value,
      errorMessage: ''
    }
  },
  methods: {
    input() {
      this.$emit('input', this.model)
      this.errorMessage = ''
    }
  }
}
</script>

<style scoped>

</style>
