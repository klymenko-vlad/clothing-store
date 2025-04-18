<?php
function generateProduct($id, $image, $title, $price, $reviewCount = 0, $description = 'No description available.')
{
    return '
        <a href="/phpproj/item.php?id=' . htmlspecialchars($id) . '">
            <div class="product-item">
                <img height="300" width="200"
                     src="' . htmlspecialchars($image ?? 'assets/images/blank-product.png') . '"
                     alt="">
                <div class="down-content">
                    <h4>' . htmlspecialchars($title) . '</h4>
                    <h6>$' . number_format($price, 2) . '</h6>
                    <p>' . htmlspecialchars($description) . '</p>
                    <ul class="stars">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                    <span>Reviews (' . $reviewCount. ')</span>
                </div>
            </div>
        </a>
    ';
}
