<?php
class CustomMenuWalker extends Walker_Nav_Menu
{
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $object = $item->object;
    $type = $item->type;
    $title = $item->title;
    $description = $item->description;
    $permalink = $item->url;
    $output .= "<li class='" .  implode(" ", $item->classes) . "'>";
    // _menu_item_fusion_megamenu_icon
    $megamenu_settings = get_post_meta( $item->ID, '_menu_item_fusion_megamenu', true);
    $icon = $megamenu_settings['icon'];

    //Add SPAN if no Permalink
    if( $permalink && $permalink != '#' ) {
      $output .= '<a href="' . $permalink . '">';
    } else {
      $output .= '<a href="">';
    }

    if ( $depth == 0 ) {
      if ( $icon ) {
        $output .= '<div class="ico"><i class="fa '.$icon.'"></i></div>';
      } else {
        $output .= '<div class="ico"><i class="fa fa-circle-o"></i></div>';
      }
    }


    $output .= $title;
    if( $description != '' && $depth == 0 ) {
      $output .= '<small class="description">' . $description . '</small>';
    }
    if( $permalink && $permalink != '#' ) {
      $output .= '</a>';
    } else {
      $output .= '</a>';
    }
  }
}
