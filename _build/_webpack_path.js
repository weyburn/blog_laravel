const path = require('path');

const webpackPath = {};

// 主题（视图）目录 `~/resources/themes` 文件夹路径
// const THEMES_DIR = path.resolve(__dirname, 'resources/themes');
// 静态资源输出目录 将打包的文件输到改路径下
// const STATIC_DIR = path.resolve(__dirname, 'public/statics');


// 不是项目根目录下了，而是根目录下的 _build 下，要加 ../
webpackPath.THEMES_DIR = path.resolve(__dirname, '../resources/themes');
webpackPath.STATIC_DIR = path.resolve(__dirname, '../public/statics');

// 是否为生产环境打包
console.log(process.env.NODE_ENV);

// 打包生成的样式(styles)、脚本(scripts)放在 STATIC_DIR 下面
// product:
//     样式:  static/styles
//     脚本:  static/scripts
// development
//     样式:  static/____styles
//     脚本:  static/____scripts

webpackPath.isDist = process.env.NODE_ENV === 'production';
webpackPath.STATIC_SUBDIR_PREFIX = webpackPath.isDist ? '' : '____';
webpackPath.isChunkhash = webpackPath.isDist ? '-[chunkhash]' : '-devvvvvvvvvvvvvvvv';


module.exports = webpackPath;
