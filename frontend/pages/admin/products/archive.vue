<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        <back-to-button :label="t('Products')" :route="{name: 'admin-products'}"></back-to-button>
        {{ title }}
      </v-card-title>
      <v-divider></v-divider>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  name: 'products-archive',
  mixins: [langs],
  head() {
    return {
      title: this.title,
    }
  },
  data() {
    return {
      title: this.t('Archived Products'),
    }
  },
  mounted() {

  }
}
</script>
