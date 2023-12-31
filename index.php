<?php
session_start();
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("./mvc/model/connect.php");
include("./mvc/model/User.php");
include("./mvc/model/index_func.php");

//kiểm tra xem có session email không
//nếu có email thì tạo biến email


if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $name = getName($conn, $email);
}
include("./mvc/view/header.php");
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'logout':
            //nếu act = logout tiến hành đăng xuất và trở về form login
            unset($_SESSION['position']);
            unset($_SESSION['email']);
            include("./mvc/view/home.php");
            break;
        case 'login':
            //đăng nhập
            header("location: ./page/login.php");
            break;
        case 'register':
            //đăng ký
            header("location: ./page/register.php");
            break;
        case 'product_detail':
            //hiển thị chi tiết sản phẩm
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $product = getOne_product($conn, $id);
                include("./mvc/view/product_detail.php");
            }
            break;
        case 'home':
            //trở về trang chủ
            include("./mvc/view/home.php");
            break;
        case 'contact':
            //liên hệ
            require './phpmailer/src/Exception.php';
            require './phpmailer/src/PHPMailer.php';
            require './phpmailer/src/SMTP.php';
            if (isset($_GET['id']) && $_GET['id'] == 1) {
                if (isset($_POST['send'])) {
                    //gửi nội dung liên hệ tới mail của shop
                    //import thư viện phpmailer
                    $email_contact = $_POST['email'];
                    $name = $_POST['name'];
                    $content = $_POST['contact_content'];
                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'thienlodc123@gmail.com';
                    $mail->Password = 'uwgz llfk wheg xdwe';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('thienlodc123@gmail.com', "$name");
                    $mail->addAddress("thiencuaai123@gmail.com");
                    $mail->isHTML(true);
                    $mail->Subject = "Mail from website VT-SHOP";
                    $mail->Body = "Form liên hệ được gửi từ: $email_contact. NỘI DUNG: $content";
                    $mail->send();
                }
                //trở về trang home
                include("./mvc/view/home.php");
            } else {
                //hiển thị trang liên hệ
                include("./mvc/view/contact.php");
            }
            break;
        case 'profile':
            //hiển thị trang cá nhân
            $users = getinfoUser($conn, $email);
            include('./mvc/view/profile.php');
            break;
        case 'edit_info':
            //sửa thông tin cá nhân
            $email_edit = $_POST['email'];
            $name = $_POST['name'];
            $pass = $_POST['pass'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            edit_inf($conn, $email_edit, $name, $pass, $phone, $address, $email);
            $users = getinfoUser($conn, $email);
            include('./mvc/view/profile.php');
            break;
        case 'cart':
            //hiển thị trang cart
            include('./mvc/view/cart.php');
            break;
        case 'add_cart':
            if (isset($_SESSION['cart'])) {

            } else
                $_SESSION['cart'] = [];
            // lấy dữ liệu từ form
            if (isset($_POST['add_cart']) && $_POST['add_cart']) {
                $name_product = $_POST['name'];
                $price = $_POST['price'];
                $image = $_POST['image'];
                $quantity = $_POST['quanti'];
                //kiểm tra sản phẩm có trong giỏ hàng hay không
                $fl = 0;
                for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                    if ($_SESSION['cart'][$i][0] == $name_product) {
                        $fl = 1;
                        $quantitynew = $quantity + $_SESSION['cart'][$i][3];
                        $_SESSION['cart'][$i][3] = $quantitynew;
                        break;
                    }
                }
                if ($fl == 0) {
                    //thêm mới sản phẩm
                    $product = [$name_product, $price, $image, $quantity];
                    $_SESSION['cart'][] = $product;
                }
            }
            include('./mvc/view/cart.php');
            break;
        case 'deleteCart':
            if (isset($_GET['del']) && $_GET['del'] >= 0) {
                unset($_SESSION['cart']);
            }
            include('./mvc/view/cart.php');
            break;
        case 'search':
            include('./mvc/view/after_search.php');
            break;
        default:
            break;
    }
} else {
    include("./mvc/view/home.php");
}

include("./mvc/view/footer.php");


?>