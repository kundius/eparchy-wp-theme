const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const TerserPlugin = require('terser-webpack-plugin')

const PATHS = {
  source: path.join(__dirname, 'src/'),
  build: path.join(__dirname, 'dist/')
}

module.exports = {
  watchOptions: {
    ignored: /node_modules/
  },

  entry: {
    main: [
      PATHS.source + 'scripts/main.js',
      PATHS.source + 'styles/main.css',
      PATHS.source + 'images/sprite.svg',
      PATHS.source + 'images/logo.svg',
      PATHS.source + 'images/vk-group.png',
      PATHS.source + 'images/creator.png',
    ]
  },

  output: {
    path: PATHS.build,
    publicPath: '/wp-content/themes/eparchia-wp-theme/dist/',
    filename: '[name].js',
    chunkFilename: '[name].js',
  },

  mode: process.env.NODE_ENV || 'development',

  resolve: {
    modules: [path.resolve(__dirname, 'src'), 'node_modules']
  },

  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },
      {
        test: /\.(css)$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {importLoaders: 1},
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  require('postcss-preset-env')({
                    features: {
                      'nesting-rules': true,
                      'custom-media-queries': true
                    }
                  }),
                  require('postcss-functions')({
                    functions: {
                      adaptive: function (valueFrom, valueTo, mediaFrom, mediaTo) {
                        return `calc(${valueFrom} + (${parseInt(valueTo) - parseInt(valueFrom)} * ((100vw - ${mediaFrom}) / ${parseInt(mediaTo) - parseInt(mediaFrom)})))`
                      }
                    }
                  }),
                  'postcss-em',
                  'cssnano'
                ]
              }
            }
          }
        ]
      },
      {
        test: /\.(png|jpg|gif|svg|webm|mp4|ogg|ogv)/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]?[hash]',
              outputPath: 'images/'
            }
          }
        ]
      },
      {
        test: /\.(eot|woff|woff2|ttf|otf)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]?[hash]',
              outputPath: 'fonts/'
            }
          }
        ]
      }
    ]
  },

  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin()
    ]
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: "[name].css",
      chunkFilename: "[id].css"
    })
  ]
}
