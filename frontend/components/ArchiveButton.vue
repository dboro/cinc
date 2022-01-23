<template>
  <v-btn disabled @click.stop="$router.push(route)" class="ml-3" rounded outlined>
    {{ label }}
  </v-btn>
</template>

<script>
export default {
  name: "CreateButton",
  props: {
    label: {
      default: 'Archive'
    },
    route: Object
  }
}
</script>

<style scoped>

</style>
