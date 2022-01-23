<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        {{ title }}
        <create-button class="ml-2" :route="{name: 'admin-users-create'}"></create-button>
        <v-spacer/>
        <archive-button :route="{name: 'admin-users-archive'}"></archive-button>
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <users-table></users-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";
import UsersTable from "@/components/admin/users/UsersTable";
import page from "@/mixins/page";

export default {
  name: 'users-index',
  components: {UsersTable},
  mixins: [langs, page],
  head() {
    return {
      title: this.title,
    }
  },
  data() {
    return {
      title: this.t('Users'),
      items: [],
    }
  },
  methods: {

  },
  mounted() {

  }
}
</script>
