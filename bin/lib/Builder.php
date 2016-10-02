<?php

function gText($value) {
	return $value;
}

function gRow($value) {
	return '<div class="row">'.$value.'</div>';
}
function gCol($size1, $size2, $size3, $value) {
	return '<div class="col-sm-'.$size1.' col-md-'.$size2.' col-lg-'.$size3.'">'.$value.'</div>';
}
function gPanel($title, $info, $body, $footer) {
	$return = '<div class="panel panel-default panel-bordered">';

	if(strlen($title) > 0)
		if(strlen($info) > 0)
			$return .= '<div class="panel-heading"><h5 class="panel-title">'.$title.'</h5>'.$info.'</div>';
		else
			$return .= '<div class="panel-heading"><h5 class="panel-title">'.$title.'</h5></div>';
	if(strlen($body) > 0)
		$return .= '<div class="panel-body">'.$body.'</div>';
	if(strlen($footer) > 0)
		$return .= '<div class="panel-footer">'.$footer.'</div>';

	$return .= '</div>';
	return $return;
}

function gInput($id, $type = "text", $title = "", $value = "", $placeholder = "") {
	if($title != null)
		return $title.':<br><input name="'.$id.'" id="'.$id.'" type="'.$type.'" class="form-control" value="'.$value.'" placeholder="'.$placeholder.'">';
	else
		return '<input name="'.$id.'" id="'.$id.'" type="'.$type.'" class="form-control" value="'.$value.'" placeholder="'.$placeholder.'">';
}

function gButton($id, $color, $value, $target, $onclick, $block, $disabled) {
	$return = '<a id="'.$id.'"';
	if($target != null)
		$return .= ' href="'.$target.'"';
	$return .= ' class="btn bg-'.$color.'';
	if($block) $return .= ' btn-block';
	$return .= '"';
	if($disabled) $return .= ' disabled="disabled"';
	$return .= ' onClick="'.$onclick.'">'.$value.'</a>';
	return $return;
}

function gBox($color, $link, $title, $description, $button) {
	return '
	<div class="col-sm-4 col-md-4 col-lg-2">
		<div class="panel panel-body border-top-'.$color.' text-center">
			<h6 class="no-margin text-semibold">'.$title.'</h6>
			<p class="text-muted content-group-sm">'.$description.'</p>
		    <a href="'.$link.'" class="btn btn-'.$color.' btn-block">'.$button.'</a>
		</div>
	</div>	
	';
}

function gIconDropDown($id = "icon_dropdown", $main_icon = "menu9", $data = null) {
	if($main_icon == null)
		$main_icon = "menu9";
		
	$return = '<ul class="icons-list" id="'.$id.'">';
	$return .= '<li class="dropdown">';
	$return .= '<a class="dropdown-toggle" data-toggle="dropdown">';
	$return .= '<i class="icon-'.$main_icon.'"></i>';
	$return .= '</a>';
	$return .= '<ul class="dropdown-menu dropdown-menu-right">';
		
	for($x = 0; $x < sizeof($data); $x++)
		if(sizeof($data[$x]) == 3)
			$return .= '<li><a href="'.$data[$x][0].'"><i class="icon-'.$data[$x][1].'"></i>'.$data[$x][2].'</a></li>';
		
	$return .= '</ul>';
	$return .= '</li>';
	$return .= '</ul>';
	return $return;
}
function gLabel($id, $color, $title) {
	return '<span id="'.$id.'" class="label label-'.$color.'">'.$title.'</span>';
}
function gDataTable($id, $title, $desc, $columns, $data) {
	$return = '<div class="panel panel-flat" id="'.$id.'_1">';
	$return .= '<div class="panel-heading" id="'.$id.'_2">';
	
	if(strlen($title) > 0)
		$return .= '<h5 class="panel-title" id="'.$id.'_3">'.$title.'</h5>';
		
	$return .= '
	<div class="heading-elements" id="'.$id.'_4">
		<ul class="icons-list">
	    	<li><a data-action="collapse"></a></li>
	    	<li><a data-action="reload"></a></li>
	    	<li><a data-action="close"></a></li>
	    </ul>
	</div>
	';
		
	$return .= '</div>';
		
	if(strlen($desc) > 0)
		$return .= '<div class="panel-body" id="'.$id.'_5">'.$desc.'</div>';
		
	if(sizeof($columns) > 0 || sizeof($data) > 0) {
		$return .= '<table class="table '.$id.'">';
		
		if(sizeof($columns) > 0) {
			$return .= '<thead>';
			$return .= '<tr>';
			
			for($x = 0; $x < sizeof($columns); $x++)
				if($columns[$x][2] == TRUE)
					$return .= '<th class="text-center" width="'.$columns[$x][0].'%">'.$columns[$x][1].'</th>';
				else
					$return .= '<th width="'.$columns[$x][0].'%">'.$columns[$x][1].'</th>';
			
			$return .= '</tr>';
			$return .= '</thead>';
		}
			
		if(sizeof($columns) > 0) {
			$return .= '<tbody>';	
				
			for($x = 0; $x < sizeof($data); $x++) {
				$return .= '<tr>';
				
				for($y = 0; $y < sizeof($data[$x]); $y++)
					if($columns[$y][2] == TRUE)
						$return .= '<th class="text-center" width="'.$columns[$y][0].'%">'.$data[$x][$y].'</th>';
					else
						$return .= '<th width="'.$columns[$y][0].'%">'.$data[$x][$y].'</th>';
			
				$return .= '</tr>';
			}
			
			$return .= '</tbody>';
		}
		
		$return .= '</table>';
	}
	
	$return .= '</div>';
	return $return;
}

function gSelection($id, $title, $data) {
	$return = '
	<div class="form-group">
		<label>'.$title.':</label>
		<div class="multi-select-full">
			<select id="'.$id.'" name="'.$id.'" class="multiselect" multiple="multiple">';
			
			for($x = 0; $x < sizeof($data); $x++)
				if($data[$x][2] == 1)
					$return .= '<option value="'.$data[$x][0].'" selected="selected">'.$data[$x][1].'</option>';
				else
					$return .= '<option value="'.$data[$x][0].'">'.$data[$x][1].'</option>';
			
	$return .= '
			</select>
		</div>
	</div>
	';
	return $return;
}

function gA($href, $title, $id = "", $class = "", $blank = false) {
	if($blank)
		return '<a href="'.$href.'" id="'.$id.'" class="'.$class.'" target="_blank">'.$title.'</a>';
	else
		return '<a href="'.$href.'" id="'.$id.'" class="'.$class.'">'.$title.'</a>';
}

?>