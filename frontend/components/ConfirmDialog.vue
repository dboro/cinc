<template>
  <v-dialog
    v-model="dialog"
    max-width="290"
  >
    <v-card>
      <v-card-title class="headline">
        {{ t(title) }}
      </v-card-title>

      <v-card-text>
        {{ t(message) }}
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
          class="white--text" rounded depressed color="red"
          @click.stop="$emit('yes')"
        >
          {{ t(yes) }}
        </v-btn>

        <v-btn
          rounded outlined
          @click.stop="$emit('no')"
        >
          {{ t(no) }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  mixins: [langs],
  name: "ConfirmDialog",
  data() {
    return {
      dialog: false
    }
  },
  props: {
    title: {
      default: 'Confirm action',
    },
    message: String,
    yes: {
      default: 'Yes',
    },
    no: {
      default: 'No'
    }
  },
  watch: {
    message(val) {
      if (val) {
        this.dialog = true
      }
      else {
        this.dialog = false
      }
    }
  }
}
</script>

<style scoped>

</style>
