<?php

add_action ('woocommerce_before_shop_loop_item_title', 'qty_sales');
function qty_sales(){
  global $product;
  echo 'Количество штук продано: ' . $product->get_total_sales();
}

add_shortcode('shuffle_bestsellers', 'output_shuffle_bestsellers');
function output_shuffle_bestsellers(){
  $args = [
    'post_type' => 'product',
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
    'posts_per_page' => 3
  ];
  $loop = new WP_Query($args);
  shuffle($loop->posts);
  echo '<ul class="products columns-3">';
  while($loop->have_posts()) {
    $product = $loop -> the_post();
    wc_get_template_part ('content', 'product');
  }
  echo '</ul>';
  wp_reset_postdata();
}
