<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        {{ title }}
        <create-button class="ml-2" :route="{name: 'admin-accounts-create'}"></create-button>
        <v-spacer/>
        <archive-button :route="{name: 'admin-accounts-archive'}"></archive-button>
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <accounts-table></accounts-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";
import AccountsTable from "@/components/admin/accounts/AccountsTable";
import page from "@/mixins/page";

export default {
  name: 'accounts-index',
  components: {AccountsTable},
  mixins: [langs, page],
  head() {
    return {
      title: this.title,
    }
  },
  data() {
    return {
      title: this.t('Accounts'),
      items: [],
    }
  },
  methods: {

  },
  mounted() {

  }
}
</script>
