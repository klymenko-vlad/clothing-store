<?php
function generateProduct($product): string
{
    $id = htmlspecialchars($product['idproduct'] ?? '');
    $image = htmlspecialchars($product['image'] ?? 'assets/images/blank-product.png');
    $title = htmlspecialchars($product['title'] ?? 'Untitled');
    $description = htmlspecialchars($product['description'] ?? 'No description available.');
    $price = $product['price'] ?? 0;
    $avgRating = intval($product['avg_rating'] ?? 0);
    $reviewCount = $product['review_count'] ?? 0;

    $priceFormatted = number_format($price, 2);

    $html = '<a href="/phpproj/item.php?id=' . $id . '">
        <div class="product-item">
            <img height="300" width="200" src="' . $image . '" alt="">
            <div class="down-content">
                <h4>' . $title . '</h4>
                <h6>$' . $priceFormatted . '</h6>
                <p>' . $description . '</p>
                <ul class="stars">';

    for ($i = 0; $i < $avgRating; $i++) {
        $html .= '<li><i class="fa fa-star"></i></li>';
    }

    for ($i = 0; $i < 5 - $avgRating; $i++) {
        $html .= '<li><i class="fa fa-star-o"></i></li>';
    }

    $html .= '</ul>
                <span>Reviews (' . $reviewCount . ')</span>
            </div>
        </div>
    </a>';

    return $html;
}
