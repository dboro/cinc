<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        <back-to-button class="mr-2" :label="t('Accounts')" :route="{name: 'admin-accounts'}"></back-to-button>
        {{ title }}
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <accounts-users-table :id="id"></accounts-users-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";
import AccountsUsersTable from "@/components/admin/accounts/AccountsUsersTable";

export default {
  name: 'accounts-edit',
  mixins: [langs],
  components: {
    AccountsUsersTable
  },
  head() {
    return {
      title: this.title,
    }
  },
  data: function () {
    return {
      id: false,
      title: ''
    }
  },
  created() {
    this.id = this.$route.params.id
    this.title = this.t('Users In Account')
  }
}
</script>
