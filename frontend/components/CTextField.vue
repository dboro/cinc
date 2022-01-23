<template>
  <v-text-field
    v-model="model"
    @input="input"
    :loading="loading"
    :error-messages="errorMessage"
    :label="label"
    :prepend-inner-icon="prependInnerIcon"
    :type="type"
    :placeholder="placeholder"
    dense
    rounded
    outlined
  >
  </v-text-field>
</template>

<script>
export default {
  name: "CTextField",
  props: {
    loading: Boolean,
    value: String,
    error: Array|String,
    label: String,
    prependInnerIcon: String,
    type: {default: 'text'},
    placeholder: String
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
