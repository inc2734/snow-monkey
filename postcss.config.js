module.exports = {
  plugins: [
    require('autoprefixer')({
      browsers: ['last 2 versions'],
      cascade: false
    }),
    require('cssnano')({
      preset: 'default',
    })
  ]
}
