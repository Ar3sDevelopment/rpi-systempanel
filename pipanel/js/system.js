var jsonData = { disks: [], nics: [], updates: [] };

function updateText(objectId, text) {
	$('#' + objectId).text(text);
}
function updateHTML(objectId, html) {
	$('#' + objectId).html(html);
}
function humanBytes(bytes) {
	var strings = ['B', 'KB', 'MB', 'GB', 'TB'];
	var idx = 0;
	while (bytes > 1024) {
		bytes /= 1024;
		idx++;
	}
	
	return Math.round(bytes * 100) / 100 + strings[idx];
}

function updateDisplay(obj) {
	jsonData = obj;

	updateText("host", obj.general_info.host);
	updateHTML("time", obj.general_info.current_time);
	updateText("kernel", obj.general_info.system + ' ' + obj.general_info.kernel);
	updateText("processor", obj.general_info.processor);
	updateText("freq", obj.general_info.frequency + " MHz");
	updateText("cpuload", obj.general_info.cpuload + "%");
	updateHTML("cpu_temperature", obj.general_info.cpu_temperature + "&deg;C");
	updateText("uptime", obj.general_info.uptime);

	updateText("total_mem", obj.memory.total_mem + " kB");
	updateText("used_mem", obj.memory.used_mem + " kB");
	updateText("percent_used", obj.memory.percent_used + "%");
	updateText("free_mem", obj.memory.free_mem + " kB");
	updateText("percent_free", obj.memory.percent_free + "%");
	updateText("buffer_mem", obj.memory.buffer_mem + " kB");
	updateText("percent_buff", obj.memory.percent_buff + "%");
	updateText("cache_mem", obj.memory.cache_mem + " kB");
	updateText("percent_cach", obj.memory.percent_cach + "%");

	updateText("total_swap", obj.memory.total_swap + " kB");
	updateText("used_swap", obj.memory.used_swap + " kB");
	updateText("percent_swap", obj.memory.percent_swap + "%");
	updateText("free_swap", obj.memory.free_swap + " kB");
	updateText("percent_swap_free", obj.memory.percent_swap_free + "%");

	$("#bar1").css({ width: obj.memory.percent_used + "%", "aria-valuenow": obj.memory.percent_used });
	$("#bar2").css({ width: obj.memory.percent_free + "%", "aria-valuenow": obj.memory.percent_free });
	$("#bar3").css({ width: obj.memory.percent_buff + "%", "aria-valuenow": obj.memory.percent_buff });
	$("#bar4").css({ width: obj.memory.percent_cach + "%", "aria-valuenow": obj.memory.percent_cach });
	$("#bar5").css({ width: obj.memory.percent_swap + "%", "aria-valuenow": obj.memory.percent_swap });
	$("#bar6").css({ width: obj.memory.percent_swap_free + "%", "aria-valuenow": obj.memory.percent_swap_free });
	$("#bar7").css({ width: obj.general_info.cpuload + "%", "aria-valuenow": obj.general_info.cpuload });

	$('#disks').html('');

	if (obj.disks.length > 0) {
		$('#disks').parent().parent().show();
		for (var i = 0; i < obj.disks.length; i++) {
			var disk = obj.disks[i];
			var containerRow = $('<div>').attr({ 'class': 'row' });
			var containerColumn = $('<div>').attr({ 'class': 'col-xs-12' });

			var firstRow = $('<div>').attr({ 'class': 'row' });
			var firstColumn = $('<div>').attr({ 'class': 'col-xs-4' }).text(disk.mount + " (" + disk.typex + ")");
			var secondColumn = $('<div>').attr({ 'class': 'col-xs-4' }).text(disk.size + 'B');
			var thirdColumn = $('<div>').attr({ 'class': 'col-xs-4' }).html('&nbsp;');
			firstRow.append(firstColumn);
			firstRow.append(secondColumn);
			firstRow.append(thirdColumn);
			containerColumn.append(firstRow);

			var secondRow = $('<div>').attr({ 'class': 'row' });
			firstColumn = $('<div>').attr({ 'class': 'col-xs-4' }).text('Available');
			var secondColumn = $('<div>').attr({ 'class': 'col-xs-4' }).text(disk.avail + 'B (' + (100 - disk.percent_part) + '%)');
			var thirdColumn = $('<div>').attr({ 'class': 'col-xs-4' }).append('<div class="progress"><div style="width: ' + (100 - disk.percent_part) + '%;" aria-valuenow="' + (100 - disk.percent_part) + '" class="bar9 progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div>');
			secondRow.append(firstColumn, secondColumn, thirdColumn);
			containerColumn.append(secondRow);
			
			var thirdRow = $('<div>').attr({ 'class': 'row' });
			firstColumn = $('<div>').attr({ 'class': 'col-xs-4' }).text('Used');
			secondColumn = $('<div>').attr({ 'class': 'col-xs-4' }).text(disk.used + 'B (' + disk.percent + ')');
			thirdColumn = $('<div>').attr({ 'class': 'col-xs-4' }).append('<div class="progress"><div style="width: ' + disk.percent + ';" aria-valuenow="' + disk.percent.replace(/[^0-9]/,'') + '" class="bar8 progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div>');
			thirdRow.append(firstColumn, secondColumn, thirdColumn);
			containerColumn.append(thirdRow);

			if (i < (obj.disks.length - 1)) {
				var fourthRow = $('<div>').attr({ 'class': 'row' });
				firstColumn = $('<div>').attr({ 'class': 'col-xs-12' }).html('&nbsp;');
				fourthRow.append(firstColumn);
				containerColumn.append(fourthRow);
			}

			containerRow.append(containerColumn);
			$('#disks').append(containerRow);
		}
	} else {
		$('#disks').parent().parent().hide();
	}
	
	$('#nics').html('');
	
	if (obj.nics.length > 0) {
		$('#nics').parent().parent().show();
		for (var i = 0; i < obj.nics.length; i++) {
			var nic = obj.nics[i];
			var containerRow = $('<div>').attr({ 'class': 'row' });
			var containerColumn = $('<div>').attr({ 'class': 'col-xs-12' });
			
			var firstRow = $('<div>').attr({ 'class': 'row' });
			var firstColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text(nic.name);
			var secondColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text(nic.encap);
			firstRow.append(firstColumn);
			firstRow.append(secondColumn);
			containerColumn.append(firstRow);
			
			if (nic.mac != null && nic.mac.length > 0) {
				var secondRow = $('<div>').attr({ 'class': 'row' });
				firstColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text('MAC Address');
				secondColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text(nic.mac);
				secondRow.append(firstColumn);
				secondRow.append(secondColumn);
				containerColumn.append(secondRow);
			}
			
			var thirdRow = $('<div>').attr({ 'class': 'row' });
			firstColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text('IP Address');
			secondColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text(nic.ip);
			thirdRow.append(firstColumn);
			thirdRow.append(secondColumn);
			containerColumn.append(thirdRow);
			
			var fourthRow = $('<div>').attr({ 'class': 'row' });
			firstColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text('Received');
			secondColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text(humanBytes(nic.rx));
			fourthRow.append(firstColumn);
			fourthRow.append(secondColumn);
			containerColumn.append(fourthRow);
			
			var fifthRow = $('<div>').attr({ 'class': 'row' });
			firstColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text('Transmitted');
			secondColumn = $('<div>').attr({ 'class': 'col-xs-6' }).text(humanBytes(nic.tx));
			fifthRow.append(firstColumn);
			fifthRow.append(secondColumn);
			containerColumn.append(fifthRow);
			
			if (i < (obj.nics.length - 1)) {
				var sixthRow = $('<div>').attr({ 'class': 'row' });
				firstColumn = $('<div>').attr({ 'class': 'col-xs-12' }).html('&nbsp;');
				sixthRow.append(firstColumn);
				containerColumn.append(sixthRow);
			}
			
			containerRow.append(containerColumn);
			$('#nics').append(containerRow);
		}
	} else {
		$('#nics').parent().parent().hide();
	}
	
	$('#updates').html('');
	
	if (obj.updates.length > 0) {
		$('#updates').parent().parent().show();
		var updatesRow = $('<div>').attr({ 'class': 'row' });
		var updatesColumn = $('<div>').attr({ 'class': 'col-xs-12' });
		var ul = $('<ul>').attr({ 'class': 'list-group' });
		
		for (var i = 0; i < obj.updates.length; i++) {
			var update = obj.updates[i];
			var li = $('<li>').attr({ 'class': 'list-group-item' }).text(update);
			ul.append(li);
		}
		
		updatesColumn.append(ul);
		updatesRow.append(updatesColumn);
		$('#updates').append(updatesRow);
	} else {
		$('#updates').parent().parent().hide();
	}
}

function update() {
	$.post('systeminfo.php', null, function (data) {
		updateDisplay(data);

		setTimeout(function () { update(); }, 1000);
	});
}

function updateSingle() {
	$.post('systeminfo.php', null, function (data) {
		updateDisplay(data);
	});
}

$(document).ready(function () {
	update();
	
	$('.panel-heading .btn-link[data-toggle="hide"]').click(function () {
		if (!$(this).attr('data-only') || ($(this).attr('data-only') == 'false'))
		{
			$('.panel').parent().hide();
			$($(this).attr('data-target')).parent().parent().show();
			$(this).attr({ 'data-only': true });
		}
		else
		{
			$('.panel').parent().show();
			
			if (jsonData.disks.length <= 0) {
				$('#disks').parent().parent().hide();
			}
			
			if (jsonData.nics.length <= 0) {
				$('#nics').parent().parent().hide();
			}
			
			if (jsonData.updates.length <= 0) {
				$('#updates').parent().parent().hide();
			}
			
			$(this).attr({ 'data-only': false });
		}
	});
});
