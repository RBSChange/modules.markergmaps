<?php
/**
 * @author michal.olexa
 * @date 25 juin 08
 */
abstract class GmapsConstants
{
	const EARTH_RADIUS_KM = 6371;
	const EARTH_RADIUS_MILES = 3959;
	
	const MIN_NEAREST_MARKER_COUNT = 1;
	const MAX_NEAREST_MARKER_COUNT = 100;
	const MAX_NEAREST_MARKER_DISTANCE = 25;
	
	const LAT_PARAM_NAME = 'lat';
	const LNG_PARAM_NAME = 'lng';
	const MAX_DISTANCE_PARAM_NAME = 'maxdistance';
	const MAX_COUNT_PARAM_NAME = 'maxcount';
	const MIN_COUNT_PARAM_NAME = 'mincount';
	const MODELNAME_PARAM_NAME = 'modelname';
	
}