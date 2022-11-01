module.exports = {
  plugins: [
    require('postcss-import')(),
    require('autoprefixer')({
      cascade: false,
    }),
    require('css-mqpacker')({
      sort: true,
    }),
    require( 'cssnano' )( {
      preset: [
        'default',
        {
          calc: false,
        },
      ],
    } ),
  ]
}
