<?php
/**w
 * @author michal.olexa
 * @date 25 juin 08
 */
class markergmaps_MarkerService extends BaseService
{

	/**
	 * Unique instance of the UrlRewritter
	 *
	 * @var website_UrlRewritingService.
	 */
	protected static $instance;

	/**
	 * Returns the unique instance of the markergmaps_MarkerService object. It is created if needed.
	 *
	 * @return markergmaps_MarkerService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getGmapsMarkerUrl($marker)
	{
		if(! $marker instanceof markergmaps_Marker)
		{
			throw new Exception("Document is not a marker");
		}

		$klmUrl = LinkHelper::getActionUrl('markergmaps', 'GetMarker', array(change_Request::DOCUMENT_ID => $marker->getId()));

		return GmapsHelper::getGoogleMapsUrl().'?q='.$klmUrl;
	}

	public function getGmapsItineraryUrl($marker)
	{
		if(! $marker instanceof markergmaps_Marker)
		{
			throw new Exception("Document is not a marker");
		}

		$destination = sprintf("%s @%f,%f",
			$marker->getLabel(),
			$marker->getLat(),
			$marker->getLng()
		);
		return GmapsHelper::getGoogleMapsUrl().'?daddr='.urlencode($destination);
	}

	public function getMarkerIconUrl($marker)
	{
		$model = str_replace('/', '_', $marker->getDocumentModelName());
		if(Framework::hasConfiguration('modules/markergmaps/marker/icon/'.$model))
		{
			$fileName = Framework::getConfiguration('modules/markergmaps/marker/icon/'.$model);
			return MediaHelper::getFrontofficeStaticUrl($fileName);
		}

		return null;
	}

	/**
	 * Return markers nearest to a given point (lat/lng).
	 * The markers up to $minCount are returned regardless their distance.
	 * The distance is measured in Km.
	 *
	 * @param String $modelName
	 * @param Float $lat
	 * @param Float $lng
	 * @param Integer $maxCount
	 * @param Integer $minCount
	 * @param Float $maxDistance
	 * @return array<markergmaps_Marker>
	 */
	public function getNearestMarkers($modelName, $lat, $lng, $maxCount = null, $minCount = null, $maxDistance = null)
	{
		if(is_null($maxCount))
		{
			$maxCount = GmapsConstants::MAX_NEAREST_MARKER_COUNT;
		}
		if(is_null($minCount))
		{
			$minCount = GmapsConstants::MIN_NEAREST_MARKER_COUNT;
		}
		if(is_null($maxDistance))
		{
			$maxDistance = GmapsConstants::MAX_NEAREST_MARKER_DISTANCE;
		}

		$pp = $this->getPersistentProvider();

		$markerTable = $pp->createQuery($modelName)
			->add(Restrictions::isNotNull('lat'))
			->add(Restrictions::isNotNull('lng'))
			->setProjection(Projections::property('id', 'id'))
			->setProjection(Projections::property('lat', 'lat'))
			->setProjection(Projections::property('lng', 'lng'))
			->find();

		$markerDistances = array();
		foreach($markerTable as &$markerRow)
		{
			$markerLat = $markerRow['lat'];
			$markerLng = $markerRow['lng'];
			$markerDistance =  $this->getHaversineDistance($lat, $lng, $markerLat, $markerLng);

			$markerDistances[$markerRow['id']] = $markerDistance;
		}

		asort($markerDistances, SORT_NUMERIC);

		$nearestMarkerDistances = array();
		$markerCount = 0;
		foreach($markerDistances as $markerId => $markerDistance)
		{
			if(($markerDistance < $maxDistance || $markerCount < $minCount) && $markerCount < $maxCount)
			{
				$nearestMarkerDistances[$markerId] = $markerDistance;
				$markerCount++;
			}
		}

		$markerIds = array_keys($nearestMarkerDistances);

		if(f_util_ArrayUtils::isEmpty($markerIds))
		{
			return array();
		}

		return $pp->createQuery($modelName)
			->add(Restrictions::in('id', $markerIds))
			->find();
	}

	/**
	 * Return distance between 2 points on Earth according to Harvesine formula
	 *
	 * @param Float $lat1
	 * @param Float $lng1
	 * @param Float $lat2
	 * @param Float $lng2
	 * @param Float $earthRadius
	 * @return Float
	 */
	protected final function getHaversineDistance($lat1, $lng1, $lat2, $lng2, $earthRadius = null)
	{
		if(is_null($earthRadius))
		{
			$earthRadius = GmapsConstants::EARTH_RADIUS_KM;
		}
		return $earthRadius * acos(cos(deg2rad($lat1) ) * cos( deg2rad($lat2)) * cos(deg2rad($lng1) - deg2rad($lng2)) + sin(deg2rad($lat1)) * sin(deg2rad($lat2)));
	}

}
