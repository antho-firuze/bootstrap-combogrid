###################
What it is ???
###################

JQuery Plugins for create Ajax Combogrid with Bootstrap interface.


*******************
Requirements
*******************
-  `JQuery v2.1.4/above <http://jquery.com/>`_
-  `Bootstrap v3.3.6/above <http://getbootstrap.com/>`_


************
Using
************
////////////////////////////
// for update queryParams //
////////////////////////////

$("#element").combogrid({ queryParams: { "id":4 } });

////////////////////////////////////
// for adding aditional field/row //
////////////////////////////////////

$("#element").combogrid({ 
	addition: { "id":0, "name":"Non Standard" }
});

///////////////////////////////
// for update event onSelect //
///////////////////////////////

$("#element").combogrid({ 
	onSelect: function(rowData){ 
		$("#element_other").combogrid({ queryParams: { "country_id":rowData.id } });
	}
});

