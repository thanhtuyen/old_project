/**
 * Created by thinhnh on 5/28/15.
 * Nursery input and update page
 */


/**
 * ThinhNH
 * Get lon, lat and station list near this address
 * @param address
 * @return array
 */
function getLonLatByAddress(address){
    var postData = {
        address : address
    };
    postData[csrf_token_name] = csrf_token_value;
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'client/ajax/get_lon_lat_by_address',
        async: false,
        dataType: 'json',
        data: postData,
        success: function(res) {
            if(res["code"] === 1){

                // set lon,lat to hidden input
                $("#lon").val(res['point'].lon);
                $("#lat").val(res['point'].lat);

                //display list stations
                showStationList(res['list_stations']);
            }else if(res["code"] === 0){
                result = 8;
                alert("住所を正しく入力するか空欄にしてください。");
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            result = 9;
        }
    });
}

function getMoreStationNearNursery(){
    var lon = $("#lon").val();
    var lat = $("#lat").val();
    if (lon=="" || lat == ""){
        alert("「付近の駅を表示する」ボタンを先に押してください。");
        return false;
    }
    var postData = {
        lon: lon,
        lat: lat
    };
    postData[csrf_token_name] = csrf_token_value;
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'client/ajax/get_more_station_near_point',
        async: false,
        dataType: 'json',
        data: postData,
        success: function(res) {
            if(res["code"] === 1){

                //display list stations
                showStationList(res['list_stations']);

            }else if(res["code"] === 0){
                result = 8;

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            result = 9;
        }
    });

}

/**
 * ThinhNH
 * show station list
 * @param stationList
 */
function showStationList(stationList){

    var template = '<div class="station-item" style="width: 90%">  ' +
        '<input type="hidden" name ="stations[{stationId}][station_id]" value="{stationId}" />' +
        '<input type="checkbox" class="station-main-check" name="stations[{stationId}][is_main]" value="1">{stationName}  ' +
        '<div class="flipswitch" ><div class="either">' +
        '<input type="radio" id="dummy_{stationId}_0" name="stations[{stationId}][display]" value="1">' +
        '<label data-label="表示" for="dummy_{stationId}_0">表示</label>' +
        '<input type="radio" id="dummy_{stationId}_1" name="stations[{stationId}][display]" checked="true" value="0">' +
        '<label data-label="非表示" for="dummy_{stationId}_1">非表示</label>' +
        '</div> </div> </div>';
    $("#station-container").html('');
    /*$("#description").html('');
    $("#description").append('<input type="checkbox" disabled checked />をいれたものがメインの駅となります。');*/
    for(var i=0; i<stationList.length; i++){
        var station = stationList[i];
        var html = template.replace(/{stationId}/g, station.station_id)
            .replace(/{stationName}/,station.station_name + " ( " + station.line_name_h + " ) ");
        $("#station-container").append(html);
    }

    // Bind event to checkbox again when added new elements
    bindCheckEventToStationMainCheckbox();
}

/**
 * ThinhNH
 * Bind click event to all checkbox of station
 * Only one station checked by user
 */
function bindCheckEventToStationMainCheckbox(){
    $(".station-main-check").unbind('click').click(function(){
        if ($(this).is(":checked")){
            $(".station-main-check").attr('checked',false);
            $(this).attr('checked',true);
        }
    });
}

/**
 * ThinhNH
 * Get full address from user input
 * @returns {string}
 */
function getFullAddressInput(){
    var prefecture = $("#pref_id option:selected").text();
    var city = $("#city_select_list option:selected").text();
    var address = $("#address").val();
    if (prefecture != "" && city != "" ){
        return address + " " + prefecture + " " + city ;
    }
    return "";
}


$(document).ready(function(){

    //set get point event
    $("#get-point").click(function(){
        var fullAddress = getFullAddressInput();
        if (fullAddress !=""){
            getLonLatByAddress(fullAddress);
        }
    });

    $("#get-more-station").click(function(){
        getMoreStationNearNursery();
    });

    // bind to station check box event if in edit page
    bindCheckEventToStationMainCheckbox();
});