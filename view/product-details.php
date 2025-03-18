<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include "../helper/Sessions.php";
include_once "../app/product_class.php";
include_once "../app/review_class.php";

$showProduct = new Product();
$res = $showProduct->showEditProduct($_GET['id']);
foreach ($res as $product) {
}

?>

<?php $tittle = "product details"; ?>
<!--product details start-->
<div class="product_details mt-60 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="#">
                            <img id="zoom1" src="<?= $product['image'] ?>" data-zoom-image="<?= $product['image'] ?>" alt="big-1" style="width: 100%; height: auto;">
                        </a>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">
                    <form action="#">

                        <h1 style="font-size: xx-large;"><?= $product['name_en'] ?></h1>
                        <div class=" product_ratting">
                            <ul>
                                <!-- <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li> -->
                                <?php
                                $product_id = $product['id'];
                                $q = "SELECT COUNT(*) FROM reviews WHERE product_id= $product_id  ";
                                $sql = new PDO("mysql:host=localhost;dbname=newEcommerce", "root", "");
                                $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $conn = $sql->prepare($q);
                                $x = $conn->execute();
                                $review_count = $conn->fetchColumn();
                                // foreach ($products as $product) {
                                // } 
                                ?>
                                <li class="review" style="font-size: x-large;"><a href="#">(<?= $review_count ?> reviews) </a></li>
                            </ul>

                        </div>
                        <div class="price_box">
                            <span style="font-size: x-large;" class="current_price">Price : $ <?= $product['price'] ?> </span>
                            <!-- <span class="old_price">$80.00</span> -->

                        </div>
                        <div class="product_desc">
                            <!-- <ul>
                                    <li>In Stock</li>
                                    <li>Free delivery available*</li>
                                    <li>Sale 30% Off Use Code : 'Drophut'</li>
                                </ul> -->
                            <span style="font-size: x-large;">Description en: <a href="#">
                                    <p><?= $product['desc_en'] ?></p>
                                </a></span>
                            <span style="font-size: x-large;">الوصف: <a href="#">
                                    <p><?= $product['desc_ar'] ?></p>
                                </a></span>


                        </div>
                        <div class="product_meta">
                            <?php

                            $q = "SELECT categories.name_en FROM products JOIN categories on products.category_id=categories.id WHERE  category_id=:category_id ";
                            $sql = new PDO("mysql:host=localhost;dbname=newEcommerce", "root", "");
                            $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $conn = $sql->prepare($q);
                            $conn->execute(['category_id' => $product['category_id']]);
                            $categories = $conn->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($categories as $category) {
                            }


                            ?>
                            <span style="font-size: x-large;">Category: <a href="#">
                                    <p><?= $category['name_en'] ?></p>
                                </a></span>
                        </div>
                        <div class="product_meta">
                            <?php

                            $q = "SELECT brands.name_en FROM products JOIN brands on products.brand_id=brands.id WHERE  brand_id=:brand_id ";
                            $sql = new PDO("mysql:host=localhost;dbname=newEcommerce", "root", "");
                            $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $conn = $sql->prepare($q);
                            $conn->execute(['brand_id' => $product['brand_id']]);
                            $brands = $conn->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($brands as $brand) {
                            }


                            ?>
                            <span style="font-size: x-large;">brand: <a href="#">
                                    <p><?= $brand['name_en'] ?></p>
                                </a></span>
                        </div>
                        <!-- <div class="product_timing">
                                <div data-countdown="2023/12/15"></div>
                            </div> -->
                        <!-- <div class="product_variant color"> -->
                        <!-- <h3>Available Options</h3>
                                <label>color</label>
                                <ul>
                                    <li class="color1"><a href="#"></a></li>
                                    <li class="color2"><a href="#"></a></li>
                                    <li class="color3"><a href="#"></a></li>
                                    <li class="color4"><a href="#"></a></li>
                                </ul> -->
                        <!-- </div> -->
                        <div class="product_variant quantity">
                            <label style="font-size: x-large;">quantity:<?= $product['quantity'] ?></label>

                            <button class="button" type="submit">add to cart</button>

                        </div>
                        <div class=" product_d_action">
                            <ul>
                                <li><a href="#" title="Add to wishlist">+ Add to Wishlist</a></li>
                                <li><a href="#" title="Add to wishlist">+ Compare</a></li>
                            </ul>
                        </div>



                    </form>
                    <div class="priduct_social">
                        <ul>
                            <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>
                            <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>
                            <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>
                            <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>
                            <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--product details end-->

<!--product info start-->
<div class="product_d_info mb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Specification</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews (<?= $review_count ?>)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="product_info_content">
                                <p><?= $product['desc_en'] ?></p>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="sheet" role="tabpanel">
                            <div class="product_d_table">
                                <form action="#">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="first_child">name :</td>
                                                <td><?= $product['name_en'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">price : </td>
                                                <td>$ <?= $product['price'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">brand :</td>
                                                <td><?= $brand['name_en'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="product_info_content">
                                <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="reviews_wrapper">
                                <h2> reviews of this product</h2>
                                <div class="reviews_comment_box">
                                    <div class="row">

                                        <?php
                                        $showReview = new Reviews();
                                        $reviews = $showReview->showReviews($product['id']);
                                        $i = 0;
                                        foreach ($reviews as $review) { ?>

                                            <div class="col-12 md-5">


                                                <div class="comment_thmb">
                                                    <img src="assets/img/blog/comment2.jpg" alt="">
                                                </div>

                                                <div class="comment_text">
                                                    <div class="reviews_meta">
                                                        <div class="star_rating">
                                                            <ul>
                                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <span><?= $_SESSION['user_email'] ?></span>
                                                        <p><strong> </strong><?= $review['created_at'] ?></p>
                                                        <span><?= $review['comments'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>


                                </div>
                                <div class="comment_title">
                                    <h2>Add a review </h2>
                                    <p>Your email address will not be published. Required fields are marked </p>
                                </div>
                                <div class="product_ratting mb-10">
                                    <h3>Your rating</h3>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_review_form">
                                    <form action="../admin.php?page=logic_review&product=<?= $product['id'] ?>" method='POST'>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="review_comment">Your review </label>
                                                <textarea name="comments" id="review_comment"></textarea>
                                                <?php if (Sessions::has("comments") == "true") { ?>
                                                    <div class="alert alert-danger alert-dismissible fade show">
                                                        <?php Sessions::flash("comments"); ?>
                                                    </div>
                                                <?php } ?>

                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <label for="author">Name</label>
                                                <input id="author" name="name" type="text">
                                                <?php if (Sessions::has("name") == "true") { ?>
                                                    <div class="alert alert-danger alert-dismissible fade show">
                                                        <?php Sessions::flash("name"); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="email">Email </label>
                                                <input id="email" name="email" type="text" value="<?= $_SESSION['user_email'] ?>">
                                                <?php if (Sessions::has("email") == "true") { ?>
                                                    <div class="alert alert-danger alert-dismissible fade show">
                                                        <?php Sessions::flash("email"); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <button type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product info end-->