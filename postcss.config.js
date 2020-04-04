module.exports = {
  plugins: [
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
