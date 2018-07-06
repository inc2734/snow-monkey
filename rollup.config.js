import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import babel from 'rollup-plugin-babel';

export default {
  output: {
    format: 'iife',
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
          "env", {
            "modules": false,
            "targets": {
              "browsers": ['last 2 versions']
            }
          }
        ]
      ],
      plugins: ['external-helpers'],
      babelrc: false
    })
  ]
};
