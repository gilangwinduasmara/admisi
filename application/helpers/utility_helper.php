<?php
if ( ! function_exists('asset_url()'))
{
  function asset_url()
  {
	 return base_url().'assets/';
  }
}

function last_segment($uri){
	$last = $uri->total_segments();
	$last_segment = $uri->segment($last);
	return $last_segment;
}
