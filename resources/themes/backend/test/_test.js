import './_test.scss';

$(() => {
    // 在该命名空间下执行
    // 即 body 元素有 body-test-index 的类名
    if ($(document.body).hasClass('body-test-index')) {
        console.log('#TEST');
    }
});

