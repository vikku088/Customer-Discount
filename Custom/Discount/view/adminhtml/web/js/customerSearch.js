require(["jquery"], function($){
	$("#page_customer_groud").on('change',function(){
		var customerGroupName = $('#page_customer_groud :selected').text();
		var customerGroupId = $('#page_customer_groud').val();
		//ajax call to find Customers.....

	});
  });