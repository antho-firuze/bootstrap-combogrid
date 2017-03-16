{var $template_url = $.php.base_url() ~ "templates/backend/adminlte/"}
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{$template_url}bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="{$template_url}plugins/bootstrap-combogrid/bootstrap-combogrid.css">

	<script src="{$template_url}plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="{$template_url}plugins/bootstrap-combogrid/bootstrap-combogrid.js"></script>
	<script src="{$.php.base_url()}assets/js/bootstrap.helper.js"></script>
</head>
<body>
<script>
var form = $('<form />', { class: 'form-horizontal', autocomplete: 'off', width:"50%" });
form.append(BSHelper.Combobox({ label:"Country", idname:"country_id", url:"{$.php.base_url('systems/c_1country')}", disabled: false }));
form.append(BSHelper.Combobox({ label:"Province", idname:"province_id", url:"{$.php.base_url('systems/c_2province')}" }));
form.append(BSHelper.Combobox({ label:"City", idname:"city_id", url:"{$.php.base_url('systems/c_3city')}", value: -1 }));
form.append(BSHelper.Combobox({ label:"District", idname:"district_id", url:"{$.php.base_url('systems/c_4district')}", value: -1 }));
form.append(BSHelper.Combobox({ label:"Village", idname:"village_id", url:"{$.php.base_url('systems/c_5village')}", value: -1 }));
form.append('<div class="col-sm-3"></div><input type="button" id="btn-disable" class="btnx col-sm-9" value="Disable">');
form.append('<div class="col-sm-3"></div><input type="button" id="btn-enable" class="btnx col-sm-9" value="Enable">');
form.append('<div class="col-sm-3"></div><input type="button" id="btn-init" class="btnx col-sm-9" value="Init">');
form.append('<div class="col-sm-3"></div><input type="button" id="btn-destroy" class="btnx col-sm-9" value="Destroy">');
form.append('<div class="col-sm-3"></div><input type="button" id="btn-setParams" class="btnx col-sm-9" value="setParams Village (district_id = 3276030)">');
form.append('<div class="col-sm-3"></div><input type="button" id="btn-getValue" class="btnx col-sm-9" value="getValue Village">');
form.append('<div class="col-sm-3"></div><input type="button" id="btn-setValue" class="btnx col-sm-9" value="setValue Village (1101010012:Labuhan Bakti)">');
form.append('<div class="col-sm-3"></div><input type="button" id="btn-setValue2" class="btnx col-sm-9" value="setValue Village (null/-1)">');
form.append('<div class="col-sm-3"></div><input type="button" id="btn-version" class="btnx col-sm-9" value="Version">');
$('body').append( form );

$("#country_id").combogrid({ 
	source: function(term, response){
		$.getJSON($("#country_id").data('url'), term, function(data){ response(data.data); });
	},
	onSelect: function(rowData){
		console.log(rowData);
		$("#province_id")
			.combogrid('queryParams', { "country_id":rowData.id })
			.combogrid('setValue', '');
	}
});

$("#province_id").combogrid({ 
	source: function(term, response){
		$.getJSON($("#province_id").data('url'), term, function(data){	response(data.data); });
	},
	onSelect: function(rowData){
		console.log(rowData);
		$("#city_id")
			.combogrid('queryParams', { "province_id":rowData.id })
			.combogrid('setValue', '');
	}
});

$("#city_id").combogrid({ 
	source: function(term, response){
		$.getJSON($("#city_id").data('url'), term, function(data){ response(data.data); });
	},
	onSelect: function(rowData){
		console.log(rowData);
		$("#district_id")
			.combogrid('queryParams', { "city_id":rowData.id })
			.combogrid('setValue', '');
	}
});


$("#district_id").combogrid({ 
	source: function(term, response){
		$.getJSON($("#district_id").data('url'), term, function(data){ response(data.data); });
	},
	onSelect: function(rowData){
		console.log(rowData);
		$("#village_id")
			.combogrid('queryParams', { "district_id":rowData.id })
			.combogrid('setValue', '');
	}
});

$("#village_id").combogrid({ 
	source: function(term, response){
		$.getJSON($("#village_id").data('url'), term, function(data){ response(data.data); });
	},
	onSelect: function(rowData){
		console.log(rowData);
		{* console.log('Country: '+form.find("#country_id").combogrid('getValue').name);
		console.log('Province: '+form.find("#province_id").combogrid('getValue').name);
		console.log('City: '+form.find("#city_id").combogrid('getValue').name);
		console.log('District: '+form.find("#district_id").combogrid('getValue').name); *}
		{* console.log('Village: '+rowData.name); *}
	}
});

form.find('.btnx').click(function(){
	var i = $('.btnx').index(this),
	n = $('.btnx:eq('+i+')').attr('id');
	console.log(n);
	switch(n){
		case 'btn-disable':
			form.find("#village_id").combogrid('disable', true);
			break;
		case 'btn-enable':
			form.find("#village_id").combogrid('disable', false);
			break;
		case 'btn-init':
			form.find("#village_id").combogrid('init');
			break;
		case 'btn-destroy':
			form.find("#village_id").combogrid('destroy');
			break;
		case 'btn-setParams':
			form.find("#village_id").combogrid('queryParams', { "district_id":3276030 });
			break;
		case 'btn-setValue':
			form.find("#village_id").combogrid('setValue', '1101010012');
			break;
		case 'btn-setValue2':
			form.find("#village_id").combogrid('setValue', -1);
			break;
		case 'btn-getValue':
			console.log(form.find("#village_id").combogrid('getValue').name);
			break;
		case 'btn-version':
			console.log(form.find("#village_id").combogrid('version'));
			break;
	}
});

</script>
</body>
</html>