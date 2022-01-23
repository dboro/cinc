<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        {{ t('Dashboard!') }}
      </v-card-title>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";
import page from "@/mixins/page";

export default {
  mixins: [langs, page],
  mounted() {

  }
}
</script>
