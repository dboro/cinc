<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        <back-to-button class="mr-2" :label="t('Accounts')" :route="{name: 'admin-accounts'}"></back-to-button>
        {{ title }}
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <v-row>
          <v-col lg="3" md="6" sm="9">
            <accounts-form
              @success="$router.push({name: 'admin-accounts'})"
              @cancel="$router.push({name: 'admin-accounts'})"
            ></accounts-form>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";
import AccountsForm from "@/components/admin/accounts/AccountsForm";

export default {
  name: 'accounts-create',
  components: {
    AccountsForm
  },
  mixins: [langs],
  head() {
    return {
      title: this.title,
    }
  },
  data() {
    return {
      title: this.t('Creating Account'),
    }
  },
  mounted() {

  },
  created() {
  }
}
</script>

