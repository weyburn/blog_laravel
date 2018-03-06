const webpack = require('webpack');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const webpackShimming = require('./_webpack_shimming');
const webpackPath = require('./_webpack_path');

const webpackPlugins = [];

// https://doc.webpack-china.org/plugins/ignore-plugin/#src/components/Sidebar/Sidebar.jsx
webpackPlugins.push(new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/));


// Scope Hoisting-作用域提升
// 大概知道这样可以提高代码执行速度
// https://doc.webpack-china.org/plugins/module-concatenation-plugin/#src/components/Sidebar/Sidebar.jsx
// 提升你的代码在浏览器中的执行速度。
webpackPlugins.push(new webpack.optimize.ModuleConcatenationPlugin());


// 全局 Shimming
// webpackPlugins.push(new webpack.ProvidePlugin({
//     _: 'lodash'
// }));
// 全局 Shimming （即不需要 import 直接用）
// https://doc.webpack-china.org/guides/shimming/
webpackPlugins.push(new webpack.ProvidePlugin(webpackShimming.provide));


// 一些第三方的库会在开发模式下有更多的调试输出
// 这里判断是打包本地用(isDist 为 FALSE）还是生成环境用（isDist)
// 查看相关文档：
// https://doc.webpack-china.org/plugins/define-plugin/#-
// https://doc.webpack-china.org/guides/production/#-
if (webpackPath.isDist) {
    console.log('NODE_ENV    : production');
    // 部署 PLUGIN
    webpackPlugins.push(
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"',
            },
        }),
        new webpack.optimize.OccurrenceOrderPlugin(),
        new UglifyJSPlugin(),
    );
} else {
    console.log('NODE_ENV    : development');
    // 开发 PLUGIN
    webpackPlugins.push(new webpack.DefinePlugin({
        'process.env': {
            NODE_ENV: '"development"',
        },
    }));
}
// source map
// 开启SOURCE MAP 方便开发的时候调试
webpackPlugins.push(new UglifyJSPlugin({ sourceMap: !webpackPath.isDist }));

// 导出该插件数组
module.exports = webpackPlugins;
