import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import babel from 'rollup-plugin-babel';

export default {
  output: {
    format: 'iife',
    dir: 'resources/assets/js',
    globals: {
      jquery: "jQuery"
    }
  },
  external: ['jquery', '_', 'Backbone'],
  plugins: [
    resolve({ jsnext: true }),
    commonjs(),
    babel({
      presets: [
        [
          "@babel/preset-env", {
            "modules": false,
            "targets": {
              "browsers": ['last 2 versions']
            }
          }
        ]
      ],
      babelrc: false
    })
  ],
  experimentalCodeSplitting: true
};
