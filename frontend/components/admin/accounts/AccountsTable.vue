<template>
  <div>
    <div class="text-right">
      <c-paginate v-if="isPaginate"
                  :count="count"
                  v-model="paginate"
      ></c-paginate>
    </div>
    <v-data-table v-show="!loading"
                  :headers="headers"
                  :items="items"
                  :options.sync="options"
                  multi-sort
                  :server-items-length="paginate.limit"
                  disable-filtering disable-pagination hide-default-footer
    >
      <template v-slot:item.product_id="{ item }">
        {{ item.product.name }}
      </template>
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
    <c-paginate v-if="isPaginate"
                :count="count"
                v-model="paginate"
    ></c-paginate>
    <confirm-dialog @yes="destroy" @no="confirmMessage = ''" :message="confirmMessage"></confirm-dialog>
  </div>
</template>

<script>

import langs from "@/mixins/langs";
import dataComponent from "@/mixins/dataComponent";
import paginateable from "@/mixins/paginateable";
import asyncdatatable from "@/mixins/asyncdatatable";

export default {
  name: "AccountsTable",
  mixins: [langs, dataComponent, paginateable, asyncdatatable],
  data() {
    return {
      headers: [
        {
          text: this.t('Name'), value: 'name'
        },
        {
          text: this.t('Slug'), value: 'slug'
        },
        {
          text: this.t('Product'), value: 'product_id'
        },
        {
          text: this.t('Actions'), align: 'right', value: 'id', sortable: false
        }
      ],
      confirmMessage: '',
      destroyItem: false,
      loading: false,
      items: [],
      getCountAction: 'admin/accounts/getCount'
    }
  },
  methods: {
    confirmDestroy(item)
    {
      this.destroyItem = item
      this.confirmMessage = `Delete {${item.name}}?`
    },
    load() {
      this.loading = true
      this.items = []

      this.$store.dispatch('admin/accounts/getAll', {
        limit: this.paginate.limit,
        page: this.paginate.page,
        sorts: this.query.sorts,
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
    },
  },
  mounted() {
    //this.load()
  }
}
</script>

<style scoped>

</style>
