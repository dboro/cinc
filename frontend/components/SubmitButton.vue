<template>
  <v-btn :disabled="disabled" :loading="disabled" type="submit" class="white--text" rounded depressed color="indigo">
    <slot>{{ t('Save') }}</slot>
  </v-btn>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  mixins: [langs],
  name: "SubmitButton",
  props: {
    disabled: {
      default: false
    }
  }
}
</script>

<style scoped>

</style>
