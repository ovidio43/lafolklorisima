<?php 
/*
* template name: tour map
*/
get_header(); ?>

<section class="main-content home-news">
  <nav class="nav-tour">
    <ul>
      <li><a href="/events/">CURRENT TOURS & EVENTS </a></li>
      <li><a href="/tour-map/"  class="active">TOUR MAP</a> </li>
    </ul>
    <form class="search-form" method="get" action="#"><input type="text" value="" placeholder="Search By Year Or City" name="filter"> <input type="submit" value="submit"> </form>
  </nav>
  <div id="content-wrapper">
    <div id='map' class='map' style="width=100%; height:600px;"></div>
  </div>
</section>

<?php get_footer(); ?>