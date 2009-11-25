<?php
/*
  Plugin Name: Remove Generator Information
  Description: Deshabilita la informaci&oacute;n sobre qui&eacute;n ha generado el HTML,XHTML,RSS,ATOM,etc...
  Version: 0.1
  Author: Joan B. Gim&eacute;nez Sendiu
*/
/*  Copyright 2009  JUAN BAUTISTA GIMENEZ SENDIU  (email : neojoda@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define("VERSION_RGM","0.1");

/**
 * @ return void
*/
function no_generator_metatag_options(){
  echo '<div class="wrap">';
  echo '<h2>Remove Generator Information</h2>';
	echo '<form method="post" action="options.php">';
	echo '<table class="form-table">';
	echo '<tr valign="top">';
	echo '  <th scope="row" style="width:300px;">No Generator info on XHTML page</th>';
	echo '  <td><input type="checkbox" name="no_generator_metatag_xhtml" value="1" '.(get_option("no_generator_metatag_xhtml")==1 ? "checked" : "").'" /></td>';
	echo '</tr><tr>';
	echo '  <th scope="row">No Generator info on a HTML page</th>';
	echo '  <td><input type="checkbox" name="no_generator_metatag_html" value="1" '.(get_option("no_generator_metatag_html")==1 ? "checked" : "").'" /></td>';
	echo '</tr><tr>';
	echo '  <th scope="row">No Generator info on an ATOM page</th>';
	echo '  <td><input type="checkbox" name="no_generator_metatag_atom" value="1" '.(get_option("no_generator_metatag_atom")==1 ? "checked" : "").'" /></td>';
	echo '</tr><tr>';
	echo '  <th scope="row">No Generator info on a RSS2 page</th>';
	echo '  <td><input type="checkbox" name="no_generator_metatag_rss2" value="1" '.(get_option("no_generator_metatag_rss2")==1 ? "checked" : "").'" /></td>';
	echo '</tr><tr>';
	echo '  <th scope="row">No Generator info on a RDF page</th>';
	echo '  <td><input type="checkbox" name="no_generator_metatag_rdf" value="1" '.(get_option("no_generator_metatag_rdf")==1 ? "checked" : "").'" /></td>';
	echo '</tr><tr>';
	echo '  <th scope="row">No Generator info on a comment page</th>';
	echo '  <td><input type="checkbox" name="no_generator_metatag_comment" value="1" '.(get_option("no_generator_metatag_comment")==1 ? "checked" : "").'" /></td>';
	echo '</tr><tr>';
	echo '  <th scope="row">No Generator info on a "export" file</th>';
	echo '  <td><input type="checkbox" name="no_generator_metatag_export" value="1" '.(get_option("no_generator_metatag_export")==1 ? "checked" : "").'" /></td>';
	echo '</tr>';
	echo '</table>';
	settings_fields("update-options_no_generator_metatag");
	echo '  <p class="submit">';
  echo '    <input type="submit" class="button-primary" value="'.__('Save Changes').'" />';
	echo '  </p>';	
  echo '</form>';
	echo '</div>';
}

/**
 * @ return void
*/
function no_generator_metatag_admin_menu(){
  add_options_page('Remove Generator', 'Remove Generator', '10', 'no_generator_metatag', 'no_generator_metatag_options');
}

/**
 * @ return string
*/
function no_generator_metatag($generator){
  return '';
}

/**
 * @ return void
*/
function no_generator_metatag_remove_filters(){
	if (get_option("no_generator_metatag_xhtml")==1){
    add_filter("get_the_generator_xhtml","no_generator_metatag");
  }
	if (get_option("no_generator_metatag_html")==1){
    add_filter("get_the_generator_html","no_generator_metatag");
  }
	if (get_option("no_generator_metatag_atom")==1){
    add_filter("get_the_generator_atom","no_generator_metatag");
  }
	if (get_option("no_generator_metatag_rss2")==1){
    add_filter("get_the_generator_rss2","no_generator_metatag");
  }
	if (get_option("no_generator_metatag_rdf")==1){
    add_filter("get_the_generator_rdf","no_generator_metatag");
	}
	if (get_option("no_generator_metatag_comment")==1){
    add_filter("get_the_generator_comment","no_generator_metatag");
	}
	if (get_option("no_generator_metatag_export")==1){
    add_filter("get_the_generator_export","no_generator_metatag");
	}
}

function activate_no_generator_metatag(){
  //For future releases
}
function deactive_no_generator_metatag(){
  //For future releases
}

function no_generator_metatag__mysettings(){
  register_setting( 'update-options_no_generator_metatag', 'no_generator_metatag_xhtml' );
  register_setting( 'update-options_no_generator_metatag', 'no_generator_metatag_html' );
	register_setting( 'update-options_no_generator_metatag', 'no_generator_metatag_atom' );
	register_setting( 'update-options_no_generator_metatag', 'no_generator_metatag_rss2' );
	register_setting( 'update-options_no_generator_metatag', 'no_generator_metatag_rdf' );
	register_setting( 'update-options_no_generator_metatag', 'no_generator_metatag_comment' );
	register_setting( 'update-options_no_generator_metatag', 'no_generator_metatag_export' );	
}

register_activation_hook(__FILE__, 'activate_no_generator_metatag');
register_deactivation_hook(__FILE__, 'deactive_no_generator_metatag');

if (is_admin()) {
  add_action('admin_menu', 'no_generator_metatag_admin_menu');
	add_action( 'admin_init', 'no_generator_metatag__mysettings' );
}
if (!is_admin()) {
  add_action("init","no_generator_metatag_remove_filters");
}
?>
