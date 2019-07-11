<?php
//Get the office contact number of User / Author / Agents
function get_author_office_number($epl_author='') {
	if(empty($epl_author))
		global $epl_author;
	$office_no = get_the_author_meta ('epl_user_office',$epl_author->author_id );
  return $office_no;
}
