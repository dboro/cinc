<template>
  <div>
    <v-autocomplete
      v-model="value"
      :loading="loading"
      :items="items"
      :search-input.sync="search"
      cache-items
      hide-no-data
      hide-details
      :label="label"
      @change="$emit('input', value)"
      outlined rounded dense
    ></v-autocomplete>
    <v-alert v-if="isAdd" class="mt-2" outlined dense color="deep-purple">
      <v-row align="center">
        <v-col>
          {{ noDataText }}
        </v-col>
        <v-col class="shrink">
          <v-btn color="indigo" outlined rounded small>Add new</v-btn>
        </v-col>
      </v-row>
    </v-alert>
  </div>
</template>

<script>
export default {
  name: "AsyncAutocomplete",
  props: {
    label: {
      default: null
    },
    noDataText: {
      default: 'No data'
    }
  },
  data () {
    return {
      timeout: false,
      loading: false,
      items: [],
      search: null,
      value: null,
      states: [
        'Alabama',
        'Alaska',
        'American Samoa',
        'Arizona',
        'Arkansas',
        'California',
        'Colorado',
        'Connecticut',
        'Delaware',
        'District of Columbia',
        'Federated States of Micronesia',
        'Florida',
        'Georgia',
        'Guam',
        'Hawaii',
        'Idaho',
        'Illinois',
        'Indiana',
        'Iowa',
        'Kansas',
        'Kentucky',
        'Louisiana',
        'Maine',
        'Marshall Islands',
        'Maryland',
        'Massachusetts',
        'Michigan',
        'Minnesota',
        'Mississippi',
        'Missouri',
        'Montana',
        'Nebraska',
        'Nevada',
        'New Hampshire',
        'New Jersey',
        'New Mexico',
        'New York',
        'North Carolina',
        'North Dakota',
        'Northern Mariana Islands',
        'Ohio',
        'Oklahoma',
        'Oregon',
        'Palau',
        'Pennsylvania',
        'Puerto Rico',
        'Rhode Island',
        'South Carolina',
        'South Dakota',
        'Tennessee',
        'Texas',
        'Utah',
        'Vermont',
        'Virgin Island',
        'Virginia',
        'Washington',
        'West Virginia',
        'Wisconsin',
        'Wyoming',
      ],
    }
  },
  watch: {
    search (val) {
      val && val !== this.select && this.querySelections()
    },
  },
  computed: {
    isAdd() {
      if (this.search && this.items.length == 0 && !this.loading) {
        return true;
      }

      return false
    }
  },
  methods: {
    querySelections () {
      if (!this.loading) {
        this.loading = true
        // Simulated ajax query
        setTimeout(() => {
          console.log('send')
          console.log(this.search)
          this.items = this.states.filter(e => {
            return (e || '').toLowerCase().indexOf((this.search || '').toLowerCase()) > -1
          })
          this.loading = false
        }, 500)
      }
    },
  },
}
</script>

<style scoped>

</style>
