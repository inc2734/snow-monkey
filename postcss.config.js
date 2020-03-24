module.exports = {
  plugins: [
    require('autoprefixer')({
      cascade: false,
    }),
    require('css-mqpacker')(),
    require('cssnano')({
      preset: 'default',
    })
  ]
}
