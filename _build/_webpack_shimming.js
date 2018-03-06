// provide
// 全局
const provide = {
    $: 'jquery',
    jquery: 'jquery',
    jQuery: 'jquery',
    Popper: 'popper.js',
    // poper: 'popper.js',
};


// alias
// 别名
const resolve = {
    alias: {
        // vue$: 'vue/dist/vue.esm.js',
        // 'popper.js': 'popper.js/dist/umd/popper.js',
        // jquery: 'jquery',
        // swiper$: 'swiper/dist/js/swiper.module.js',
        // swiper$: 'swiper/src/swiper.js',
        // swiper$: 'swiper/dist/js/swiper.js', // for swiper 4.0
    },
};


// 外部直接通过 script 标签引入的， 不需要 Webpack 打包的就下载下面。
// 相当于告诉 webpack 我已经通过外部（external)导入了，你不用管
// externals (src mode)
const externals = {
    // jquery: 'jQuery',
    // distpicker: 'window.Distpicker',
    // swiper: 'Swiper',
    // 'popper.js': 'window.Popper',
    // dropzone: 'Dropzone',
};

module.exports = { provide, resolve, externals };
