<template>
  <div>
    <v-data-table v-show="!loading"
                  :headers="headers"
                  :items="items"
                  disable-filtering disable-pagination disable-sort hide-default-footer
    >
      <template v-slot:item.id="{ item }">
        <v-btn @click.stop="$router.push({name: 'admin-accounts-users-id', params: {id: item.id}})" class="ma-2" outlined x-small fab color="indigo">
          <v-icon>mdi-account-group</v-icon>
        </v-btn>
        <v-btn @click.stop="$router.push({name: 'admin-accounts-edit-id', params: {id: item.id}})" class="ma-2" outlined x-small fab color="indigo">
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn @click.stop="confirmDestroy(item)" class="ma-2" outlined x-small fab color="error">
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
    </v-data-table>
    <v-skeleton-loader
      v-show="loading"
      type="table-thead, table-tbody"
    ></v-skeleton-loader>
    <confirm-dialog @yes="destroy" @no="confirmMessage = ''" :message="confirmMessage"></confirm-dialog>
  </div>
</template>

<script>

import langs from "@/mixins/langs";
import dataComponent from "@/mixins/dataComponent";

export default {
  name: "AccountsTable",
  mixins: [langs, dataComponent],
  data() {
    return {
      headers: [
        {
          text: this.t('Email'), align: 'start', value: 'email',
        },
        {
          text: this.t('Last visit'), align: 'start', value: 'last_visit_date',
        },
        {
          text: this.t('Roles'), align: 'start', value: 'roles',
        },
        {
          text: this.t('Status'), align: 'start', value: 'active',
        },
        {
          text: this.t('Actions'), align: 'right', value: 'id', sortable: false
        }
      ],
      confirmMessage: '',
      destroyItem: false,
      loading: false,
      items: []
    }
  },
  computed: {

  },
  methods: {
    confirmDestroy(item)
    {
      this.destroyItem = item
      this.confirmMessage = `Delete {${item.name}}?`
    },
    load() {
      this.loading = true
      this.$store.dispatch('admin/accounts/getAll', {
        success: (data) => this.items = data,
        end: () => this.loading = false
      })
    },
    destroy() {
      this.$store.dispatch('admin/accounts/destroy', {
        id: this.destroyItem.id,
        success: () => {
          this.destroyItem = false
          this.confirmMessage = ''
          this.load()
        }
      })
    }
  },
  mounted() {
    if (! this.loaded) {
      //this.load()
    }
  }
}
</script>

<style scoped>

</style>
