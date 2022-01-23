export default function({ $axios, redirect }) {
  console.log(process.env.NODE_ENV);
  $axios.onError(error => {
    const code = parseInt(error.response && error.response.status)
    if (code === 401) {
      redirect('/auth/login')
    }
  })
}
