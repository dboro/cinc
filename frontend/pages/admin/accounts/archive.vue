<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        <back-to-button :label="t('Accounts')" :route="{name: 'admin-accounts'}"></back-to-button>
        {{ title }}
      </v-card-title>
      <v-divider></v-divider>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  name: 'accounts-archive',
  mixins: [langs],
  head() {
    return {
      title: this.title,
    }
  },
  data() {
    return {
      title: this.t('Archived Accounts'),
    }
  },
  mounted() {

  }
}
</script>
