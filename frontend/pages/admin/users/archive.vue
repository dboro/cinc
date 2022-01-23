<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        <back-to-button :label="t('Users')" :route="{name: 'admin-users'}"></back-to-button>
        {{ title }}
      </v-card-title>
      <v-divider></v-divider>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  name: 'users-archive',
  mixins: [langs],
  head() {
    return {
      title: this.title,
    }
  },
  data() {
    return {
      title: this.t('Archived Users'),
    }
  },
  mounted() {

  }
}
</script>
