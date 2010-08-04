<?php 
/**
 * @subpackage	: Wordpress
 * @author		: Jonathon Byrd
 * @copyright	: All Rights Reserved, Byrd Inc. 2009
 * @link		: http://www.jonathonbyrd.com
 * 
 * Jonathon Byrd is a freelance developer for hire. Jonathon has owned many companies and
 * understands the importance of website credibility. Contact Jonathon Today.
 * 
 */ 


// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();

?>
<script src="http://maps.google.com/maps?file=api&v=2.x&key=<?php echo $this->api_key; ?>" type="text/javascript"></script>
<script type="text/javascript">
	var reinkes = "<?php echo $this->to_address; ?>";
	var map = null;
	var geocoder = null;

	window.addEvent('unload', function() { 
		GUnload();
	});
	window.addEvent('load', function() { 
		initialize();
		showAddress(reinkes);
		$('gmapbutton').addEvent('click', function(evt){
			getDirections();
		});
	});

	function initialize() {
		if (GBrowserIsCompatible()) {
			map = new GMap2(document.getElementById("map_canvas"));
			<?php if( !$this->G_HYBRID_MAP ) echo 'map.removeMapType(G_HYBRID_MAP);'; ?>
			<?php if( !$this->G_SATELLITE_MAP ) echo 'map.removeMapType(G_SATELLITE_MAP);'; ?>
			<?php if( !$this->G_NORMAL_MAP ) echo 'map.removeMapType(G_NORMAL_MAP);'; ?>
			
			map.addControl(new <?php echo $this->sizecontrol; ?>());
			map.addControl(new GMapTypeControl());

			map.setCenter(new GLatLng(37.4419, -122.1419), 8);		
			geocoder = new GClientGeocoder();
		}
	}
				
	function showAddress(address) {
		if (geocoder) {
			geocoder.getLatLng(
				address,
				function(point) {
					if (!point) {
						alert(address + " not found");
					} else {									
						var marker = new GMarker(point);
						map.addOverlay(marker);
						map.setCenter(point, 13);
						marker.openInfoWindowHtml(address);
					}
				}
			);
		}
	}

	function getDirections(address){
		dir = new GDirections(map, document.getElementById("directions"));
	        
		dir.load(address);
		setDirections(document.getElementById('map_address').value, reinkes, 'en'); 
		return false;
	}

	function setDirections(fromAddress, toAddress, locale) {
		dir.load("from: " + fromAddress + " to: " + toAddress, { "locale": locale });
	}
				
</script>