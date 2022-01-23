<template>
  <v-btn nuxt @click.stop="$router.push(route)" rounded outlined color="indigo">
    <v-icon>mdi-arrow-plus</v-icon>
    {{ label }}
  </v-btn>
</template>

<script>
export default {
  name: "CreateButton",
  props: {
    label: {
      default: 'Create new'
    },
    route: Object
  }
}
</script>

<style scoped>

</style>
