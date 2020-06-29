module.exports = {
  plugins: [
    require('postcss-import')(),
    require('autoprefixer')({
      cascade: false,
    }),
    require('css-mqpacker')({
      sort: true,
    }),
    require('postcss-mq-optimize'),
    require('cssnano')({
      preset: 'default',
    })
  ]
}
