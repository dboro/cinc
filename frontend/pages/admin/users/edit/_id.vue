<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        <back-to-button class="mr-2" :label="t('Users')" :route="{name: 'admin-users'}"></back-to-button>
        {{ title }}
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <v-row>
          <v-col lg="3" md="6" sm="9">
            <users-form :id="id"
             @success="$router.push({name: 'admin-users'})"
             @cancel="$router.push({name: 'admin-users'})"
            ></users-form>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>

import langs from "@/mixins/langs";
import UsersForm from "@/components/admin/users/UsersForm";

export default {
  name: 'users-edit',
  mixins: [langs],
  components: {
    UsersForm
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
    this.title = this.t('Edit User')
  }
}
</script>
