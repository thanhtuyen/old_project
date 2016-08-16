<!--<div id="{apiNameKey}" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">-->
<!--    <div class="panel-body">-->
<!--        <div class="method-{method}">-->
<!--            <h4>Method: {MethodName}</h4>-->
<!--            <p>Type: {methodType}</p>-->
<!--            <p>URL: <input class="form-control api-url-{apiNameKey}" value="{APIURL}" /> </p>-->
<!--            <h4>Post data:</h4>-->
<!--            <textarea class="form-control post-data-{apiNameKey}" >{dataString}</textarea>-->
<!---->
<!--            <h4>Result</h4>-->
<!--            <div class='result-{apiNameKey}'></div><br>-->
<!--            <button onclick="runApi('{apiNameKey}', '{method}')" class='btn btn-success'>Run</button>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</div>-->
<div id="city"></div>
<script src="/static/js/jquery-1.11.1.min.js"></script>
<script style="text/javascript">
    $( document ).ready(function() {
        $.ajax({
            "async": true, //cannot be false for JSONP
            "url": "/Cities/list?api_key=apikeysample&rec_company_id=1&token=&_=1443759429895&callback=?",
            jsonpCallback: 'jsonCallback',
            data: {city_id: 1},
            "dataType": 'jsonp',
            "method": "GET",
            "error": function (jqXHR, textStatus, errorThrown) {
                //included so you can see any errors
                console.log(textStatus + ': ' + errorThrown);
            },
            "success": function (data, textStatus, jqXHR) {
                //According to API documentation
                //data will not likely contain either Error, or Response
                //so, exists will likely not change to 0
                if (data.Error || data.Response) {
                    exists = 0;
                }
            }
        });
    });
//    $( document ).ready(){
//        $.ajax({
//            "async": true, //cannot be false for JSONP
//            "url": "/Cities/list?api_key=apikeysample&rec_company_id=1&token=&_=1443759429895",
//            "dataType": 'jsonp',
//            "method": "GET",
//            "error": function (jqXHR, textStatus, errorThrown) {
//                //included so you can see any errors
//                console.log(textStatus + ': ' + errorThrown);
//            },
//            "success": function (data, textStatus, jqXHR) {
//                //According to API documentation
//                //data will not likely contain either Error, or Response
//                //so, exists will likely not change to 0
//                if (data.Error || data.Response) {
//                    exists = 0;
//                }
//            }
//        });
//    }

</script>