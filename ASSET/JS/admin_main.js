// variable button
var cate_btn = document.getElementById("btn_category");
var logo_btn = document.getElementById("btn_logo");
var btn_banner = document.getElementById("btn_banner");
var btn_product = document.getElementById("btn_product");
var btn_product_type = document.getElementById("btn_pro_type");


// buttons event handling

var clickCount_cateBtn = 0;
// category button
cate_btn.addEventListener("click", function () {
    clickCount_cateBtn++;
    window.location.href = "../Admin/MVC/view/category_view.php";
});
var clickCount_logoBtn = 0;
// logo button
logo_btn.addEventListener("click", function () {
    clickCount_logoBtn++;
    window.location.href = "../Admin/MVC/view/logo_view.php";
});
var clickCount_bannerBtn = 0;
// banner button
btn_banner.addEventListener("click", function () {
    clickCount_bannerBtn++;
    window.location.href = "../Admin/MVC/view/banner_view.php";
});
var clickCount_proTypeBtn = 0;
// banner button
btn_product_type.addEventListener("click", function () {
    clickCount_proTypeBtn++;
    window.location.href = "../Admin/MVC/view/pro_type_view.php";
});
var clickCount_productBtn = 0;
// product button
btn_product.addEventListener("click", function () {
    clickCount_bannerBtn++;
    window.location.href = "../Admin/MVC/view/category.php";
});

