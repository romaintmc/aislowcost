function distance(lat1, lon1, lat2, lon2, unit) {
	if ((lat1 == lat2) && (lon1 == lon2)) {
		return 0;
	}
	else {
		var radlat1 = Math.PI * lat1/180;
		var radlat2 = Math.PI * lat2/180;
		var theta = lon1-lon2;
		var radtheta = Math.PI * theta/180;
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		if (dist > 1) {
			dist = 1;
		}
		dist = Math.acos(dist);
		dist = dist * 180/Math.PI;
		dist = dist * 60 * 1.1515;
		if (unit=="K") { dist = dist * 1.609344 }
		if (unit=="N") { dist = dist * 0.8684 }
		return dist.toFixed(2);
	}
}

function angleFromCoordinate(lat1, log1, lat2, lon2) {

    var radlat1 = Math.PI * lat1/180;
    var radlat2 = Math.PI * lat2/180;
    var radlon1 = Math.PI * lon1/180;
    var radlon2 = Math.PI * lon2/180;
    var dLon = radlon2 - radlon1;

    var y = Math.sin(dLon) * Math.cos(radlat2);
    var x = Math.cos(radlat1) * Math.sin(radlat2) - Math.sin(radlat1) * Math.cos(radlat2) * Math.cos(dLon);

    var brng = Math.atan2(y, x);

    brng = brng * 180 / Math.PI;
    brng = fmod(brng + 360, 360);

    return brng;
}

function fmod (x, y) {
  //  discuss at: https://locutus.io/php/fmod/
  // original by: Onno Marsman (https://twitter.com/onnomarsman)
  //    input by: Brett Zamir (https://brett-zamir.me)
  // bugfixed by: Kevin van Zonneveld (https://kvz.io)
  //   example 1: fmod(5.7, 1.3)
  //   returns 1: 0.5

  var tmp
  var tmp2
  var p = 0
  var pY = 0
  var l = 0.0
  var l2 = 0.0

  tmp = x.toExponential().match(/^.\.?(.*)e(.+)$/)
  p = parseInt(tmp[2], 10) - (tmp[1] + '').length
  tmp = y.toExponential().match(/^.\.?(.*)e(.+)$/)
  pY = parseInt(tmp[2], 10) - (tmp[1] + '').length

  if (pY > p) {
    p = pY
  }

  tmp2 = (x % y)

  if (p < -100 || p > 20) {
    // toFixed will give an out of bound error so we fix it like this:
    l = Math.round(Math.log(tmp2) / Math.log(10))
    l2 = Math.pow(10, l)

    return (tmp2 / l2).toFixed(l - p) * l2
  } else {
    return parseFloat(tmp2.toFixed(-p))
  }
}