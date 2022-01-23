<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        <back-to-button class="mr-2" :label="t('Products')" :route="{name: 'admin-products'}"></back-to-button>
        {{ title }}
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <v-row>
          <v-col lg="3" md="6" sm="9">
            <products-form
              @success="$router.push({name: 'admin-products'})"
              @cancel="$router.push({name: 'admin-products'})"
            ></products-form>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";
import ProductsForm from "@/components/admin/products/ProductsForm";

export default {
  name: 'products-create',
  components: {
    ProductsForm
  },
  mixins: [langs],
  head() {
    return {
      title: this.title,
    }
  },
  data() {
    return {
      title: this.t('Creating Product'),
    }
  },
  mounted() {

  },
  created() {
  }
}
</script>

