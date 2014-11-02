<?php

  function renderMenu($menu, $active) {
    $html_out = '<div class="panel panel-default">';
    $html_out .=renderMenuR($menu, $active, '');
    $html_out .= '</div>';
    return $html_out;
  }

  /**
   * $path - array of menu path
   */
  function renderMenuR($menu, $active_path, $curr_path)
  {
    $html_out = '';
    foreach($menu as $sub_menu) {
      $icon = (count($sub_menu) >= 3) ? $sub_menu[2] : '';
      if (is_array($sub_menu[1])) // is a menu node
      {
        $html_out .= '<div class="panel-heading">';
        $html_out .= '<h4 class="panel-title">';
        $html_out .= '  <a data-toggle="collapse" data-parent="#accordion" href="#collapse_' . $sub_menu[0] . '">' . $icon . ' ' . $sub_menu[0] . '</a>';
        $html_out .= '  </h4>';
        $html_out .= '</div>';

        $html_out .= '<div id="collapse_' . $sub_menu[0] . '" class="panel-collapse collapse">';
        $html_out .= '  <ul class="list-group">';
        $html_out .= renderMenuR($sub_menu[1], $active_path, $curr_path . '/' . $sub_menu[0]);
        $html_out .= '  </ul>';
        $html_out .= '</div>';

        /*
        $html_out .= '<li><a name="#' . $sub_menu[0] . '">' . $sub_menu[0] . '</a>';
        $html_out .= '<ul>';
        $html_out .= renderMenuR($sub_menu[1], $active_path, $curr_path . '/' . $sub_menu[0]);
        $html_out .= '</ul>';
        */
      }
      else 
      {
        $active_attr = '';
        if ($curr_path . '/' . $sub_menu[0] == $active_path) {
          $active_attr = 'class="active"';
        }
        $html_out .= '<li class="list-group-item">' . $icon . ' <a href="' . $sub_menu[1] . '"> ' . $sub_menu[0] . '</a></li>';
        //$html_out .= '<li ' . $active_attr . '><a href="' . $sub_menu[1] . '">' . $sub_menu[0] . '</a></li>';
      }
    }
    return $html_out;
  }
?>
          {{ renderMenu($menus['workspace'], '/User/Account') }}
          
