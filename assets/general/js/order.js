(function()
{
	var VOUCHER_CONTAINER;
	var VOUCHER;
	var SERVER = 'http://vigattin.org/hmvc/pay/update';
	
	function construct(e)
	{
		VOUCHER_CONTAINER = $('.voucher-container');
		VOUCHER = $('.generated-voucher', VOUCHER_CONTAINER);
		VOUCHER_CONTAINER.css({'position':'relative'});
		update_all();
		auto_update(60000);
	}
	
	// library
	function auto_update(time)
	{
		setInterval(function()
		{
			update_all();	
		}, time);
	}
	function update_all()
	{
		VOUCHER.each(function(index, element)
		{
			var txnid = $(element).attr('txnid');
			if($('.order_status b', element).html() == 'Pending')
			{
				update_order(txnid, function(jqXHR, settings)
				{ // before
					$('.order_status b', element).html('checking...');
				}, function(data, textStatus)
				{ // after
					switch(data.status)
					{
						case '1':
						$('.order_status b', element).html('Available').css({'color':'green'});
                        $voucher = $(element).find(".voucher-b-d-voucher").attr("voucher");
                        $(element).find("#voucher-b-a-con").html('<a href=\'print/'+$voucher+'\' id="print">Print</a>');
						break;
						
						case '2':
						$('.order_status b', element).html('Pending').css({'color':'#F69E2C'});
						break;
					}
				});
			}
        });
	}
	function update_order(txnid, before, after)
	{
		$.ajax(
		{
			type: 'GET',
			data: {'mode':'api', 'txnid':txnid},
			url: SERVER,
			dataType: "json",
			beforeSend: function(jqXHR, settings)
			{
				before(jqXHR, settings);
			},
			complete: function(jqXHR, textStatus)
			{
				if(textStatus != 'success')
				{
					after({}, textStatus);
				}
				$('img#themes_menu_loader').css('opacity', 0);
			},
			success: function(data, textStatus, jqXHR)
			{
				after(data, textStatus);
			}
		});
	}
	
	// live
	function init()
	{
		$(document).ready(function(e){construct(e);});
	}
	init();
})();