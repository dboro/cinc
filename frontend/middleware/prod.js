export default function ({ store }) {
  let prod = location.host.split('.')[0]
  store.state.layout = prod
}
