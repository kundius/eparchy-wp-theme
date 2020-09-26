const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const TerserPlugin = require('terser-webpack-plugin')
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin')

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
      PATHS.source + 'styles/main.scss',
      PATHS.source + 'images/sprite.svg',
      PATHS.source + 'images/logo.svg',
      PATHS.source + 'images/vk-group.png',
      PATHS.source + 'images/creator.png',
    ]
  },

  output: {
    path: PATHS.build,
    publicPath: '/wp-content/themes/eparchy/dist/',
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
        test: /\.(css|sass|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: ['postcss-preset-env', 'autoprefixer']
              }
            }
          },
          'sass-loader'
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
    minimize: process.env.NODE_ENV === 'production',
    minimizer: [
      new TerserPlugin(),
      new OptimizeCSSAssetsPlugin()
    ]
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: "[name].css",
      chunkFilename: "[id].css"
    })
  ]
}
