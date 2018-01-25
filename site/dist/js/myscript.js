  $("#logout").click(function(){
  cname="loggedIn";
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0){
          document.cookie = "loggedIn=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
        }
        window.location.assign("index.php")
  }
});

$("#insertEvent").click(function(){
  $("#waiting").show();
	var name = $("#eventTitle").val();
	var descr = $("#eventDescription").val();
	var attr = $("#eventAttraction option:selected").val();
	var date = $("#datepicker").val();
	var parts =date.split('/');
	var time = convertTo24Hour($("#timepicker").val().toLowerCase());
    $.ajax({
          type: "POST",
          url: "add_event.php",
          data: "name="+name+"&descr="+descr+"&attr="+attr+"&date="+parts[2]+"-"+parts[0]+"-"+parts[1]+" "+time,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
          }
          });
});

$("#updateEvent").click(function(){
  $("#waiting").show();
  var id = $("#id").text();
	var name = $("#eventTitle").val();
	var descr = $("#eventDescription").val();
	var attr = $("#eventAttraction option:selected").val();
	var date = $("#datepicker").val();
	var parts =date.split('/');
	var time = convertTo24Hour($("#timepicker").val().toLowerCase());
	
	
    $.ajax({
          type: "POST",
          url: "update_event.php",
          data: "id="+id+"&name="+name+"&descr="+descr+"&attr="+attr+"&date="+parts[2]+"-"+parts[0]+"-"+parts[1]+" "+time,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
			window.location.assign("events.php")
          }
          });
});

$(".delete").click(function(){
  $("#waiting").show();
	var id = $(this).attr("value");
  var tabella = $(this).attr("name");
    $.ajax({
          type: "POST",
          url: "delete.php",
          data: "id="+id+"&tabella="+tabella,
          dataType: "html",
          error: function(msg){
            $("#waiting").hide();
            $("#errorAjax").show();
          },
           success: function(msg) {
             location.reload();
           }
          });
});

$("#insertRestaurant").click(function(){
  $("#waiting").show();
	var name = $("#restaurantName").val();
	var descr = $("#restaurantDescription").val();
	var phone = $("#restaurantPhone").val();
	var img = $("#restaurantInputFile").get(0).files[0];
	var folder = 'restaurant';
	addImage(img,folder,name);
    $.ajax({
          type: "POST",
          url: "add_restaurant.php",
          data: "name="+name+"&descr="+descr+"&phone="+phone,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
          }
    });
});

$("#updateRestaurant").click(function(){
  $("#waiting").show();
  var id = $("#id").text();
	var name = $("#restaurantName").val();
	var descr = $("#restaurantDescription").val();
	var tel = $("#restaurantPhone").val();
	if($("#restaurantInputFile").get(0).files.length === 0){
		var img = $("#oldPic").text();
		var datas = "id="+id+"&name="+name+"&descr="+descr+"&phone="+tel+"&img="+img;
	} else {
		var datas = "id="+id+"&name="+name+"&descr="+descr+"&phone="+tel;
		var img = $("#restaurantInputFile").get(0).files[0];
		var folder = 'restaurant';
		addImage(img,folder,name);
	}
	
	
    $.ajax({
          type: "POST",
          url: "update_restaurant.php",
          data: datas,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
			window.location.assign("restaurants.php")
          }
          });
});

$("#insertHotel").click(function(){
  $("#waiting").show();
	var name = $("#hotelName").val();
	var descr = $("#hotelDescription").val();
	var tel = $("#hotelTel").val();
	var dist = $("#hotelDist").val();
	var img = $("#hotelInputFile").get(0).files[0];
	var folder = 'hotel';
	addImage(img,folder,name);
    $.ajax({
          type: "POST",
          url: "add_hotel.php",
          data: "name="+name+"&descr="+descr+"&tel="+tel+"&dist="+dist,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
          }
          });
});

$("#updateHotel").click(function(){
  $("#waiting").show();
  var id = $("#id").text();
	var name = $("#hotelName").val();
	var descr = $("#hotelDescription").val();
	var tel = $("#hotelTel").val();
	var dist = $("#hotelDist").val();
	if($("#hotelInputFile").get(0).files.length === 0){
		var img = $("#oldPic").text();
		var datas = "id="+id+"&name="+name+"&descr="+descr+"&tel="+tel+"&dist="+dist+"&img="+img;
	} else {
		var datas = "id="+id+"&name="+name+"&descr="+descr+"&tel="+tel+"&dist="+dist;
		var img = $("#hotelInputFile").get(0).files[0];
		var folder = 'hotel';
		addImage(img,folder,name);
	}
	
	
    $.ajax({
          type: "POST",
          url: "update_hotel.php",
          data: datas,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
			window.location.assign("hotels.php")
          }
          });
});

$("#insertPhoto").click(function(){
  $("#waiting").show();
	var utente = $("#photoUser").val();
	var attraz = $("#photoAttraction").val();
	var id = utente+attraz;
	var img = $("#photoInputFile").get(0).files[0];
	var folder = 'users';
	addImage(img,folder,id);
    $.ajax({
          type: "POST",
          url: "add_foto.php",
          data: "utente="+utente+"&attraz="+attraz,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
          }
    });
});

$("#updateAttraction").click(function(){
  $("#waiting").show();
	var id = $("#id").text();
	var name = $("#attractionName").val();
	var descr = $("#attractionDescription").val();
	var alt = $("#attractionAlt").val();
	var eta = $("#attractionEta").val();
	var anno = $("#attractionYear").val();
	var tempo = $("#attractionWait").val();
	var beacon = $("#attractionBeacon").val();
	if($("#attractionInputFile").get(0).files.length === 0){
		var img = $("#oldPic").text();
		var datas = "id="+id+"&name="+name+"&descr="+descr+"&alt="+alt+"&eta="+eta+"&anno="+anno+"&tempo="+tempo+"&beacon="+beacon+"&img="+img;
	} else {
		var datas = "id="+id+"&name="+name+"&descr="+descr+"&alt="+alt+"&eta="+eta+"&anno="+anno+"&tempo="+tempo+"&beacon="+beacon;
		var img = $("#attractionInputFile").get(0).files[0];
		var folder = 'attraction';
		addImage(img,folder,name);
	}
    $.ajax({
          type: "POST",
          url: "update_attraction.php",
          data: datas,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
			window.location.assign("attractions.php")
          }
    });
});

$("#insertAttraction").click(function(){
  $("#waiting").show();
	var name = $("#attractionName").val();
	var descr = $("#attractionDescription").val();
	var alt = $("#attractionAlt").val();
	var eta = $("#attractionEta").val();
	var anno = $("#attractionYear").val();
	var tempo = $("#attractionWait").val();
	var beacon = $("#attractionBeacon").val();
	var img = $("#attractionInputFile").get(0).files[0];
	var folder = 'attraction';
	addImage(img,folder,name);
    $.ajax({
          type: "POST",
          url: "add_attraction.php",
          data: "name="+name+"&descr="+descr+"&alt="+alt+"&eta="+eta+"&anno="+anno+"&tempo="+tempo+"&beacon="+beacon,
         dataType: "html",
         error: function(msg){
           $("#waiting").hide();
           $("#errorAjax").show();
         },
          success: function(msg) {
            $("#waiting").hide();
            $("#successAjax").show();
          }
    });
});

function addImage(img,folder,name){
	var formData = new FormData();
	formData.append('file',img);
	formData.append('folder',folder);
	formData.append('name',name);
	$.ajax({
          type: "POST",
          url: "add_image.php",
          data: formData,
		  processData: false,
		  contentType: false,
		  cache: false,
          success: function(msg) {
          }
          });
}

function convertTo24Hour(time) {
    var hours = parseInt(time.substr(0, 2));
    if(time.indexOf('am') != -1 && hours == 12) {
        time = time.replace('12', '0');
    }
    if(time.indexOf('pm')  != -1 && hours < 12) {
        time = time.replace(hours, (hours + 12));
    }
    return time.replace(/( am| pm)/, '');
}
