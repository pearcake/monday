const path = require('path')
const fs = require('fs')
const config = fs.existsSync(path.join(__dirname, 'livereload.json')) ? require(path.join(__dirname, 'livereload.json')) : {}

const LocalURL = config.url || 'http://localhost'
const LocalPORT = config.port || 3000

const webpack = require('webpack')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const autoprefixer = require('autoprefixer')
const browsersync = require('browser-sync')
const cssnano = require('cssnano')

const isProduction = process.env.NODE_ENV === 'production'

const pathsToClean = [
  'assets/dist/**/*.map'
]

let postCssPlugins = [
  autoprefixer()
]

let pluginsArray = [
  new BrowserSyncPlugin({
    host: 'localhost',
    port: LocalPORT,
    proxy: LocalURL,
    files: [
      {
        match: [
          '**/*.php'
        ],
        fn: function (event, file) {
          if (event === 'change') {
            browsersync.get('bs-webpack-plugin')
            browsersync.reload()
          }
        }
      }
    ]
  }),
  // new webpack.optimize.ModuleConcatenationPlugin(),
  new MiniCssExtractPlugin({
    filename: '/css/[name].css'
  })

]

if (isProduction) {
  postCssPlugins.push(
    cssnano({
      preset: 'default',
      discardComments: {
        removeAll: true
      },
      reduceIdents: {
        keyframes: false
      },
      discardUnused: {
        keyframes: false
      },
      safe: true
    })
  )

  pluginsArray.push(
    new CleanWebpackPlugin(pathsToClean)
  )
}

module.exports = {
  optimization: {
    splitChunks: {
      cacheGroups: {
        styles: {
          name: 'theme',
          test: /\.css$/,
          chunks: 'all',
          enforce: true
        }
      }
    }
  },
  entry: {
    'theme': [
      './assets/src/js/theme.js',
      './assets/src/scss/theme.scss'
    ],
    'theme-ie': './assets/src/js/theme.js',
  },
  output: {
    path: path.join(__dirname, '/assets/dist/'),
    publicPath: '../',
    filename: 'js/[name].js'
  },
  resolve: {
    modules: [ 'node_modules', './assets/src/js/modules', './assets/src/fonts' ],
    extensions: ['.js', '.scss', '.css']
  },
  externals: {
    jquery: 'jQuery'
  },
  module: {
    rules: [
      // {
      //   test: /\.(js)$/,
      //   exclude: [/node_modules/],
      //   use: {
      //     loader: 'babel-loader',
      //     options: {
      //       presets: [
      //         ['@babel/preset-env', {
      //           useBuiltIns: 'entry'
      //         }]
      //       ]
      //     }
      //   }
      // },
      {
        test: /(\.scss|\.css)$/,
        use: [
          MiniCssExtractPlugin.loader,
          { loader: 'css-loader',
            options: {
              importLoaders: 1,
              sourceMap: !isProduction }
          },
          { loader: 'postcss-loader',
            options: {
              sourceMap: !isProduction,
              ident: 'postcss',
              plugins: (loader) => postCssPlugins
            }
          },
          { loader: 'resolve-url-loader' },
          { loader: 'sass-loader', options: { sourceMap: !isProduction } }
        ]
      },
      {
        test: /\.(jpg|jpeg|gif|png|svg)$/,
        loader: 'url-loader?limit=1024&name=images/[name].[ext]'
      },
      {
        test: /\.(woff|woff2|eot|ttf)$/,
        loader: 'file-loader?limit=10024&name=fonts/[name].[ext]'
      }
    ]
  },
  plugins: pluginsArray,
  devtool: isProduction ? '' : 'source-map'
}