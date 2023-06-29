<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Detail</title>

    <script src="https://kit.fontawesome.com/57d08e8260.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin-order-detail1.css" />

    <script defer src="../js/admin-order-detail.js"></script>

    <!-- ---- IMPORTING JQUERY, JQUERYUI, BOOTSTRAP----- -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
        integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="wrapper">
        <!-- ================================================ NAVBAR ================================================= -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light pt-3 pb-3">
            <a class="navbar-brand ms-6 pt-2 pb-2 fs-2.5" id="logo" href="#">SmartAgri</a>
            <button id="toggle" class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#btn">
                <i class="fa-solid fa-bars hamburger-icon"></i>
            </button>
            <div class="collapse navbar-collapse" id="btn">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active nav-element">
                        <a class="nav-link d-flex justify-content-center list pt-1 pb-1"
                            href="admin-dashboard.html">Dashboard</a>
                    </li>

                    <li class="nav-item nav-element">
                        <a class="nav-link d-flex justify-content-center list pt-1 pb-1"
                            href="admin-listprod.html">Products</a>
                    </li>

                    <li class="nav-item nav-element">
                        <a class="nav-link d-flex justify-content-center list pt-1 pb-1"
                            href="admin-listorder.html">Orders</a>
                    </li>

                    <li class="nav-item nav-element d-flex justify-content-center customed-logout">
                        <button type="button" class="btn btn-primary px-3">
                            Log out
                        </button>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- -------------------- body -------------------- -->

        <?php
// Retrieve the orderID from the URL parameter
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
} else {
    // Handle the case when orderID is not provided in the URL
    echo "OrderID is missing.";
    exit;
}

require_once "php/databases.php";

// Fetch the order info from the orderID
$query = "SELECT o.OrderID, o.Date, p.name AS ProductName, p.price AS TotalValue,
 c.Name AS CustomerName, c.Phone AS CustomerPhone, c.Email AS CustomerEmail, c.Address AS CustomerAddress, p.image as ProductImage
FROM orders AS o INNER JOIN customers AS c ON o.CustomerID = c.ID
INNER JOIN products AS p ON o.ProductID = p.id WHERE o.OrderID = '$orderID'";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $order = $result->fetch_assoc();
    $orderDate = $order['Date'];
    $productName = $order['ProductName'];
    $totalValue = $order['TotalValue'];
    $customerName = $order['CustomerName'];
    $customerPhone = $order['CustomerPhone'];
    $customerEmail = $order['CustomerEmail'];
    $customerAddress = $order['CustomerAddress'];
    $productImage = $order['ProductImage'];
} else {
    // Handle the case when the order is not found in the database
    echo "Order not found.";
    exit;
}

// Close the database connection
$conn->close();

?>


        <div class="container mt-3">
            <div class="row d-flex justify-content-center mx-1 my-3">
                <h1 class="text-center display-4 my-3 mb-5">Order Detail</h1>
                <div class="col-md-5 text-center mx-4">
                    <img src="<?php echo $productImage; ?>" alt="" class="img-fluid product-head-image h-100 circle" />
                </div>

                <div class="col-md-5 mt-md-3 mt-sm-3 mt-4 d-flex flex-column mx-4">
                    <h4 class="order-id-wrapper">
                        Order ID: <span class="order-id"><?php echo $orderID; ?></span>
                    </h4>

                    <p class="order-date-wrapper">
                        Ordered on: <span class="order-date"><?php echo $orderDate; ?></span>
                    </p>

                    <hr />

                    <h4 class="product-name">
                        Product Name: <span class="product-name"><?php echo $productName; ?></span>
                    </h4>

                    <p class="total-value-wrapper">
                        Total Value: $<span class="total-value"><?php echo $totalValue; ?></span>
                    </p>

                    <hr />

                    <h4 class="customer-name-wrapper">
                        Customer name: <span class="customer-name"><?php echo $customerName; ?></span>
                    </h4>
                    <p class="customer-phone-wrapper">
                        Mobile: <span class="customer-phone"><?php echo $customerPhone; ?></span>
                    </p>
                    <p class="customer-email-wrapper">
                        Email: <span class="customer-email"><?php echo $customerEmail; ?></span>
                    </p>
                    <p class="customer-address-wrapper">
                        Address: <span class="customer-address"><?php echo $customerAddress; ?></span>
                    </p>
                </div>
            </div>
        </div>

        <!-- ------- scroll to top and bottom button ------------------------------------------------ -->
        <button id="scrollToTopBtn">&#8593;</button>
        <button id="scrollToBottomBtn">&#8595;</button>

        <div class="footer">
            <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 390" xmlns="http://www.w3.org/2000/svg"
                class="transition duration-300 ease-in-out delay-150">
                <style>
                .path-0 {
                    animation: pathAnim-0 4s;
                    animation-timing-function: linear;
                    animation-iteration-count: infinite;
                }

                @keyframes pathAnim-0 {
                    0% {
                        d: path("M 0,400 C 0,400 0,100 0,100 C 75.97129186602871,115.11961722488039 151.94258373205741,130.23923444976077 244,118 C 336.0574162679426,105.76076555023924 444.200956937799,66.16267942583733 560,65 C 675.799043062201,63.837320574162675 799.2535885167464,101.11004784688996 898,115 C 996.7464114832536,128.88995215311004 1070.7846889952152,119.39712918660287 1157,113 C 1243.2153110047848,106.60287081339713 1341.6076555023924,103.30143540669857 1440,100 C 1440,100 1440,400 1440,400 Z"
                            );
                    }

                    25% {
                        d: path("M 0,400 C 0,400 0,100 0,100 C 107.42583732057417,104.26794258373207 214.85167464114835,108.53588516746412 301,103 C 387.14832535885165,97.46411483253588 452.01913875598086,82.1244019138756 555,77 C 657.9808612440191,71.8755980861244 799.0717703349283,76.96650717703349 909,79 C 1018.9282296650717,81.03349282296651 1097.6937799043062,80.00956937799045 1181,83 C 1264.3062200956938,85.99043062200955 1352.153110047847,92.99521531100478 1440,100 C 1440,100 1440,400 1440,400 Z"
                            );
                    }

                    50% {
                        d: path("M 0,400 C 0,400 0,100 0,100 C 113.55023923444975,77.23444976076554 227.1004784688995,54.468899521531085 330,67 C 432.8995215311005,79.53110047846891 525.1483253588516,127.35885167464116 620,136 C 714.8516746411484,144.64114832535884 812.3062200956939,114.09569377990431 909,93 C 1005.6937799043061,71.90430622009569 1101.6267942583731,60.258373205741634 1190,63 C 1278.3732057416269,65.74162679425837 1359.1866028708134,82.87081339712918 1440,100 C 1440,100 1440,400 1440,400 Z"
                            );
                    }

                    75% {
                        d: path("M 0,400 C 0,400 0,100 0,100 C 71.3205741626794,116.18181818181819 142.6411483253588,132.36363636363637 234,123 C 325.3588516746412,113.63636363636364 436.7559808612441,78.72727272727275 539,66 C 641.2440191387559,53.27272727272726 734.3349282296651,62.72727272727272 833,74 C 931.6650717703349,85.27272727272728 1035.9043062200956,98.36363636363636 1138,103 C 1240.0956937799044,107.63636363636364 1340.0478468899523,103.81818181818181 1440,100 C 1440,100 1440,400 1440,400 Z"
                            );
                    }

                    100% {
                        d: path("M 0,400 C 0,400 0,100 0,100 C 75.97129186602871,115.11961722488039 151.94258373205741,130.23923444976077 244,118 C 336.0574162679426,105.76076555023924 444.200956937799,66.16267942583733 560,65 C 675.799043062201,63.837320574162675 799.2535885167464,101.11004784688996 898,115 C 996.7464114832536,128.88995215311004 1070.7846889952152,119.39712918660287 1157,113 C 1243.2153110047848,106.60287081339713 1341.6076555023924,103.30143540669857 1440,100 C 1440,100 1440,400 1440,400 Z"
                            );
                    }
                }
                </style>
                <path
                    d="M 0,400 C 0,400 0,100 0,100 C 75.97129186602871,115.11961722488039 151.94258373205741,130.23923444976077 244,118 C 336.0574162679426,105.76076555023924 444.200956937799,66.16267942583733 560,65 C 675.799043062201,63.837320574162675 799.2535885167464,101.11004784688996 898,115 C 996.7464114832536,128.88995215311004 1070.7846889952152,119.39712918660287 1157,113 C 1243.2153110047848,106.60287081339713 1341.6076555023924,103.30143540669857 1440,100 C 1440,100 1440,400 1440,400 Z"
                    stroke="none" stroke-width="0" fill="#029602" fill-opacity="0.4"
                    class="transition-all duration-300 ease-in-out delay-150 path-0"></path>
                <style>
                .path-1 {
                    animation: pathAnim-1 4s;
                    animation-timing-function: linear;
                    animation-iteration-count: infinite;
                }

                @keyframes pathAnim-1 {
                    0% {
                        d: path("M 0,400 C 0,400 0,200 0,200 C 120.47846889952152,180.555023923445 240.95693779904303,161.11004784688996 320,163 C 399.04306220095697,164.88995215311004 436.6507177033493,188.1148325358852 524,185 C 611.3492822966507,181.8851674641148 748.4401913875599,152.43062200956936 873,163 C 997.5598086124401,173.56937799043064 1109.5885167464114,224.16267942583733 1202,237 C 1294.4114832535886,249.83732057416267 1367.2057416267944,224.91866028708134 1440,200 C 1440,200 1440,400 1440,400 Z"
                            );
                    }

                    25% {
                        d: path("M 0,400 C 0,400 0,200 0,200 C 108.84210526315792,183.77033492822966 217.68421052631584,167.54066985645932 320,173 C 422.31578947368416,178.45933014354068 518.1052631578947,205.60765550239233 601,218 C 683.8947368421053,230.39234449760767 753.8947368421053,228.02870813397132 840,214 C 926.1052631578947,199.97129186602868 1028.3157894736842,174.2775119617225 1131,170 C 1233.6842105263158,165.7224880382775 1336.842105263158,182.86124401913875 1440,200 C 1440,200 1440,400 1440,400 Z"
                            );
                    }

                    50% {
                        d: path("M 0,400 C 0,400 0,200 0,200 C 83.97129186602868,207.77033492822966 167.94258373205736,215.54066985645935 278,217 C 388.05741626794264,218.45933014354065 524.2009569377991,213.6076555023923 623,210 C 721.7990430622009,206.3923444976077 783.2535885167464,204.02870813397132 875,200 C 966.7464114832536,195.97129186602868 1088.7846889952154,190.27751196172247 1188,190 C 1287.2153110047846,189.72248803827753 1363.6076555023924,194.86124401913878 1440,200 C 1440,200 1440,400 1440,400 Z"
                            );
                    }

                    75% {
                        d: path("M 0,400 C 0,400 0,200 0,200 C 82.86124401913875,199.63636363636363 165.7224880382775,199.27272727272728 268,191 C 370.2775119617225,182.72727272727272 491.97129186602865,166.54545454545453 597,176 C 702.0287081339713,185.45454545454547 790.3923444976077,220.54545454545456 878,234 C 965.6076555023923,247.45454545454544 1052.4593301435407,239.27272727272728 1146,230 C 1239.5406698564593,220.72727272727272 1339.7703349282297,210.36363636363637 1440,200 C 1440,200 1440,400 1440,400 Z"
                            );
                    }

                    100% {
                        d: path("M 0,400 C 0,400 0,200 0,200 C 120.47846889952152,180.555023923445 240.95693779904303,161.11004784688996 320,163 C 399.04306220095697,164.88995215311004 436.6507177033493,188.1148325358852 524,185 C 611.3492822966507,181.8851674641148 748.4401913875599,152.43062200956936 873,163 C 997.5598086124401,173.56937799043064 1109.5885167464114,224.16267942583733 1202,237 C 1294.4114832535886,249.83732057416267 1367.2057416267944,224.91866028708134 1440,200 C 1440,200 1440,400 1440,400 Z"
                            );
                    }
                }
                </style>
                <path
                    d="M 0,400 C 0,400 0,200 0,200 C 120.47846889952152,180.555023923445 240.95693779904303,161.11004784688996 320,163 C 399.04306220095697,164.88995215311004 436.6507177033493,188.1148325358852 524,185 C 611.3492822966507,181.8851674641148 748.4401913875599,152.43062200956936 873,163 C 997.5598086124401,173.56937799043064 1109.5885167464114,224.16267942583733 1202,237 C 1294.4114832535886,249.83732057416267 1367.2057416267944,224.91866028708134 1440,200 C 1440,200 1440,400 1440,400 Z"
                    stroke="none" stroke-width="0" fill="#029602" fill-opacity="0.53"
                    class="transition-all duration-300 ease-in-out delay-150 path-1"></path>
                <style>
                .path-2 {
                    animation: pathAnim-2 4s;
                    animation-timing-function: linear;
                    animation-iteration-count: infinite;
                }

                @keyframes pathAnim-2 {
                    0% {
                        d: path("M 0,400 C 0,400 0,300 0,300 C 118.43062200956936,315.9425837320574 236.86124401913872,331.8851674641149 322,330 C 407.1387559808613,328.1148325358851 458.9856459330143,308.4019138755981 559,312 C 659.0143540669857,315.5980861244019 807.1961722488039,342.5071770334928 913,335 C 1018.8038277511961,327.4928229665072 1082.2296650717703,285.5693779904306 1163,274 C 1243.7703349282297,262.4306220095694 1341.8851674641148,281.21531100478467 1440,300 C 1440,300 1440,400 1440,400 Z"
                            );
                    }

                    25% {
                        d: path("M 0,400 C 0,400 0,300 0,300 C 86.65071770334927,298.64114832535887 173.30143540669854,297.28229665071774 268,299 C 362.69856459330146,300.71770334928226 465.444976076555,305.511961722488 572,302 C 678.555023923445,298.488038277512 788.9186602870813,286.66985645933016 885,287 C 981.0813397129187,287.33014354066984 1062.8803827751196,299.8086124401914 1153,304 C 1243.1196172248804,308.1913875598086 1341.55980861244,304.0956937799043 1440,300 C 1440,300 1440,400 1440,400 Z"
                            );
                    }

                    50% {
                        d: path("M 0,400 C 0,400 0,300 0,300 C 87.19617224880383,306.13397129186603 174.39234449760767,312.267942583732 260,306 C 345.60765550239233,299.732057416268 429.62679425837325,281.06220095693783 539,282 C 648.3732057416267,282.93779904306217 783.1004784688995,303.48325358851673 888,304 C 992.8995215311005,304.51674641148327 1067.9712918660287,285.00478468899524 1155,281 C 1242.0287081339713,276.99521531100476 1341.0143540669856,288.4976076555024 1440,300 C 1440,300 1440,400 1440,400 Z"
                            );
                    }

                    75% {
                        d: path("M 0,400 C 0,400 0,300 0,300 C 92.59330143540669,315.98086124401914 185.18660287081337,331.9617224880382 266,335 C 346.8133971291866,338.0382775119618 415.8468899521532,328.13397129186603 531,316 C 646.1531100478468,303.86602870813397 807.4258373205741,289.5023923444976 903,285 C 998.5741626794259,280.4976076555024 1028.4497607655503,285.85645933014354 1107,290 C 1185.5502392344497,294.14354066985646 1312.7751196172248,297.07177033492826 1440,300 C 1440,300 1440,400 1440,400 Z"
                            );
                    }

                    100% {
                        d: path("M 0,400 C 0,400 0,300 0,300 C 118.43062200956936,315.9425837320574 236.86124401913872,331.8851674641149 322,330 C 407.1387559808613,328.1148325358851 458.9856459330143,308.4019138755981 559,312 C 659.0143540669857,315.5980861244019 807.1961722488039,342.5071770334928 913,335 C 1018.8038277511961,327.4928229665072 1082.2296650717703,285.5693779904306 1163,274 C 1243.7703349282297,262.4306220095694 1341.8851674641148,281.21531100478467 1440,300 C 1440,300 1440,400 1440,400 Z"
                            );
                    }
                }
                </style>
                <path
                    d="M 0,400 C 0,400 0,300 0,300 C 118.43062200956936,315.9425837320574 236.86124401913872,331.8851674641149 322,330 C 407.1387559808613,328.1148325358851 458.9856459330143,308.4019138755981 559,312 C 659.0143540669857,315.5980861244019 807.1961722488039,342.5071770334928 913,335 C 1018.8038277511961,327.4928229665072 1082.2296650717703,285.5693779904306 1163,274 C 1243.7703349282297,262.4306220095694 1341.8851674641148,281.21531100478467 1440,300 C 1440,300 1440,400 1440,400 Z"
                    stroke="none" stroke-width="0" fill="#029602" fill-opacity="1"
                    class="transition-all duration-300 ease-in-out delay-150 path-2"></path>
            </svg>

            <div class="footer-wrapper">
                <h2>SmartAgri</h2>
                <p>
                    SmartAgri - We make stuffs, you know. Some random tech products.
                    Actually, we have no idea what we are doing so please don't question
                    us. We love you. God loves you!
                </p>
                <h3>Here are our social links!</h3>
                <ul class="icons">
                    <li>
                        <a href=""><i class="fa-brands fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fa-brands fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fa-brands fa-github"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fa-brands fa-youtube"></i></a>
                    </li>
                </ul>
                <div class="footer-bottom">
                    <p>copyright &copy;2023 <a href="”#”">CoolKidsInTheClub</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>