module.exports = {
  mode: 'production',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: {
          include: /node_modules/,
          exclude: /node_modules\/@inc2734\/smooth-scroll\//,
        },
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      }
    ]
  },
  resolve: {
    extensions: ['.js', '.jsx']
  },
  externals: {
    jquery: 'jQuery'
  }
};
