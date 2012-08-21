<?php
function cvc_len_sort($a,$b){ return strlen($b)-strlen($a); }
function cvc_filter_plural($s,$b) { return ! ( $s == $b.'s' ); }

//usort($array,'cvc_len_sort');

$cvc_sections = array(
	'discover' => array(
		'slug' => 'discover',
		'single_string' => 'discover'
	),
	'distribute' => array(
		'slug' => 'distribute',
		'single_string' => implode('|',array('distribute','share'))
	),
	'discuss' => array(
		'slug' => 'discuss',
		'single_string' => 'discuss'
	),
	'decide' => array(
		'slug' => 'decide',
		'single_string' => implode('|',array('decide','vote'))
	),
	'demand' => array(
		'slug' => 'demand',
		'single_string' => implode('|',array('demand'))
	),
	'api' => array(
		'slug' => 'api',
		'single_string' => implode('|',array('api')),
		'additional' => array('types','sources',':type',':type/:source'),
		'after' => array('key/:key')
	),
	'data' => array(
		'slug' => 'api',
		'single_string' => 'data',
		'additional' => array('types','sources',':type',':type/:source'),
		'after' => array('key/:key')
	)
);
$cvc_objects  = array(
	'law' => array(
		'slug' => 'law',
		'sections' => array('discover','distribute','discuss','api','data'),
		'general' => array('index','popular','latest','status','search'),
		'single' => array('summary','status','text'),
		'single_sections' => array('discover','distribute','discuss','api','data'),
		'filters' => array('locale','theme','tag'),
		'related' => array('law','bill','motion','legislator','committee'),
		'single_string' => implode('|',array('law','l')),
		'plural_string' => implode('|',array('laws','law','l')),
	),
	'bill' => array(
		'slug' => 'bill',
		'sections' => array('discover','distribute','discuss','decide','demand','api','data'),
		'general' => array('index','popular','latest','status','search'),
		'single' => array('summary','status','text'),
		'single_sections' => array('discover','distribute','discuss','decide','demand','api','data'),
		'filters' => array('locale','theme','tag'),
		'related' => array('law','bill','motion','brief','legislator','committee'),
		'single_string' => implode('|',array('bill','b')),
		'plural_string' => implode('|',array('bills','bill','b')),
	),
	'motion' => array(
		'slug' => 'motion',
		'sections' => array('discover','distribute','discuss','decide','demand','api','data'),
		'general' => array('index','popular','latest','status','search'),
		'single' => array('summary','status','text'),
		'single_sections' => array('discover','distribute','discuss','decide','demand','api','data'),
		'filters' => array('locale','theme','tag'),
		'related' => array('law','bill','motion','brief','legislator','committee'),
		'single_string' => implode('|',array('motion','m')),
		'plural_string' => implode('|',array('motions','motion','m')),
	),
	'brief' => array(
		'slug' => 'brief',
		'sections' => array('discover','distribute','discuss','decide','api','data'),
		'general' => array('index','popular','latest','status','search'),
		'single' => array('summary','status','text'),
		'single_sections' => array('discover','distribute','discuss','decide','api','data'),
		'filters' => array('locale','theme','tag'),
		'related' => array('law','bill','motion','brief','legislator','committee'),
		'single_string' => 'brief',
		'plural_string' => implode('|',array('briefs','brief')),
	),
	'legislator' => array(
		'slug' => 'legislator',
		'sections' => array('discover','distribute','discuss','demand','api','data'),
		'general' => array('index','popular','latest','status','search'),
		'single' => array('summary','status','text'),
		'single_sections' => array('discover','distribute','discuss','demand','api','data'),
		'filters' => array('locale','theme','tag'),
		'related' => array('law','bill','motion','brief','legislator','committee'),
		'single_string' => implode('|',array('legislator','representative','senator')),
		'plural_string' => implode('|',array('legislator','representative','senator','rep','sen','leg')),
	),
	'committee' => array(
		'slug' => 'committee',
		'sections' => array('discover','distribute','discuss','demand','api','data'),
		'general' => array('index','popular','latest','status','search'),
		'single' => array('summary','status','text'),
		'single_sections' => array('discover','distribute','discuss','demand','api','data'),
		'filters' => array('locale','theme','tag'),
		'related' => array('law','bill','motion','brief','legislator','committee'),
		'single_string' => implode('|',array('committee','c')),
		'plural_string' => implode('|',array('committees','committee','c')),
	),
	'group' => array(
		'slug' => 'group',
		'sections' => array('discover','distribute','discuss','decide','demand','api','data'),
		'general' => array('index','popular','latest','status','search'),
		'single' => array('summary','status','text'),
		'single_sections' => array('discover','distribute','discuss','decide','demand','api','data'),
		'related' => array('law','bill','motion','brief','legislator','committee'),
		'filters' => array('locale','theme','tag'),
		'single_string' => implode('|',array('group','g')),
		'plural_string' => implode('|',array('groups','group','g')),
	)
);

$cvc_routes = array();
foreach($cvc_sections as $cvc_section){
	$cvc_routes[$cvc_section['single_string'].''] = 'civicality/'.$cvc_section['slug'].'/index';
	if(isset($cvc_section['after'])){
		foreach($cvc_section['after'] as $cvc_single_after){
			$cvc_routes[$cvc_section['single_string'].'/'.$cvc_single_after] = 'civicality/'.$cvc_section['slug'].'/index';
		}
	}
	if(isset($cvc_section['additional'])){
		foreach($cvc_section['additional'] as $cvc_section_additional){
			$cvc_routes[$cvc_section['single_string'].'/'.$cvc_section_additional] = 'civicality/'.$cvc_section['slug'].'/index';
			if(isset($cvc_section['after'])){
				foreach($cvc_section['after'] as $cvc_single_after){
					$cvc_routes[$cvc_section['single_string'].'/'.$cvc_section_additional.'/'.$cvc_single_after] = 'civicality/'.$cvc_section['slug'].'/index';
				}
			}
		}
	}
}
foreach($cvc_objects as $cvc_object){
	$cvc_routes[$cvc_object['plural_string']] = 'civicality/'.$cvc_object['slug'].'/index';
	$cvc_routes[$cvc_object['single_string'].'/:slug'] = 'civicality/'.$cvc_object['slug'].'/single';
	foreach($cvc_object['single_sections'] as $cvc_single_section){
		$cvc_routes[$cvc_object['single_string'].'/:slug/'.$cvc_sections[$cvc_single_section]['single_string']] = 'civicality/'.$cvc_object['slug'].'/'.$cvc_sections[$cvc_single_section]['slug'].'/index';
		if(isset($cvc_sections[$cvc_single_section]['additional'])){
			foreach($cvc_sections[$cvc_single_section]['additional'] as $cvc_section_additional){
				$cvc_routes[$cvc_object['single_string'].'/:slug/'.$cvc_single_section.'/'.$cvc_section_additional] = 'civicality/'.$cvc_object['slug'].'/'.$cvc_sections[$cvc_single_section]['slug'].(stristr($cvc_section_additional, ':') !== false ? '/index' : '/'.$cvc_section_additional);
			}
		}
	}
}
$cvc_offset = 0;
//echo '<pre>'.print_r($cvc_sections,true).'</pre>';
foreach($cvc_objects as $cvc_object){
	//if($cvc_offset++ >= 1) continue;
	foreach($cvc_object['sections'] as $cvc_section_slug => $cvc_section){
		$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string']] = array(
			'civicality/'.$cvc_object['slug'].'/index',
			'context' => $cvc_sections[$cvc_section]['slug']
		);
		foreach($cvc_object['general'] as $cvc_general_section){
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/'.$cvc_general_section] = array(
				'civicality/'.$cvc_object['slug'].'/'.$cvc_sections[$cvc_section]['slug'].'/'.$cvc_general_section,
				'context' => $cvc_sections[$cvc_section]['slug']
			);
		}
		foreach($cvc_object['filters'] as $cvc_filter){
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter] = array(
				'civicality/'.$cvc_object['slug'].'/filter/'.$cvc_filter.'/index',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/index'] = array(
				'civicality/'.$cvc_object['slug'].'/filter/'.$cvc_filter.'/index',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/search'] = array(
				'civicality/'.$cvc_object['slug'].'/filter/'.$cvc_filter.'/search',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/all'] = array(
				'civicality/'.$cvc_object['slug'].'/filter/'.$cvc_filter.'/all',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/request'] = array(
				'civicality/'.$cvc_object['slug'].'/filter/'.$cvc_filter.'/request',
				'context' => $cvc_sections[$cvc_section]['slug']
			);

			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/:slug'] = array(
				'civicality/filter/'.$cvc_filter.'/'.$cvc_object['slug'].'/index',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/:slug/index'] = array(
				'civicality/filter/'.$cvc_filter.'/'.$cvc_object['slug'].'/index',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/:slug/all'] = array(
				'civicality/filter/'.$cvc_filter.'/'.$cvc_object['slug'].'/all',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/:slug/latest'] = array(
				'civicality/filter/'.$cvc_filter.'/'.$cvc_object['slug'].'/latest',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['plural_string'].'/by-'.$cvc_filter.'/:slug/popular'] = array(
				'civicality/filter/'.$cvc_filter.'/'.$cvc_object['slug'].'/popular',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
		}
		$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['single_string']] = array(
			'civicality/'.$cvc_object['slug'].'/index',
			'context' => $cvc_sections[$cvc_section]['slug']
		);
		foreach($cvc_object['single'] as $cvc_single_action){
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['single_string'].'/:slug/'.$cvc_single_action] = array(
				'civicality/'.$cvc_object['slug'].'/'.$cvc_single_action,
				'context' => $cvc_sections[$cvc_section]['slug']
			);
		}
		foreach($cvc_object['single_sections'] as $cvc_single_section){
			$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['single_string'].'/:slug/'.$cvc_single_section] = array(
				'civicality/'.$cvc_object['slug'].'/'.$cvc_sections[$cvc_single_section]['slug'].'/index',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
			if(isset($cvc_sections[$cvc_section]['after'])){
				/*foreach($cvc_sections[$cvc_section])
				$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['single_string'].'/:slug/'.$cvc_single_section] = array(
					'civicality/'.$cvc_object['slug'].'/'.$cvc_sections[$cvc_single_section]['slug'],
					'context' => $cvc_sections[$cvc_section]['slug']
				);*/	
			}
			if(isset($cvc_sections[$cvc_single_section]['additional'])){
				foreach($cvc_sections[$cvc_single_section]['additional'] as $cvc_section_additional){
					$cvc_routes[$cvc_sections[$cvc_section]['single_string'].'/'.$cvc_object['single_string'].'/:slug/'.$cvc_sections[$cvc_single_section]['single_string'].'/'.$cvc_section_additional] = array(
						'civicality/'.$cvc_object['slug'].'/'.$cvc_sections[$cvc_single_section]['slug'].'/index',
						'context' => $cvc_sections[$cvc_section]['slug']
					);
				}
			}
		}
		$cvc_routes[$cvc_section.'/'.$cvc_object['single_string'].'/:slug/related'] = array(
			'civicality/'.$cvc_object['slug'].'/related/index',
			'context' =>$cvc_sections[$cvc_section]['slug']
		);
		foreach($cvc_object['related'] as $cvc_related_object){
			$cvc_routes[$cvc_section.'/'.$cvc_object['single_string'].'/:slug/related/'.$cvc_objects[$cvc_related_object]['plural_string']] = array(
				'civicality/'.$cvc_object['slug'].'/related/'.$cvc_objects[$cvc_related_object]['slug'].'/index',
				'context' => $cvc_sections[$cvc_section]['slug']
			);
		}
	}
}


$to_return = array_merge(
	array(
		'_root_'  => 'civicality/index',
		'_404_'   => 'civicality/404',
		'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	),
	$cvc_routes,
	array(

	)
);
echo '<strong>'.count($to_return).'</strong><br />';
echo '<pre>'.print_r($to_return,true).'</pre>';
die();
return $to_return;