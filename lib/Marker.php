<?php
interface markergmaps_Marker
{
	public function getLat();
	public function getLng();
	public function getMarkerInfo();
	public function getMarkerIcon();
}