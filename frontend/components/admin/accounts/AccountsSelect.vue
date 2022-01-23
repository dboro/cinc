<template>
  <c-select></c-select>
</template>

<script>

import langs from "@/mixins/langs";
import dataComponent from "@/mixins/dataComponent";

export default {
  mixins: [langs, dataComponent],
  name: "AccountsSelect",
  props: {
    id: {
      default: false
    }
  },
  data() {
    return {

    }
  },
  computed: {
    items() {
      return this.$store.state.admin.accounts.items
    },
    loading() {
      return this.$store.state.admin.accounts.loadingItem
    },
  },
  methods: {
    load() {
      this.$store.dispatch('admin/accounts/getAll', this.id)
    }
  },
  created() {

  },
  mounted() {
    if (!this.loaded) {
      this.load()
    }
  }
}
</script>

<style scoped>

</style>
