<?php

foreach ( glob ( plugin_dir_path( __FILE__ ) . "include/*.php" ) as $file ){
  include_once $file;
}