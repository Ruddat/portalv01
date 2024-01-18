

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	var screenWidth = $(window).width();
	//let draw = Chart.controllers.line.__super__.draw; //draw shadow
	
	var chartBar = function(){
		var options = {
			  series: [
				{
					name: '',
					data: [120, 90, 70, 40,50, 18, 70, 90,70, 40,50, 18],
					//radius: 12,	
				}, 
				{
				  name: '',
				  data: [75,50, 18, 70, 40,70, 100,50, 18, 40, 55, 100]
				}, 
				
			],
			chart: {
				type: 'bar',
				height: 350,
				
				toolbar: {
					show: false,
				},
				
			},
			plotOptions: {
			  bar: {
				horizontal: false,
				columnWidth: '35%',
				endingShape: "rounded",
				borderRadius: 2,
			  },
			  
			},
			states: {
			  hover: {
				filter: 'none',
			  }
			},
			colors:['var(--danger)', 'var(--primary)'],
			dataLabels: {
			  enabled: false,
			},
			markers: {
				shape: "circle",
			},
		
		
			legend: {
				show: false,
				fontSize: '14px',
				position: 'top',
				labels: {
					colors: '#000000',
					
					},
				markers: {
				width: 18,
				height: 18,
				strokeWidth:50,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,	
				}
			},
			stroke: {
			  show: true,
			  width:3,
			  curve: 'smooth',
			  lineCap: 'round',
			  colors: ['transparent']
			},
			grid: {
				borderColor: '#eee',
			},
			xaxis: {
				position: 'bottom',
				  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				  labels: {
				   show: true,
				   style: {
					  colors: '#999999',
					  fontSize: '14px',
					  fontFamily: 'poppins',
					  fontWeight: 400,
					  cssClass: 'apexcharts-xaxis-label',
					},
				  },
				   axisBorder:{
					 show: false,  
					   
					 },
					 axisTicks:{
						 show:false,
						 
					 },
				  crosshairs: {
				  show: false,
			  }
			},
			yaxis: {
				labels: {
					offsetX:-16,
				   style: {
					  colors: '#787878',
					  fontSize: '13px',
					   fontFamily: 'poppins',
					  fontWeight: 100,
					  cssClass: 'apexcharts-xaxis-label',
				  },
			  },
			},
			fill: {
			  opacity: 1,
			  colors:['#EB5757', 'var(--primary)'],
			},
			tooltip: {
			  y: {
				formatter: function (val) {
				  return " " + val + ""
				}
			  }
			},
			responsive: [{
				breakpoint: 575,
				options: {
					series: [
						{
							name: '',
							data: [120, 90, 70, 40,50],
							//radius: 12,	
						}, 
						{
						  name: '',
						  data: [75,50, 18, 70, 40]
						}, 
						
					],
					xaxis:{
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
					}
					
				}
			}]
		};

		var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
		chartBar1.render();
	}
 
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				chartBar();
			},
			
			resize:function(){
				chartBar();
			}
		}
	
	}();

	
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

     

})(jQuery);