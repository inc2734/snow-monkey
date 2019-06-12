module.exports = {
  plugins: [
    require('autoprefixer')({
      cascade: false,
    }),
    require('cssnano')({
      preset: 'default',
    })
  ]
}
