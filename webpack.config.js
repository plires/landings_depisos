// webpack.config.js
const path = require('path');
const Dotenv = require('dotenv-webpack');

const javascriptRules = {
  test: /\.m?js$/,
  exclude: /(node_modules|bower_components)/,
  use: {
    loader: 'babel-loader',
    options: {
      presets: ['@babel/preset-env']
    }
  }
}

const stylesRules = {
  test: /\.css$/,
  use: [
    'style-loader',
    'css-loader'
  ]
}

module.exports = {
  entry: './src/index.js',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'main.js',
  },
  devtool: 'source-map',
  plugins: [
    new Dotenv({
      path: './.env', // load this now instead of the ones in '.env'
      safe: true, // load '.env.example' to verify the '.env' variables are all set. Can also be a string to a different file.
      allowEmptyValues: true, // allow empty variables (e.g. `FOO=`) (treat it as empty string, rather than missing)
      systemvars: true, // load all the predefined 'process.env' variables which will trump anything local per dotenv specs.
      silent: true, // hide any errors
      defaults: false
    })
  ],
  // resolve: {
  //   alias: {
  //       jquery: "jquery/src/jquery"
  //   }
  // },
  module: {
    rules: [
      javascriptRules,
      stylesRules
    ]
  }
};