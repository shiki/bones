<?php

add_action('after_setup_theme', 'affable_setup', 17);

function affable_setup()
{
  add_action('wp_enqueue_scripts', 'affable_scripts_and_styles', 1000);
}

function affable_scripts_and_styles()
{
  if (!is_admin()) {
    wp_register_script('affable-js', get_stylesheet_directory_uri() . '/affable/js/all.js', array('jquery'), '', true);
    wp_register_style('affable-stylesheet', get_stylesheet_directory_uri() . '/affable/css/all.css', array(), '', 'all');

    wp_dequeue_script('bones-js');
    wp_dequeue_style('bones-stylesheet');

    wp_enqueue_script('affable-js');
    wp_enqueue_style('affable-stylesheet');
  }
}

function affable_html_current_post_byline()
{
  $text = 'in %1$s &middot; <time class="updated" datetime="%2$s" pubdate>%3$s</time>';
  return sprintf(__($text, 'affable_aerith'), get_the_category_list(', '), get_the_time('Y-m-j'),
    get_the_time(get_option('date_format')));
}

function affable_html_sidebar_main_nav()
{
  return wp_page_menu(array(
    'show_home'   => true,
    'menu_class'  => 'sidebar-main-nav clearfix', // adding custom nav class
    'include'     => '',
    'exclude'     => '',
    'echo'        => false,
    'link_before' => '',                     // before each link
    'link_after'  => ''                      // after each link
  ));
}
