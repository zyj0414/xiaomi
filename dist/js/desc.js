console.log("加载成功");

require.config({
    paths: {
        "jquery": "jquery-1.11.3",
        "jquery-cookie": "jquery.cookie",
        "nav": "nav",
        "goodsDesc": "goodsDesc"
    },
    shim: {
        //设置关系
        "jquery-cookie": ["jquery"]
    }
})

require(['nav', "goodsDesc"], function(nav, goodsDesc){
    nav.topNavTab();
    nav.leftNavDownload();
    nav.topNavTab();
    nav.leftNavTab();
    nav.allGoodsTab();
    nav.searchTab();
    nav.topNavDownload();

    goodsDesc.download();
    goodsDesc.banner();

})