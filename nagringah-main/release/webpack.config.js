const path = require('path')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const webpack = require('webpack')

module.exports = {  
  entry: './src/index.js',

  output: {  
    path: path.resolve('../dist'),  
    filename: 'main.js'  
  },

  devtool: "source-map",

  node: {
    fs: "empty",
    net: 'empty',
    console: true,
    child_process: "empty"
  },

  module: {
    rules: [{
        test: /\.js$/,  
        exclude: /node_modules/,  
        use: {  
          loader: 'babel-loader',  
          options: {  
            cacheDirectory: true  
          }  
        }
    },{  
      test: /\.scss$/,  
      use: [  
        { loader: MiniCssExtractPlugin.loader },  
        "css-loader",  
        "sass-loader"  
      ]  
    },{  
      test: /\.css$/,  
      use: [  
        { loader: MiniCssExtractPlugin.loader },  
        "css-loader",  
        "sass-loader"  
      ]  
    },{ 
      test: /\.(png|jpg|gif|svg)$/,
      use: [
          {
              loader: 'file-loader',
              options: {
                  name: '[path][name].[ext]',
                  context: path.resolve(__dirname, "src/"),
                  publicPath: '../',
                  useRelativePaths: true
              }
          }
      ] 
    },{
      test: /\.(woff|woff2|eot|ttf|otf)$/,
      use: [
        {
            loader: 'file-loader',
            options: {
                name: '[path][name].[ext]',
                context: path.resolve(__dirname, "src/"),
                publicPath: '../',
                useRelativePaths: true
            }
        }
      ] 
    },{
      test: /\.json$/,
      use: 'json-loader'
    }]    
  },

  plugins: [
    new MiniCssExtractPlugin({  
      filename: "css/[name].css"  
    }),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery'
    })
  ]
}