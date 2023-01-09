//login line Chart start

 function formatDate(date){
    var dd = date.getDate();
    var mm = date.getMonth()+1;
    var yyyy = date.getFullYear();
    if(dd<10) {dd="0"+dd}
    if(mm<10) {mm="0"+mm}
    date = dd+'-'+mm+'-'+yyyy;
    return date
 }

function capitalize(s){
    return s.toLowerCase().replace( /\b./g, function(a){ return a.toUpperCase(); } );
};


function Last7Days () {
    var result = [];
    for (var i=0; i<7; i++) {
        var d = new Date();
        d.setDate(d.getDate() - i);
        result.push( formatDate(d) )
    }

    return result;
 }

var lseven = Last7Days();

lseven.sort(function(a,b) {
  a = a.split('-').reverse().join('');
  b = b.split('-').reverse().join('');
  return a > b ? 1 : a < b ? -1 : 0;
  
  // return a.localeCompare(b);         // <-- alternative 
  
});

//lseven = lseven.sort();
	
		
		
		active_userlist(lseven);
function active_userlist(lseven){
    var lognum = [];
    var logdates = [];
   $.ajax({
    url: "/staff/getlogindata",
    method: "GET",
    dataType: "json",
     'data': {'ddd': lseven},
   success: function(data) {
$.each(data, function (value, key) { 

 
lognum.push(key['value']);

logdates.push(key['date']);


});

//alert(logdates);

var canvas = document.getElementById('myChart');
var data = {
    labels: logdates,
    datasets: [
        {
            label: "Time",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgb(84 152 212)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgb(84 152 212)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 5,
            pointHitRadius: 10,
            data: lognum,
        }
    ]
};

function adddata(){
    myLineChart.data.datasets[0].data[7] = 60;
  myLineChart.data.labels[7] = "Newly Added";
  myLineChart.update();
}

var option = {
    showLines: true,
     hover: {
      onHover: function(e, el) {
        $("#myChart").css("cursor", el[0] ? "pointer" : "default");
      }
    },
	scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true,
                 userCallback: function(label, index, labels) {
                     
                     if (Math.floor(label) === label) {
                         return label;
                     }

                 },
             }
         }],
     },
};


var myLineChart = new Chart(canvas,{
    type: 'line',
    data: data,
    options: option
	});



}

});

}
//login line chart end

//Pie Diagram for Task
$(document).ready(function(){
	
     $.ajax({
    url: "/Admin/getusersdata",
    method: "GET",
    dataType: "json",
    success: function(data) {

    var users = [];
      

      var data21=data['result1'];
            var data22=data['result2'];
            var data23=data['result3'];
	users.push(data23);		
	users.push(data22);		
    users.push(data21);
    
    

var ctx = document.getElementById("myChart1").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Pending", "Finished", "Rejected"],
    fill: false,
    datasets: [{
      backgroundColor: [
       "#50cd89",
  "#009ef7",
  "#f1416c"
        
       
      ],
      data: users,
    }]
  },
 options: {
        legend: {
            position:"left",

            labels: {
                fontColor: "#2c3137",
                display:true,
                usePointStyle: true,
            }
        },
   responsive: true,
            maintainAspectRatio: false,
    }
});

}

});

});



function adminreport() {
	
    var save_method;
	var table;
	table = $("#kt_task_report").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		pageLength: 5,
		bLengthChange : false,
		order: [],
		ajax: {
			url: base_url + "Admin/ajaxreporttasklist",
			type: "POST",
			data: function (data) {
				//data.search.value = $(".search-in-table").val();
				//data.id = rid;
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{ className: "text-end pe-0", "targets": [ 1 ] },
			{ className: "text-end pe-0", "targets": [ 2 ] },
			{ className: "text-end pe-12", "targets": [ 3 ] }
		],
	});
	
	table = $("#kt_staff_report").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		pageLength: 5,
		bLengthChange : false,
		order: [],
		ajax: {
			url: base_url + "Admin/ajax_report_stafflist",
			type: "POST",
			data: function (data) {
				//data.search.value = $(".search-in-table").val();
				//data.id = rid;
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{ className: "text-end pe-0", "targets": [ 1 ] },
			{ className: "text-end pe-0", "targets": [ 2 ] },
			{ className: "text-end pe-12", "targets": [ 3 ] }
		],
	});
	
	
	
}

function showreport(type){
	if(type=='task'){
	    $('.rptgraph').hide();
		$('#report_task').show();
		$('#report_staff').hide();
		
	}
	if(type=='staff'){
	    $('.rptgraph').hide();
		$('#report_task').hide();
		$('#report_staff').show();
	}
}




	
//pie Digram  for Task