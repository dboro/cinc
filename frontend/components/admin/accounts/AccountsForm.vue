<template>
  <div>
    <v-form @submit.prevent="submit">
      <products-select :error="errors.product_id"  v-model="item.product_id"></products-select>
      <c-text-field :label="t('Name')" :error="errors.name" :loading="loading" v-model="item.name"></c-text-field>
      <c-text-field :label="t('Slug')" :error="errors.slug" :loading="loading" v-model="item.slug"></c-text-field>
      <c-textarea :label="t('Description')" :error="errors.description" :loading="loading" v-model="item.description"></c-textarea>
      <v-row class="my-3 px-3">
        <submit-button :disabled="loading"></submit-button>
        <v-spacer></v-spacer>
        <cancel-button @click="$emit('cancel')"></cancel-button>
      </v-row>
    </v-form>
  </div>
</template>

<script>

import langs from "@/mixins/langs";
import dataComponent from "@/mixins/dataComponent";
import ProductsSelect from "@/components/admin/products/ProductsSelect";

export default {
  mixins: [langs, dataComponent],
  components: {ProductsSelect},
  name: "AccountsForm",
  props: {
    id: {
      default: false
    }
  },
  data() {
    return {
      item: {},
      errors: {},
      loading: false
    }
  },
  computed: {

  },
  methods: {
    submit() {
      this.loading = true
      if (this.item.id) {
        this.$store.dispatch('admin/accounts/update', {
          data: this.item,
          success: () => this.$emit('success'),
          error: (data) => this.errors = data.errors,
          end: () => this.loading = false
        })
      }
      else {
        this.$store.dispatch('admin/accounts/store', {
          data: this.item,
          success: () => this.$emit('success'),
          error: (data) => this.errors = data.errors,
          end: () => this.loading = false
        })
      }
    },
    load() {
      this.loading = true
      this.$store.dispatch('admin/accounts/find', {
        id: this.id,
        success: (data) => this.item = data,
        end: () => this.loading = false
      })
    }
  },
  created() {

  },
  mounted() {
    if (this.id && !this.loaded) {
      this.load()
    }
  }
}
</script>

<style scoped>

</style>
