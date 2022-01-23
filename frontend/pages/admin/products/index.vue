<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        {{ title }}
        <create-button class="ml-2" :route="{name: 'admin-products-create'}"></create-button>
        <v-spacer/>
        <archive-button :route="{name: 'admin-products-archive'}"></archive-button>
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <products-table></products-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";
import ProductsTable from "@/components/admin/products/ProductsTable";
import page from "@/mixins/page";

export default {
  name: 'products-index',
  components: {ProductsTable},
  mixins: [langs, page],
  head() {
    return {
      title: this.title,
    }
  },
  data() {
    return {
      title: this.t('Products'),
      items: [],
    }
  },
  methods: {

  },
  mounted() {

  }
}
</script>
