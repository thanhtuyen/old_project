<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="utf-8">
	<script src="/static/js/jquery-1.11.1.min.js"></script>
	<script src="/static/js/EnjinApiCore.js"></script>
	<script src="/static/js/EnjinApiTest.js"></script>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">
	<title>check</title>
	<script type="text/javascript" >


		function getApiUrl(key, method){
			return $("#"+key).find('.method-'+method).find('.api-url-'+key).val();
		}

		function getData(key, method){
			return $("#"+key).find('.method-'+method).find('.post-data-'+key).val();
		}


		function replaceAll(find, replace, str) {
			return str.replace(new RegExp(find, 'g'), replace);
		}

		function runApi(key,method){
			var api = EnjinApi.getApi(key);
			var dataString = $("#"+key).find('.method-'+method).find('.post-data-'+key).val();
			var methodObject = api.methods[method];
			var data = false;
			if (dataString){
				data = JSON.parse(dataString);
				methodObject.setData(data);
			}

			EnjinApi.apiKey = $("#apikeysample").val();
			EnjinApi.companyId = $("#company-id").val();

			methodObject.setUrl(getApiUrl(key,method));
			methodObject.execute(function(res){
				$('.method-'+method +' .result-'+key).html("<pre><code>"+JSON.stringify(res, null, 2)+"</code></pre>");
				if (res.status==400 || res.status==500){
					try {
						var code = parseInt(res.responseJSON.code);
						$("#"+ key).parent().addClass("panel panel-warning");
					}catch (ex) {
						$("#"+ key).parent().addClass("panel panel-danger");
					}
				}else {
					$("#"+ key).parent().addClass("panel panel-success");
				}
			});
		}

		$(document).ready(function(){
			var template = $("#accordion").html();

			var methodTemplate = $("#accordion").find(".panel-body").html();
			$("#accordion").html('');
			for(var key in APIList){
				var apiObject = APIList[key];
                var apiObjectDataTest = APIListDataTest[key];
				var html = replaceAll('{APIName}', apiObjectDataTest.name, template);
				html = replaceAll('{apiNameKey}', key, html);
				var methodHtmlBody = '';
				for (j in apiObject.methods){
					var method = apiObject.methods[j];
                    var methodTest = apiObjectDataTest.methods[j];
					var subHtml = methodTemplate.replace('{methodType}', method.type);
					subHtml = subHtml.replace('{APIURL}', method.url);
					subHtml = subHtml.replace('{MethodName}', j);
					subHtml = subHtml.replace('{APIName}', apiObjectDataTest.name);
					subHtml = replaceAll('{apiNameKey}', key, subHtml);
					var dataPost = '';
					if (methodTest.data){
						dataPost = JSON.stringify(methodTest.data,null,2);
					}
					subHtml = subHtml.replace('{dataString}', dataPost);
					subHtml = replaceAll('{method}', j, subHtml);
					methodHtmlBody += subHtml;
				}
				html = $(html).clone();
				html.find('.panel-body').html(methodHtmlBody);

				$("#accordion").append(html);

			}
		});

		function checkAllApi(){
			for(var key in APIList){
				api = APIList[key];
				for(var method in api.methods){
					runApi(key, method);
				}
			}
		}

	</script>
</head>
<body>
<div class="container">
<h1>program check</h1>
<div class="panel" >
	<div class="row">
		<div class="col-md-2"><label for="apikeysample" >APIKey</label></div>
		<div class="col-md-2"><input id="apikeysample" class="form-control input-sm" value="apikeysample" /><br></div>
	</div>
	<div class="row">
		<div class="col-md-2"><label for="apikeysample" >Company ID</label></div>
		<div class="col-md-2">	<input id="company-id" class="form-control input-sm" value="1" /><br></div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-2">	<button class="btn-success btn" onclick="checkAllApi()">Check all APIs</button> </div>
		<div class="col-md-12" style="margin-top:20px; margin-bottom: 20px;" >
            <span class="bg-success" style="padding: 10px;">Response code 200</span>
            <span class="bg-danger" style="padding: 10px;">Framework Error</span>
            <span class="bg-warning" style="padding: 10px;">User Error</span>
		</div>
	</div>

</div>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingOne">
			<h3 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#{apiNameKey}" aria-expanded="true" aria-controls="collapseOne" style="font-size: 28px;font-weight: bold;">
					{APIName}
				</a>
			</h3>
		</div>
		<div id="{apiNameKey}" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
			<div class="panel-body">
				<div class="method-{method}">
					<h4>Method: {MethodName}</h4>
					<p>Type: {methodType}</p>
					<p>URL: <input class="form-control api-url-{apiNameKey}" value="{APIURL}" /> </p>
					<h4>Post data:</h4>
					<textarea class="form-control post-data-{apiNameKey}" >{dataString}</textarea>

					<h4>Result</h4>
					<div class='result-{apiNameKey}'></div><br>
					<button onclick="runApi('{apiNameKey}', '{method}')" class='btn btn-success'>Run</button>
				</div>
			</div>

		</div>
	</div>

</div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="/static/js/bootstrap.min.js"></script>
</body>
</html>