module.exports = {
  plugins: [
    require('postcss-import')(),
    require('autoprefixer')({
      cascade: false,
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
